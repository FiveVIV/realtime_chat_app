<?php

namespace App\Livewire;

use App\Services\FriendService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Livewire\Component;

class FriendRequests extends Component
{

    public $friendRequests = null;


    public function mount(): void
    {
        $this->loadFriendRequests();
    }

    public function loadFriendRequests(): void
    {
        $user = auth()->user();

        $this->friendRequests = $user->pendingFriendRequestsFrom()->get();
    }


    public function acceptFriendRequest($friendshipId): void
    {
        FriendService::acceptFriendRequest($friendshipId);

        $this->loadFriendRequests();
    }

    public function rejectFriendRequest($friendshipId): void
    {
        FriendService::deleteFriendShip($friendshipId);

        $this->loadFriendRequests();
    }



    public function render()
    {
        return view('livewire.friend-requests');
    }
}
