<?php

namespace App\Enums;

enum OrderFeedEvent: string
{
    case StatusUpdate     = 'status_update';
    case ShippingUpdate   = 'shipping_update';
    case PaymentUpdate    = 'payment_update';
    case CustomerComment  = 'customer_comment';
    case Generic          = 'generic';
}