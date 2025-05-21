<?php

namespace App\Livewire\Admin\Messages;

use App\Models\Message;
use Livewire\Component;

class Index extends Component
{
    public function getMessages()
    {
        return Message::orderBy('created_at', 'DESC')->get();
    }

    public function render()
    {
        return view('livewire.admin.messages.index', [
            'messages' => $this->getMessages(),
        ]);
    }
}
