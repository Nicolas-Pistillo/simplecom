<?php

namespace App\Livewire\Ecommerce;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public function mount()
    {
        
    }

    public function render()
    {
        return view('livewire.ecommerce.products', [
            'products' => Product::available()->orderBy('featured', 'DESC')->paginate(6)
        ]);
    }
}
