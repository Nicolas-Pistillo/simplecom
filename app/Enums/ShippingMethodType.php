<?php 

namespace App\Enums;

enum ShippingMethodType: string
{
    case Own = 'own';
    case Carrier = 'carrier';
    case MultiCarrier = 'multi_carrier';
}