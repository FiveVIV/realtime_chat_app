<?php

use App\Http\Middleware\CheckChatParticipant;
use App\Livewire\FriendList;
use App\Livewire\FriendPending;
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



Route::prefix("/friend")->name("friend.")->middleware("auth")->group(function () {
    Route::get("/list", FriendList::class)
        ->name('list');

    Route::get("/requests", FriendRequests::class)
        ->name('requests');

    Route::get("/pending", FriendPending::class)
        ->name('pending');
});





Route::prefix("notification")->group(function ( ) {
    Route::post('/basic', function () {
        $message = request('message');

        return view('components.notifications.basic', ['message' => $message])->render();
    });
});





require __DIR__.'/auth.php';
