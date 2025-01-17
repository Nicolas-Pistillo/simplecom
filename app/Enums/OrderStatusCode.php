<?php

namespace App\Enums;

enum OrderStatusCode: string
{
    case Created         = 'created';
    case Pending         = 'pending';
    case PayPending      = 'pay_pending';
    case Confirmed       = 'confirmed';
    case DispatchPending = 'dispatch_pending';
    case Dispatched      = 'dispatched';
    case PickupReady     = 'pickup_ready';
    case InTransit       = 'in_transit';
    case Delivered       = 'delivered';
    case RefundRequested = 'refund_requested';
    case Refunded        = 'refunded';
    case Cancelled       = 'cancelled';
}