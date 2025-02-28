<?php

namespace App\Livewire\Admin;

use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class Notifications extends Component
{
    public function deleteNotification(DatabaseNotification $notification)
    {
        $notification->delete();
    }

    public function render()
    {
        return view('livewire.admin.notifications');
    }
}
