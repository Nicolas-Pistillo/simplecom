<?php

namespace App\Livewire\Ecommerce;

use App\Models\Product;
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
            $this->validate([
                'selectedVariants.*' => 'required'
            ]);

            dd($this->selectedVariants);
        }
    }

    public function testAddToCart()
    {
        Cart::add(
            $this->product->id, 
            $this->product->name, 
            $this->quantitySelected, 
            $this->product->current_price, 
            ['image_url' => $this->product->first_image]
        )->associate(Product::class);
        $this->dispatch('updatedCart');
    }

    public function selectVariantAttribute($attributeId, $valueId)
    {
        $this->selectedVariants[$attributeId] = $valueId;
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
