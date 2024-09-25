<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;


class Notifications extends Component
{

    public array $notifications = [];


    /**
     * @param string $message Display message for notification
     * @param array $actionButton Requires array with
     * @return void
     */
    #[On("basic-notification")]
    public function basicNotification(string $message, array $actionButton): void
    {
        $this->addNotification(['message' => $message, 'actionButtons' => $actionButton, 'component' => "basic"]);
    }

    public function addNotification(array $properties): void
    {
        $this->notifications[] = $properties;
    }


    public function closeNotification($index): void
    {
        \Log::info($this->notifications);
        if (array_key_exists($index, $this->notifications)) {
            array_splice($this->notifications, $index, 1);
        }
    }


    public function render()
    {
        return view('livewire.notifications');
    }
}
