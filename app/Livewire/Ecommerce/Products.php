<?php

namespace App\Livewire\Ecommerce;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public function loadProducts()
    {
        return Product::available()->orderBy('featured', 'DESC')->paginate(6);
    }

    public function mount()
    {
        
    }

    public function render()
    {
        return view('livewire.ecommerce.products', [
            'products' => $this->loadProducts()
        ]);
    }
}
