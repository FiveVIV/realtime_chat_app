<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class FriendService
{

    public static function acceptFriendRequest($friendshipId): void
    {
        // Update the friendship to mark it as accepted
        DB::table('friendships')
            ->where('id', $friendshipId)
            ->update(['accepted' => true]);
    }

    public static function deleteFriendship($friendshipId): void
    {
        // Update the friendship to mark it as accepted
        DB::table('friendships')
            ->where('id', $friendshipId)
            ->delete();
    }

    public static function hasFriendRequests(): bool
    {
        return auth()->user()->pendingFriendRequestsFrom()->get()->isEmpty();
    }

    public static function sendFriendRequest($friendId): void
    {
        $user = auth()->user();

        // Check if a friendship or pending request already exists
        $friendshipExists = $user->friendsTo()->where('friend_id', $friendId)->exists() || $user->friendsFrom()->where('sender_id', $friendId)->exists();

        if ($friendshipExists) {
            // If the friendship or request already exists, you might want to handle it (e.g., return an error or message)
            throw new \Exception('Friendship already exists or friend request is pending.');
        }

        // Send a new friend request
        $user->friendsTo()->attach($friendId, ['accepted' => false]);

        // Optionally, you could dispatch a notification here if needed
        // Notification::send($friendId, new FriendRequestSentNotification($user));
    }


}
