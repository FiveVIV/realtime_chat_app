<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;


class Chats extends Component
{
    public $chats;

    public ?int $showChatOptionsDropdown = null;

    public ?Chat $selectedChat;

    public $slot;

    public int $selectedChatId;

    public function mount(): void
    {
        $this->loadChats();
        $this->setSelectedChatId();
    }

    public function hydrate(): void
    {
        $this->loadChats();
    }

    public function loadChats(): void
    {
        $userId = auth()->id();

        // Load chats associated with the authenticated user
        $chats = Chat::with('users')
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId); // Get chats where the authenticated user is a participant
            })
            ->get()
            ->map(function ($chat) use ($userId) {
                // Find the latest message in the chat
                $latestMessage =
                    auth()
                    ->user()
                    ->messages()
                    ->where('messages.chat_id', $chat->id)
                    ->with(['user'])
                    ->orderBy('messages.created_at', 'desc')
                    ->first();

                // Attach the latest message to the chat
                $chat->latestMessage = $latestMessage;
                return $chat;
            });

        $this->chats = $chats;
    }

    public function leaveChat($chatId): void
    {
        $chat = Chat::findOrFail($chatId);

        if ($chat->title) {
            // Remove the user from the chat
            $chat->users()->detach(auth()->id());
        } else {
            // If there's no title, delete the entire chat
            $chat->delete();
        }

        // Get the message IDs for the specific chat that the user participated in
        $messageIds = Message::where('chat_id', $chatId)->pluck('id')->toArray();

        // Detach the messages only for the specific chat from the pivot table
        auth()->user()->messages()->detach($messageIds);

        // Reload the chats
        $this->loadChats();

        // Close chat options dropdown
        $this->showChatOptionsDropdown = null;
    }


    public function selectChat($chatId): void
    {
        $this->selectedChat = Chat::findOrFail($chatId);
        $this->loadChats();
        $this->redirectRoute("chat", $this->selectedChat->id);
    }

    public function setSelectedChatId(): void
    {
        $paths = explode("/", request()->path());


        if ($paths[0] === "chat") {
            $this->selectedChatId = $paths[1];
            Log::info("going");

        }
    }





    public function render(): View
    {
        return view('livewire.chats');
    }
}
