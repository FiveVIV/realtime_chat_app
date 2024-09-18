<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
}
