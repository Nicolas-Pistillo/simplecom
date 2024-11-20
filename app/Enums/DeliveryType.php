<?php 

namespace App\Enums;

enum DeliveryType: string
{
    case Withdraw = 'withdraw_delivery';
    case Shipping = 'shipping_delivery';
}