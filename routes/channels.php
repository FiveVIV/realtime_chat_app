<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('new-message.{userId}', function (User $user, int $userId) {
    return $user->id === $userId;
});
