<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;

class QuickUpdate extends Component
{
    protected $listeners = ['quick-update-product' => 'initialize'];

    public $product;

    public function initialize(Product $product)
    {
        $this->product = $product;
        $this->dispatch('open-quick-update');
    }

    public function render()
    {
        return view('livewire.admin.products.quick-update');
    }
}
