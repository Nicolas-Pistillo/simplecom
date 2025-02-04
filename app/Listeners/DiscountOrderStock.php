<?php

namespace App\Listeners;

use App\Events\OrderConfirmed;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class DiscountOrderStock
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
        try 
        {
            if ($event->order->stock_discounted) return;
            
            foreach($event->order->items as $item)
            {
                $item->variant ? $item->variant->update(['stock' => ($item->variant->stock - $item->quantity)])
                               : $item->product->update(['stock' => ($item->product->stock - $item->quantity)]);
            }

            $event->order->update(['stock_discounted' => true]);

        } catch (Exception $err) 
        {
            Log::channel('error')->info('Error al descontar stock de pedido', [
                'tenant'  => tenant('name'),
                'pedido'  => $event->order->code,
                'message' => $err->getMessage()
            ]);
        }
    }
}
