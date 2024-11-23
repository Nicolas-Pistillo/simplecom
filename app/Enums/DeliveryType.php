<?php 

namespace App\Enums;

enum DeliveryType: string
{
    case Picking = 'picking_delivery';
    case Shipping = 'shipping_delivery';
}