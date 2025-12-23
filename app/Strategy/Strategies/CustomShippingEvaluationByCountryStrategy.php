<?php 

namespace App\Strategy\Strategies;

use App\Models\CustomShippingMethod;
use App\Services\CartService;
use App\Strategy\Contracts\CustomShippingRateStrategy;
use App\Utils\ShippingRateParameters;
use Gloudemans\Shoppingcart\Facades\Cart;

class CustomShippingEvaluationByCountryStrategy implements CustomShippingRateStrategy
{
    public function evaluate(CustomShippingMethod $method, ShippingRateParameters $rateParameters): bool
    {
        return $this->evaluateConditions($method, $rateParameters);
    }

    public function evaluateZone(CustomShippingMethod $method, ShippingRateParameters $rateParameters): bool
    {
        return true;
    }

    public function evaluateConditions(CustomShippingMethod $method, ShippingRateParameters $rateParameters): bool
    {
        $conditions = $method->conditions;

        if (!empty($conditions))
        {
            $cartPackage = CartService::getPackageInfo();

            foreach($conditions as $condition => $conditionValue)
            {
                if (empty($conditionValue)) continue;

                if ($condition === 'cart_price_gte' && Cart::total() < $conditionValue)
                {
                    return false;
                }

                if ($condition === 'cart_price_lte' && Cart::total() > $conditionValue)
                {
                    return false;
                }

                if ($condition === 'cart_weight_gte' && $cartPackage['weight'] < $conditionValue)
                {
                    return false;
                }

                if ($condition === 'cart_weight_lte' && $cartPackage['weight'] > $conditionValue)
                {
                    return false;
                }
            }
        }

        return true;
    }
}