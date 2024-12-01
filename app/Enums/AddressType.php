<?php 

namespace App\Enums;

enum AddressType: string
{
    case Shippping = 'shipping';
    case Billing = 'billing';
}