<?php

namespace App\Livewire;

use App\Models\User;
use Exception;
use Livewire\Component;

class FriendList extends Component
{

    public $friends;

    public $randomNonFriends;

    public ?int $friendOptionsDropdown = null;

    public string $email;


    public function mount(): void
    {
        $this->loadFriends();
        $this->getRandomNonFriends();
    }

    public function loadFriends(): void
    {
        $this->friends = auth()->user()->friends()->get();
    }

    public function getRandomNonFriends($limit = 3): void
    {
        $userId = auth()->id();

        // Query to get $limit random users who are not friends or have pending friend requests with the current user
        $this->randomNonFriends = User::where('id', '!=', $userId) // Exclude the current user
        ->whereDoesntHave('friends', function ($query) use ($userId) {
            // Exclude users where the current user is the sender or receiver
            $query->where(function($subQuery) use ($userId) {
                $subQuery->where('sender_id', $userId) // where current user is the friend_id
                ->orWhere('friend_id', $userId); // where current user is the sender_id
            });
        })
            ->whereDoesntHave('friendRequests', function ($query) use ($userId) {
                // Additionally, exclude users who have pending friend requests involving the current user
                $query->where(function($subQuery) use ($userId) {
                    $subQuery->where('sender_id', $userId)
                        ->orWhere('friend_id', $userId);
                });
            })
            ->inRandomOrder() // Get random users
            ->limit($limit) // Limit to $limit users
            ->get();
    }


    public function refreshGetRandomNonFriends(): void
    {
        $this->getRandomNonFriends();
    }


    public function deleteFriend($friendId, $senderId): void
    {
        // Get the authenticated user
        $user = auth()->user();

        // Detach the friendship relationship based on the provided sender and friend IDs
        $user->friends()
            ->wherePivot('sender_id', $senderId)
            ->wherePivot('friend_id', $friendId)
            ->detach([$friendId, $senderId]);

        // Reload the list of friends after detaching
        $this->loadFriends();
    }


    public function sendFriendRequest($friendId = null)
    {
        // Validate if the $friendId belongs to a valid user

        $friend = $friendId === null ? User::where("email", $this->email)->firstOrFail() : User::find($friendId);


        if (!$friend) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        try {
            // Check if a friend request already exists
            $existingRequest = auth()->user()->friends()->wherePivot('friend_id', $friendId)->exists();

            if (!$existingRequest) {
                // Add a new friend request (pending)
                auth()->user()->friends()->attach($friendId, ['accepted' => false]);

                // Dispatch success notification
                $this->dispatch("basic-notification", message: "Friend request sent.", button: ["label" => "Undo"]);

            } else {
                // Friendship request already exists
                $this->dispatch("add-notification", message: "Friend request sent successfully.", type: "basic");
            }
        } catch (Exception $e) {
            // Log the exception for debugging purposes
            \Log::error("Friend request failed: " . $e->getMessage());

            // Dispatch error notification
            $this->dispatch("add-notification", message: "An error occurred while sending the friend request.", type: "basic");
        }
    }



    public function render()
    {
        return view('livewire.friend-list');
    }
}
