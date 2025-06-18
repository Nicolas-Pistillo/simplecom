<?php 

namespace App\Enums;

enum DeliveryType: string
{
    case Picking = 'picking_delivery';
    case Shipping = 'shipping_delivery';

    public function name(): string
    {
        return match($this)
        {
            DeliveryType::Picking  => 'Retiro',
            DeliveryType::Shipping => 'Envío'
        };
    }
}