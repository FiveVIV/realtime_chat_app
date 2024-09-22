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


    public function acceptFriendRequest($senderId): void
    {
        auth()->user()->acceptFriendRequest($senderId);

        $this->loadFriendRequests();
    }







    public function render()
    {
        return view('livewire.friend-requests');
    }
}
