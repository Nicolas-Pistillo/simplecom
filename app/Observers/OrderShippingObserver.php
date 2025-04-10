<?php

namespace App\Observers;

use App\Models\OrderShipping;

class OrderShippingObserver
{
    /**
     * Handle the OrderShipping "created" event.
     */
    public function created(OrderShipping $orderShipping): void
    {
        //
    }

    /**
     * Handle the OrderShipping "updated" event.
     */
    public function updated(OrderShipping $orderShipping): void
    {
        
    }

    /**
     * Handle the OrderShipping "deleted" event.
     */
    public function deleted(OrderShipping $orderShipping): void
    {
        //
    }

    /**
     * Handle the OrderShipping "restored" event.
     */
    public function restored(OrderShipping $orderShipping): void
    {
        //
    }

    /**
     * Handle the OrderShipping "force deleted" event.
     */
    public function forceDeleted(OrderShipping $orderShipping): void
    {
        //
    }
}
