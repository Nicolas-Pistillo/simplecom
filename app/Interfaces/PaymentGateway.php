<?php

namespace App\Interfaces;

use App\Models\Order;
use App\Models\PaymentMethod;

interface PaymentGateway
{
    public function generateCheckout(Order $order);

    public function model(): PaymentMethod;
}