<?php 

namespace App\Strategy\Contracts;

use App\Models\CustomShippingMethod;
use App\Utils\ShippingRateParameters;

interface CustomShippingRateStrategy
{
    public function evaluate(CustomShippingMethod $method, ShippingRateParameters $rateParameters): bool;
    public function evaluateZone(CustomShippingMethod $method, ShippingRateParameters $rateParameters): bool;
    public function evaluateConditions(CustomShippingMethod $method, ShippingRateParameters $rateParameters): bool;
}