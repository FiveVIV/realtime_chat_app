<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Many-to-Many Relationship with Message
    public function messages()
    {
        return $this->belongsToMany(Message::class, 'message_user')
            ->withPivot('read_at', 'created_at') // Access pivot table fields
            ->withTimestamps(); // Automatically manage timestamps on pivot
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }

    // Friends that this user sent friend requests to (initiated friendships)
    public function friends(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'sender_id')
            ->wherePivot('accepted', true)
            ->withTimestamps();
    }

    // Friend requests this user received but has not yet accepted
    public function friendRequests(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'sender_id')
            ->wherePivot('accepted', false)
            ->withTimestamps();
    }

    public function hasFriendRequests(): bool
    {
        // Check if the current user has any pending friend requests
        return $this->friendRequests()->exists();
    }

    // All accepted friendships where this user is either the sender or the receiver
    public function allFriends(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friendships', 'sender_id', 'friend_id')
            ->wherePivot('accepted', true)
            ->withTimestamps()
            ->union($this->belongsToMany(User::class, 'friendships', 'friend_id', 'sender_id')
                ->wherePivot('accepted', true)
                ->withTimestamps());
    }

    // To accept a friend request
    public function acceptFriendRequest($sendersId): void
    {
        $this->friendRequests()->updateExistingPivot($sendersId, ['accepted' => true]);
    }

    public function rejectFriendRequest($sendersId): void
    {
        $this->friendRequests()->detach($sendersId);
    }

    public function sendFriendRequest($friendId): void
    {
        // Check if the friend request already exists
        $existingRequest = $this->friends()->wherePivot('friend_id', $friendId)->exists();

        if (!$existingRequest) {
            // Add a new friend request (pending)
            $this->friends()->attach($friendId, ['accepted' => false]);
        }
    }

}
