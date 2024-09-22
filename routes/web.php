<?php

use App\Http\Middleware\CheckChatParticipant;
use App\Livewire\FriendList;
use App\Livewire\FriendRequests;
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

Route::get("/friend/list", FriendList::class)
    ->middleware(['auth'])
    ->name('friend.list');

Route::get("/friend/requests", FriendRequests::class)
    ->middleware(['auth'])
    ->name('friend.requests');


Route::prefix("notification")->group(function ( ) {
    Route::post('/basic', function () {
        $message = request('message');

        // Render the Blade component and return it
        return view('components.basic-notification', ['message' => $message])->render();
    });
});





require __DIR__.'/auth.php';
