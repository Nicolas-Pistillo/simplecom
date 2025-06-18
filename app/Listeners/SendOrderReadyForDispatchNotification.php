<?php

namespace App\Listeners;

use App\Events\OrderReadyForDispatch;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendOrderReadyForDispatchNotification
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
    public function handle(OrderReadyForDispatch $event): void
    {
        Log::channel('resources')->info('Disparar emails y notificaciones de pedido listo para despachar', [
            'tenant'    => tenant('name'),
            'pedido'    => $event->order->id,
            'proveedor' => $event->order->shippingProvider->name
        ]);
    }
}
