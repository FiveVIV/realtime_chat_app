<?php

namespace App\Livewire;

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
        $this->friendRequests = auth()->user()->friendRequests()->get();
    }


    public function acceptFriendRequest($friendId): void
    {
        auth()->user()->acceptFriendRequest($friendId);

        $this->loadFriendRequests();
    }

    public function rejectFriendRequest($senderId): void
    {
        auth()->user()->rejectFriendRequest($senderId);
    }







    public function render()
    {
        return view('livewire.friend-requests');
    }
}
