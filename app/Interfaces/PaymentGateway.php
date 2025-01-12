<?php

namespace App\Interfaces;

use App\Models\Order;

interface PaymentGateway
{
    public function generateCheckout(Order $order);
}