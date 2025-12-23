<?php 

namespace App\Strategy\Strategies;

use App\Models\CustomShippingMethod;
use App\Services\CartService;
use App\Strategy\Contracts\CustomShippingRateStrategy;
use App\Utils\ShippingRateParameters;
use Gloudemans\Shoppingcart\Facades\Cart;

class CustomShippingEvaluationByLocalitiesStrategy implements CustomShippingRateStrategy
{
    public function evaluate(CustomShippingMethod $method, ShippingRateParameters $rateParameters): bool
    {
        if ($this->evaluateConditions($method, $rateParameters))
        {
            return $this->evaluateZone($method, $rateParameters);
        }

        return false;
    }

    public function evaluateZone(CustomShippingMethod $method, ShippingRateParameters $rateParameters): bool
    {
        $destination = $rateParameters->recipient_address;

        if (in_array($destination->province_id, $method->selected_provinces))
        {
            if (!empty($method->excluded_localities))
            {
                if (in_array($destination->locality_id, $method->excluded_localities))
                {
                    return false;
                }
            }

            return true;
        }

        return false;
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