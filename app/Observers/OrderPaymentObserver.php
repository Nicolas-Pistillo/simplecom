<?php

namespace App\Observers;

use App\Enums\PaymentStatus;
use App\Models\OrderPayment;

class OrderPaymentObserver
{
    /**
     * Handle the OrderPayment "created" event.
     */
    public function created(OrderPayment $payment): void
    {
        
    }

    /**
     * Handle the OrderPayment "updated" event.
     */
    public function updated(OrderPayment $payment): void
    {
        if ($payment->status === PaymentStatus::Confirmed)
        {
            $payment->order->discountStock();
        }
    }

    /**
     * Handle the OrderPayment "deleted" event.
     */
    public function deleted(OrderPayment $payment): void
    {
        //
    }

    /**
     * Handle the OrderPayment "restored" event.
     */
    public function restored(OrderPayment $payment): void
    {
        //
    }

    /**
     * Handle the OrderPayment "force deleted" event.
     */
    public function forceDeleted(OrderPayment $payment): void
    {
        //
    }
}
