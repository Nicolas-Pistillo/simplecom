<?php 

namespace App\Traits\Livewire;

trait WithNotifications
{
    public $notificationMessage;

    public function notify($message, $notifyEvent = 'open-notification')
    {
        $this->notificationMessage = $message;
        $this->dispatch($notifyEvent);
    }
}