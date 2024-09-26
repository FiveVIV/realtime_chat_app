<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\FriendService;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
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
        $user = auth()->user();

        $this->friends = $user->friendsTo()->wherePivot("accepted", true)->get()->merge($user->friendsFrom()->wherePivot("accepted", true)->get());
    }

    public function getRandomNonFriends($limit = 3): void
    {
        $user = auth()->user();
        $userId = auth()->id();

        // Get the user's current friends from the merged friendsTo and friendsFrom collections
        $friendIds = $user->friendsTo()->get()->merge($user->friendsFrom()->get())->pluck('id')->toArray();

        // Get pending friend requests involving the current user (sent and received)
        $pendingFriendRequestIds = $user->pendingFriendRequestsTo()->get()->merge($user->pendingFriendRequestsFrom()->get())->pluck('id')->toArray();

        // Merge friend IDs with pending friend request IDs to exclude both from the random users query
        $excludedIds = array_merge($friendIds, $pendingFriendRequestIds);

        // Query to get $limit random users who are not friends and don't have pending friend requests
        $this->randomNonFriends = User::where('id', '!=', $userId) // Exclude current user
        ->whereNotIn('id', $excludedIds) // Exclude current friends and users with pending friend requests
        ->inRandomOrder() // Get random users
        ->limit($limit) // Limit to $limit users
        ->get();
    }




    public function refreshGetRandomNonFriends(): void
    {
        $this->getRandomNonFriends();
    }


    public function deleteFriend($friendshipId): void
    {
        FriendService::deleteFriendship($friendshipId);

        // Reload the list of friends after detaching
        $this->loadFriends();
    }






    public function render()
    {
        return view('livewire.friend-list');
    }
}
