<?php 

namespace App\Enums;

enum ShippingMethodType: string
{
    case Custom = 'custom';
    case Carrier = 'carrier';
    case MultiCarrier = 'multi_carrier';
}