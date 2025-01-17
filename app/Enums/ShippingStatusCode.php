<?php

namespace App\Enums;

enum ShippingStatusCode: string
{
    case CreationPending  = 'creation_pending';
    case Created          = 'created';
    case Pending          = 'pending';
    case Confirmed        = 'confirmed';
    case Ready            = 'ready';
    case InTransit        = 'in_transit';
    case Delivered        = 'delivered';
    case CarrierCancelled = 'carrier_cancelled';
    case Cancelled        = 'cancelled';
    case Returned         = 'returned';
    case Sinister         = 'sinister';
}