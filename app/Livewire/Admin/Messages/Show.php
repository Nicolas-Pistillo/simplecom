<?php

namespace App\Livewire\Admin\Messages;

use App\Mail\MessageReplied;
use App\Models\Message;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Show extends Component
{
    use WithNotifications;

    public $message, $reply;

    public function mount(Message $message)
    {
        if (!$message->read) $message->update(['read' => true]);
        $this->message = $message;
    }

    public function sendResponse()
    {
        $this->validate(['reply' => 'required|string|min:5']);

        $this->message->update([
            'reply'      => $this->reply,
            'replied_at' => now(),
            'replied_by' => auth()->id(),
        ]);

        Mail::to($this->message->sender_email)
            ->send(new MessageReplied(tenant(), $this->message));

        $this->notify([
            'type'  => 'success',
            'title' => 'Respuesta enviada',
            'body'  => "Se envio correctamente tu respuesta a {$this->message->sender_name}",
        ]);
    }

    public function render()
    {
        return view('livewire.admin.messages.show');
    }
}
