<?php

namespace App\Listeners;

use App\Events\OrderReadyForPickup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendOrderReadyForPickupNotification
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
    public function handle(OrderReadyForPickup $event): void
    {
        Log::channel('resources')->info('Disparar emails y notificaciones de pedido listo para retirar', [
            'tenant'  => tenant('name'),
            'pedido' => $event->order->id,
            'local'  => $event->order->storePickup->name
        ]);
    }
}
