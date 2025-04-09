<?php

namespace App\Observers;

use App\Enums\OrderFeedEvent;
use App\Enums\NotificationPresentation;
use App\Enums\OrderStatus;
use App\Events\OrderConfirmed;
use App\Events\OrderDelivered;
use App\Events\OrderReadyForDispatch;
use App\Events\OrderReadyForPickup;
use App\Mail\OrderCreated as MailOrderCreated;
use App\Mail\OrderConfirmed as MailOrderConfirmed;
use App\Mail\OrderPickupReady as MailOrderPickupReady;
use App\Mail\OrderDispatched as MailOrderDispatched;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Notifications\NewOrderNotification;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
            'presentation'  => NotificationPresentation::InitialsImage,
            'initializator' => $order->user->full_name,
            'action'        => 'realizó este pedido'
        ]);

        NotificationService::toOperators(new NewOrderNotification($order));
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if ($order->status === OrderStatus::Confirmed)
        {
            /* OrderConfirmed::dispatch($order); */
            $order->discountStock();
            Mail::to($order->user->email)->send(new MailOrderConfirmed(tenant(), $order));
        }

        if ($order->status === OrderStatus::PickupReady)
        {
            /* OrderReadyForPickup::dispatch($order); */
            Mail::to($order->user->email)->send(new MailOrderPickupReady(tenant(), $order));
        }

        if ($order->status === OrderStatus::DispatchReady)
        {
            /* OrderReadyForDispatch::dispatch($order); */
        }

        if ($order->status === OrderStatus::Dispatched)
        {
            /* OrderCancelled::dispatch($order); */
            Mail::to($order->user->email)->send(new MailOrderDispatched(tenant(), $order));
        }

        if ($order->status === OrderStatus::Delivered)
        {
            /* OrderDelivered::dispatch($order); */
        }
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
