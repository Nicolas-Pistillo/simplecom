<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;

class ProductService
{
    /**
     * Generates an array grouping the attributes and values ​​of the product variants
     * to offer the variant selection feature to the customer
     */
    public static function generateSelectableVariantOptions(Product $product)
    {
        if (!$product->hasVariants()) return false;

        $selectableVariantOptions = [];

        $groupedVariantOptions = $product->variantOptions->groupBy('attribute_id');

        foreach ($groupedVariantOptions as $attributeId => $values) {
            
            $attribute = Attribute::find($attributeId);

            $valuesIds = $values->unique('attribute_value_id')
                ->map(fn ($value) => $value->attribute_value_id);

            $attributeValues = AttributeValue::find($valuesIds)
                ->select(['id', 'name', 'meta'])
                ->toArray();

            array_push($selectableVariantOptions, [
                'attribute_id'   => $attribute->id,
                'attribute_name' => $attribute->name,
                'values'         => $attributeValues
            ]);
        }

        return $selectableVariantOptions;
    }
}
