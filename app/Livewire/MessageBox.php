<?php

namespace App\Livewire;

use App\Events\NewMessage;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class MessageBox extends Component
{


    public $messages = [];

    public string $message = '';

    public ?int $showMessageOptionsDropdown = null;

    public ?Chat $selectedChat;



    public function mount(Chat $chat)
    {
        $this->selectedChat = $chat;
        $this->loadMessages();
    }

    public function rendered(): void
    {
        $this->dispatch('scroll-bar-update');
    }


    public function loadMessages(): void
    {
        if ($this->selectedChat) {
            // Fetch messages for the authenticated user from the pivot table
            $this->messages = auth()->user()->messages()
                ->where('messages.chat_id', $this->selectedChat->id) // Ensure the message belongs to the selected chat
                ->with(['user'])  // Load the sender (user) of the message
                ->orderBy('messages.created_at', 'asc')  // Order by the messages table's created_at column
                ->get();
        }
    }





    public function getListeners(): array
    {
        return [
            "echo-private:new-message.".auth()->id().",NewMessage" => "receiveMessage",
        ];
    }


    public function receiveMessage($event): void
    {
        $message = auth()->user()->messages()->where("message_id", $event["message"]["id"])->first();


        if ($message->chat_id === $this->selectedChat->id) {
            $this->messages->push($message);
        }

        $this->loadChats();
    }


    public function sendMessage(): void
    {

        // Create a new message
        $newMessage = Message::create([
            'chat_id' => $this->selectedChat->id,
            'user_id' => auth()->id(),
            'message' => $this->message,
        ]);

        // Attach the message to all users in the selected chat
        $newMessage->users()->attach($this->selectedChat->users()->pluck('user_id')->toArray());

        // Dispatch the NewMessage event
        NewMessage::dispatch($newMessage);

        // Push the new message to the messages collection for real-time update
        $this->messages->push(auth()->user()->messages()->where('message_id', $newMessage->id)->first());

        // Clear the input field
        $this->message = '';
    }



    public function deleteMessageForSelf($messageId): void
    {
        // Find the authenticated user's message relationship from the pivot table
        $message = auth()->user()->messages()->where('message_id', $messageId)->first();

        // Check if the message exists in the pivot table for the user
        if ($message) {
            // Detach the relationship between the user and the message in the pivot table
            auth()->user()->messages()->detach($messageId);
        }

        $this->loadMessages();

        // Reset the message options dropdown
        $this->showMessageOptionsDropdown = null;
    }


    public function deleteMessageForAll($messageId): void
    {
        // Find the authenticated user's message relationship from the pivot table
        $message = auth()->user()->messages()->where('message_id', $messageId)->first();

        // Check if the message exists in the pivot table for the user
        if ($message) {
            foreach ($this->selectedChat->users()->get() as $user) {
                $user->messages()->detach($messageId);
            }
        }

        $this->loadMessages();

        $this->showMessageOptionsDropdown = null;
    }

    public function render()
    {
        return view('livewire.message-box');
    }
}
