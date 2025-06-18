<?php

namespace App\Interfaces;

use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Support\Collection;

interface PaymentGateway
{
    public function model(): PaymentMethod;
    public function checkCredentials(Collection $credentials): bool;
    public function generateCheckout(Order $order);
}