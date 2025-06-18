<?php

namespace App\Livewire\Ecommerce;

use App\Enums\MessageTopic;
use App\Models\Message;
use App\Notifications\NewMessageReceivedNotification;
use App\Services\NotificationService;
use App\Traits\Livewire\WithNotifications;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Contact extends Component
{
    use WithNotifications;

    #[Validate('required|string|min:3|max:150', as: 'nombre')]
    public $sender_name;

    #[Validate('required|email', as: 'email')]
    public $sender_email;

    #[Validate('required|string|size:10', as: 'teléfono')]
    public $sender_phone;

    #[Validate('required|string|max:100', as: 'asunto')]
    public $subject;

    #[Validate('required|string|min:5|max:400', as: 'mensaje')]
    public $message;

    public function save()
    {
        $this->validate();

        $message = Message::create([
            'sender_name'  => $this->sender_name,
            'sender_email' => $this->sender_email,
            'sender_phone' => $this->sender_phone,
            'topic'        => MessageTopic::ContactForm,
            'subject'      => $this->subject,
            'message'      => $this->message,
        ]);

        NotificationService::toOperators(new NewMessageReceivedNotification($message));

        $this->notify([
            'type'  => 'info',
            'title' => 'Consulta enviada',
            'body'  => 'Nos pondremos en contacto contigo a la brevedad',
            'icon'  => 'mark_email_read',
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.ecommerce.contact');
    }
}
