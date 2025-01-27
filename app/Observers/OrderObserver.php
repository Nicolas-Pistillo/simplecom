<?php

namespace App\Observers;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Models\Order;
use App\Models\OrderFeedItem;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        OrderFeedItem::create([
            'order_id'      => $order->id,
            'event'         => OrderFeedEvent::StatusUpdate,
            'presentation'  => OrderFeedPresentation::InitialsImage,
            'initializator' => $order->user->full_name,
            'action'        => 'realizó este pedido'
        ]);
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
