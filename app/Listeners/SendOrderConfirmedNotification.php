<?php

namespace App\Listeners;

use App\Events\OrderConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendOrderConfirmedNotification
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
    public function handle(OrderConfirmed $event): void
    {
        Log::channel('resources')->info('Enviar notificación de orden confirmada', [
            'tenant'  => tenant('name'),
            'pedido'  => $event->order->code,
        ]);
    }
}
