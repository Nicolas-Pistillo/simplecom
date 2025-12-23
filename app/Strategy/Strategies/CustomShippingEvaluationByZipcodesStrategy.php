<?php 

namespace App\Strategy\Strategies;

use App\Enums\ZipcodeSelectionType;
use App\Models\CustomShippingMethod;
use App\Services\CartService;
use App\Strategy\Contracts\CustomShippingRateStrategy;
use App\Utils\ShippingRateParameters;
use Gloudemans\Shoppingcart\Facades\Cart;

class CustomShippingEvaluationByZipcodesStrategy implements CustomShippingRateStrategy
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
        if ($method->zipcode_selection_type === ZipcodeSelectionType::ByRanges)
        {
            return $this->evaluateByRanges($method, $rateParameters);
        }

        if ($method->zipcode_selection_type === ZipcodeSelectionType::FreeSelection)
        {
            return $this->evaluateInFreeSelection($method, $rateParameters);
        }
    }

    public function evaluateByRanges(CustomShippingMethod $method, ShippingRateParameters $rateParameters): bool
    {
        $destinationZipcode = $rateParameters->recipient_address->zipcode;
        
        $validated = false;

        foreach($method->zipcode_ranges as $range)
        {
            if ($destinationZipcode >= $range['from'] && $destinationZipcode <= $range['to'])
            {
                $validated = true;
                break;
            }
        }

        return $validated;
    }

    public function evaluateInFreeSelection(CustomShippingMethod $method, ShippingRateParameters $rateParameters): bool
    {
        $destinationZipcode = $rateParameters->recipient_address->zipcode;

        $zipcodeList = explode(',', $method->zipcode_list);

        $validated = false;

        foreach($zipcodeList as $zipcode)
        {
            if (trim($zipcode) == trim($destinationZipcode))
            {
                $validated = true;
                break;
            }
        }

        return $validated;
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