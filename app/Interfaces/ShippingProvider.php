<?php

namespace App\Interfaces;

use App\Models\Order;
use App\Models\OrderShipping;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Collection;

interface ShippingProvider
{
    public function getRates(ShippingRateParameters $parameters): Collection;
    public function createOrder(Order $order);
    public function getStatus(OrderShipping $shipping);
}