<?php

namespace App\Enums;

enum OrderStatusCode: string
{
    case Created            = 'created';
    case Pending            = 'pending';
    case PaymentPending     = 'payment_pending';
    case ProviderPayPending = 'provider_pay_pending';
    case ProviderPayClaimed = 'provider_pay_claimed';
    case PaymentCancelled   = 'payment_cancelled';
    case PaymentClaimed     = 'payment_claimed';
    case PayRejected        = 'payment_rejected';
    case InMediation        = 'in_mediation';
    case Confirmed          = 'confirmed';
    case DispatchPending    = 'dispatch_pending';
    case Dispatched         = 'dispatched';
    case PickupReady        = 'pickup_ready';
    case InTransit          = 'in_transit';
    case Delivered          = 'delivered';
    case RefundRequested    = 'refund_requested';
    case Refunded           = 'refunded';
    case Cancelled          = 'cancelled';
}