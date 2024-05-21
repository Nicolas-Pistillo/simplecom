<?php 

namespace App\Traits\Livewire;

trait WithNotifications
{
    public function notify($data = [], $notifyEvent = 'notification')
    {
        $this->dispatch($notifyEvent, $data);
    }
}