<?php

namespace App\Livewire\Ecommerce;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Livewire\Component;
use App\Models\Product as ProductModel;
use App\Models\VariantOption;
use App\Services\ProductService;
use App\Traits\Livewire\WithNotifications;
use Gloudemans\Shoppingcart\Facades\Cart;

class Product extends Component
{
    use WithNotifications;

    protected $listeners = ['updated-cart' => '$refresh'];

    public $product;
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
            $this->quantitySelected -= 1;
    }

    public function validateSelection()
    {
        $variantId = null;
        $variantValues = [];

        if (!empty($this->variants))
        {
            $variantValidationOutput = $this->validateSelectionWithVariants();

            $variantId = $variantValidationOutput['variantId'];
            $variantValues = $variantValidationOutput['variantValues'];
        } else
            $this->validateSelectionWithoutVariants();
           
        return compact('variantId', 'variantValues');
    }

    public function validateSelectionWithVariants()
    {
        $this->validate(['selectedVariants.*' => 'required']);

        $variant = ProductService::getProductVariantByAttributes($this->product->id, $this->selectedVariants);

        $variantId = $variant->id;

        $productOnCart = Cart::search(
            fn ($cartItem) => $cartItem->id === $this->product->id &&
                            $cartItem->options->variant_id === $variantId)->first();

        $totalProductQty = $productOnCart ? $this->quantitySelected + $productOnCart->qty 
                                          : $this->quantitySelected;

        ProductService::validateProductSelection($totalProductQty, $this->product, [
            'variant_id' => $variantId,
        ]);

        $variantValues = [];

        foreach ($this->selectedVariants as $attributeId => $valueId) {
            $attributeName = Attribute::find($attributeId)->name;
            $attributeValueName = AttributeValue::find($valueId)->name;

            $variantValues[$attributeName] = $attributeValueName;
        }

        return compact('variantId', 'variantValues');
    }

    public function validateSelectionWithoutVariants()
    {
        $productOnCart = Cart::search(
            fn ($cartItem) => $cartItem->id === $this->product->id
        )->first();

        $totalProductQty = $productOnCart ? $this->quantitySelected + $productOnCart->qty 
                                          : $this->quantitySelected;

        ProductService::validateProductSelection($totalProductQty, $this->product);
    }

    public function addToCart()
    {
        $validationsOutput = $this->validateSelection();

        Cart::add(
            $this->product->id,
            $this->product->name,
            $this->quantitySelected,
            $this->product->current_price,
            [
                'image_url'      => $this->product->first_image,
                'category_id'    => $this->product->category_id,
                'discount'       => $this->product->discount_percent,
                'variant_id'     => $validationsOutput['variantId'],
                'variant_values' => $validationsOutput['variantValues']
            ]
        )->associate(ProductModel::class);

        $this->dispatch('updated-cart');
        $this->dispatch('close-product-quick-view');
        $this->dispatch('open-cart-panel');

        $unitsTitle = $this->quantitySelected > 1 ? 'unidades' : 'unidad';

        $this->notify([
            'type'     => 'success',
            'title'    => 'Añadido al carrito',
            'position' => 'top-left',
            'icon'     => 'add_shopping_cart',
            'body'     => "Agregaste $this->quantitySelected $unitsTitle de {$this->product->name}"
        ]);
    }

    public function buyNow()
    {
        $itemsOnCart = Cart::search(fn($cartItem) => $cartItem->id === $this->product->id);
                            
        if ($itemsOnCart->isNotEmpty()) return $this->redirectRoute('ecommerce.checkout');

        $validationsOutput = $this->validateSelection();

        Cart::add(
            $this->product->id,
            $this->product->name,
            $this->quantitySelected,
            $this->product->current_price,
            [
                'image_url'      => $this->product->first_image,
                'category_id'    => $this->product->category_id,
                'discount'       => $this->product->discount_percent,
                'variant_id'     => $validationsOutput['variantId'],
                'variant_values' => $validationsOutput['variantValues']
            ]
        )->associate(ProductModel::class);

        return $this->redirectRoute('ecommerce.checkout');
    }

    public function selectVariantAttribute($attributeId, $valueId)
    {
        $this->selectedVariants[$attributeId] = $valueId;

        // IDs of all variants that having the selected attribute and value
        $variantIds = VariantOption::where('product_id', $this->product->id)
                                    ->where('attribute_id', $attributeId)
                                    ->where('attribute_value_id', $valueId)
                                    ->whereHas('variant', function ($query) {
                                        return $query->where('stock', '>', 0);
                                    })
                                    ->pluck('variant_id')
                                    ->toArray();

        // Check available combinations for the selected variant attribute
        foreach ($this->variants as $variantIndex => $variant) {

            if ($variant['attribute_id'] == $attributeId) continue;

            $availableCombinations = VariantOption::whereIn('variant_id', $variantIds)
                ->where('attribute_id', '!=', $attributeId)
                ->where('attribute_id', $variant['attribute_id'])
                ->get();

            foreach ($variant['values'] as $index => $variantValue) {

                $availableCombination = $availableCombinations->contains('attribute_value_id', $variantValue['id']);

                // Remove previous selected variant attribute combination if it is not available
                if (
                    !$availableCombination &&
                    isset($this->selectedVariants[$variant['attribute_id']]) &&
                    $this->selectedVariants[$variant['attribute_id']] == $variantValue['id']
                ) {
                    $this->selectedVariants[$variant['attribute_id']] = null;
                }

                $this->variants[$variantIndex]['values'][$index]['available'] = $availableCombination;
            }
        }
    }

    public function mount(ProductModel|int $product)
    {
        $this->product = is_int($product) ? ProductModel::find($product) : $product;

        if ($this->product->hasVariants()) 
        {
            $this->variants = ProductService::generateSelectableVariantOptions($this->product);

            foreach ($this->variants as $variant) 
            {
                $this->selectedVariants[$variant['attribute_id']] = null;
            }
        }
    }

    public function render()
    {
        return view('livewire.ecommerce.product');
    }
}
