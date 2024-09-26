<?php

namespace App\Models;

use Cassandra\Exception\AlreadyExistsException;
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


    public function friendsTo()
    {
        return $this->belongsToMany(User::class, 'friendships', 'sender_id', 'friend_id')
            ->withPivot(['id', 'accepted'])
            ->withTimestamps();
    }

    public function friendsFrom()
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'sender_id')
            ->withPivot(['id', 'accepted'])
            ->withTimestamps();
    }

    public function pendingFriendRequestsTo()
    {
        return $this->friendsTo()->wherePivot('accepted', false);
    }


    public function pendingFriendRequestsFrom()
    {
        return $this->friendsFrom()->wherePivot('accepted', false);
    }




}
