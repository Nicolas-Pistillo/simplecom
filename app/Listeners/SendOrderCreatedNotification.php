<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        Log::channel('resources')->info('Disparar emails y notificaciones de nuevo pedido', [
            'tenant'  => tenant('name'),
            'pedido' => $event->order->id,
            'items'  => $event->order->items
        ]);
    }
}
