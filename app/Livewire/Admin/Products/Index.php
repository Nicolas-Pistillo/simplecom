<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $selectedProducts = [];

    public function render()
    {
        return view('livewire.admin.products.index', [
            'products' => Product::paginate(10)
        ]);
    }
}
