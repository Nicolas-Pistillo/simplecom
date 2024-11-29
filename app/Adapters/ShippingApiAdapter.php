<?php 

namespace App\Adapters;

interface ShippingApiAdapter
{
    public function calculateQuotes(): array;
} 