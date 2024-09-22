<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class FriendList extends Component
{

    public $friends;

    public $randomNonFriends;

    public ?int $friendOptionsDropdown = null;


    public function mount(): void
    {
        $this->loadFriends();
        if (!$this->friends->isNotEmpty()) {
            $this->getRandomNonFriends();
        }
    }

    public function loadFriends(): void
    {
        $this->friends = auth()->user()->friends()->get();
    }

    public function getRandomNonFriends($limit = 3): void
    {
        $userId = auth()->id();

        // Query to get 3 random users who are not friends with the current user
        $this->randomNonFriends = User::where('id', '!=', $userId) // Exclude the current user
        ->whereDoesntHave('friends', function ($query) use ($userId) {
            $query->where('friend_id', $userId)
                ->orWhere('sender_id', $userId);
        })
            ->inRandomOrder() // Get random users
            ->limit($limit) // Limit to 3 users
            ->get();
    }

    public function refreshGetRandomNonFriends(): void
    {
        $this->getRandomNonFriends();
    }


    public function deleteFriend($friendId, $senderId): void
    {
        // Detach the friendship relationship
        auth()->user()->friends()
            ->wherePivot("sender_id", $senderId)
            ->wherePivot("friend_id", $friendId)
            ->detach($senderId);

        $this->loadFriends();
    }





    public function render()
    {
        return view('livewire.friend-list');
    }
}
