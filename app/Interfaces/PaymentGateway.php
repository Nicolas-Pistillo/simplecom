<?php

namespace App\Interfaces;

use App\Models\Order;
use App\Models\PaymentMethod;

interface PaymentGateway
{
    public function model(): PaymentMethod;
    public function generateCheckout(Order $order);
}