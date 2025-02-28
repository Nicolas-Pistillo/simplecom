<?php

namespace App\Notifications;

use App\Enums\NotificationPresentation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class TestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'presentation'   => NotificationPresentation::Image,
            'icon_code'      => 'error',
            'icon_color'     => 'red',
            'initials_name'  => 'Juan Carlos',
            'body'  => 'Este es un ejemplo de una notificación sin href',
            'url'   => null
        ];
    }
}
