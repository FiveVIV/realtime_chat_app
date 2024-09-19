<?php

use App\Http\Middleware\CheckChatParticipant;
use App\Livewire\Chats;
use App\Livewire\MessageBox;
use App\Livewire\Profile;
use App\Livewire\Settings;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;


Route::get('/', Welcome::class)
    ->middleware(['auth'])
    ->name('welcome');

Route::get("/chat/{chat}", MessageBox::class)
    ->middleware(['auth', CheckChatParticipant::class])
    ->name('chat');

Route::get("/settings", Settings::class)
    ->middleware(['auth'])
    ->name('settings');

Route::get("/profile", Profile::class)
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
