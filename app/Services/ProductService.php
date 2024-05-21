<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductService
{
    /**
     * Generates an array grouping the attributes and values ​​of the product variants
     * to offer the variant options select feature to the customer
     */
    public static function generateSelectableVariantOptions(Product $product)
    {
        if (!$product->hasVariants()) return false;

        $selectableVariantOptions = [];

        $groupedVariantOptions = $product->variantOptions()->whereHas('variant', function($query) {
            $query->where('stock', '>', 0);
        })->get();
        
        $groupedVariantOptions = $groupedVariantOptions->groupBy('attribute_id');

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

    /**
     * Returns the first product variant found through the passed array of attributes and values
     */
    public static function getProductVariantByAttributes($productId, array $attributes)
    {
        $variantQuery = ProductVariant::where('product_id', $productId);

        foreach($attributes as $attributeId => $attributeValueId)
        {
            $variantQuery->whereHas('options', function($query) use ($attributeId, $attributeValueId) {
                $query->where('attribute_id', $attributeId)
                    ->where('attribute_value_id', $attributeValueId);
            });
        }

        return $variantQuery->first();
    }
}
