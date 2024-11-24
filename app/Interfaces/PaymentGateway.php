<?php

namespace App\Interfaces;

interface PaymentGateway
{
    public function generateCheckout($order);
}