<?php

namespace App\Livewire\Ecommerce;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $order = 'relevants';
    public $category, $min_price = 2, $max_price = 7;

    public function loadProducts()
    {
        $products = Product::available();

        switch ($this->order)
        {
            case 'relevants': $products->orderByRelevants();  
            break;
            case 'news':      $products->orderByNews();        
            break;
            case 'cheaps':     $products->orderByCheaps(); 
            break;
            case 'expensives': $products->orderByExpensives();
            break;
            default:          $products->orderByRelevants();
        }

        return $products->paginate(9);
    }

    public function updatedOrder()
    {
        $this->resetPage();
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
