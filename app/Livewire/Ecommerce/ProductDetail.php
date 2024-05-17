<?php

namespace App\Livewire\Ecommerce;

use App\Models\Product;
use App\Services\ProductService;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;
    public $variants = [];

    public function mount(Product $product)
    {
        if($product->hasVariants())
        {
            $this->variants = ProductService::generateSelectableVariantOptions($product);
        }

        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.ecommerce.product-detail');
    }
}
