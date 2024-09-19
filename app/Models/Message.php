<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chat_id',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'message_user')
            ->withPivot('read_at', 'created_at')
            ->withTimestamps();
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
