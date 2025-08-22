<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Determines if the given selected product or variant is available to buy or add to cart
     */
    public static function validateProductSelection(int $quantity, Product $product, $options = [])
    {
        $variantId = data_get($options, 'variant_id');
        $validationLabel = data_get($options, 'validator_label', 'selection');
        $hasMinSale = $product->min_sale && $product->min_sale > 1;
        $hasMaxSale = $product->max_sale && $product->max_sale >= 1;
        $stock = data_get($options, 'variant_id') ? ProductVariant::find($variantId)->stock : $product->stock;

        // Stock validation
        Validator::make(
            [$validationLabel => $quantity],
            [$validationLabel => "lte:$stock"],
            [$validationLabel => 'No podes agregar más unidades de '. ($variantId ? 'esta variante' : 'este producto')]
        )->validate();

        // Max and Min sale validation
        if ($hasMinSale || $hasMaxSale)
        {
            $validatorRules = [];
            $validatorMessages = [];

            if ($hasMinSale)
            {
                $validatorRules[$validationLabel][] = "gte:$product->min_sale";
                $validatorMessages["$validationLabel.gte"] = "El mínimo de compra es de $product->min_sale unidades";
            }

            if ($hasMaxSale)
            {
                $validatorRules[$validationLabel][] = "lte:$product->max_sale";
                $validatorMessages["$validationLabel.lte"] = "El límite de compra es de $product->max_sale unidades";
            }

            Validator::make([$validationLabel => $quantity], $validatorRules, $validatorMessages)->validate();
        }
    }
}
