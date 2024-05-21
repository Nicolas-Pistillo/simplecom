<?php

namespace App\Livewire\Ecommerce;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\VariantOption;
use App\Services\ProductService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;
    public $variants = [];
    public $selectedVariants = [];

    public $quantitySelected = 1;

    public function addQuantity()
    {
        $this->quantitySelected += 1;
    }

    public function substractQuantity()
    {
        if ($this->quantitySelected > 1)
        {
            $this->quantitySelected -= 1;
        }
    }

    public function testValidations()
    {
        if (!empty($this->selectedVariants))
        {
            $this->validate(['selectedVariants.*' => 'required']);

            dd($this->selectedVariants);
        }
    }

    public function addToCart()
    {
        $variant_id = null;
        $variantAttributeNames = [];

        if (!empty($this->variants))
        {
            $this->validate(['selectedVariants.*' => 'required']);

            $variant = ProductService::getProductVariantByAttributes($this->product->id, $this->selectedVariants);
            
            $this->validate(['quantitySelected' => "integer|max:$variant->stock"]);

            $variant_id = $variant->id;

            foreach($this->selectedVariants as $attributeId => $valueId)
            {
                $attributeName = Attribute::find($attributeId)->name;
                $attributeValueName = AttributeValue::find($valueId)->name;

                $variantAttributeNames[$attributeName] = $attributeValueName;
            }

        } else 
        {
            $this->validate(['quantitySelected' => "integer|max:{$this->product->stock}"]);
        }

        Cart::add(
            $this->product->id, 
            $this->product->name, 
            $this->quantitySelected, 
            $this->product->current_price, 
            [
                'image_url'  => $this->product->first_image,
                'variant_id' => $variant_id,
                'variant_attribute_names' => $variantAttributeNames
            ])->associate(Product::class);

        $this->dispatch('updated-cart');
        $this->dispatch('open-cart-panel');
        $this->dispatch('notification', [
            'type'     => 'success',
            'title'    => 'Añadido al carrito',
            'position' => 'top-left',
            'time'     => 16000,
            'body'     => "Agregaste $this->quantitySelected unidades de {$this->product->name}"
        ]);
    }

    public function selectVariantAttribute($attributeId, $valueId)
    {
        $this->selectedVariants[$attributeId] = $valueId;

        // Check available combinations for the selected attribute
        foreach($this->variants as $variantIndex => $variant)
        {
            if ($variant['attribute_id'] == $attributeId) continue;

            $variantIds = VariantOption::where('product_id', $this->product->id)
                                    ->where('attribute_id', $attributeId)
                                    ->where('attribute_value_id', $valueId)
                                    ->pluck('variant_id');

            $availableCombinations = VariantOption::whereIn('variant_id', $variantIds)
                                                ->where('attribute_id', '!=', $attributeId)
                                                ->where('attribute_id', $variant['attribute_id'])
                                                ->whereHas('variant', function($query) {
                                                    return $query->where('stock', '>', 0);
                                                })
                                                ->get();

            foreach($variant['values'] as $index => $variantValue)
            {
                $availableCombination = $availableCombinations->contains('attribute_value_id', $variantValue['id']);

                // Remove previous selected attribute if it is not available
                if (!$availableCombination && 
                isset($this->selectedVariants[$variant['attribute_id']]) && 
                $this->selectedVariants[$variant['attribute_id']] == $variantValue['id'])
                {
                    $this->selectedVariants[$variant['attribute_id']] = null;
                }

                $this->variants[$variantIndex]['values'][$index]['available'] = $availableCombination;
            }
        }
    }

    public function mount(Product $product)
    {
        if($product->hasVariants())
        {
            $this->variants = ProductService::generateSelectableVariantOptions($product);

            foreach($this->variants as $variant)
            {
                $this->selectedVariants[$variant['attribute_id']] = null;
            }
        }

        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.ecommerce.product-detail');
    }
}
