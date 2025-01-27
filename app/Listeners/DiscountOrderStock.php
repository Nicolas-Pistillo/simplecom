<?php

namespace App\Listeners;

use App\Events\OrderCreated;
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
    public function handle(OrderCreated $event): void
    {
        try 
        {
            foreach($event->order->items as $item)
            {
                $item->variant ? $item->variant->update(['stock' => ($item->variant->stock - $item->quantity)])
                               : $item->product->update(['stock' => ($item->product->stock - $item->quantity)]);
            }
        } catch (Exception $err) 
        {
            Log::channel('error')->info('Error al descontar stock de productos', [
                'tenant'  => tenant('name'),
                'message' => $err->getMessage()
            ]);
        }
    }
}
