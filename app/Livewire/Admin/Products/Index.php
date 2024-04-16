<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $selectedProducts = [];
    public $search = '';
    public $hasProducts = true;
    public $notificationMessage;

    public function updatingPage()
    {
        $this->selectedProducts = [];
    }

    public function updatedSearch()
    {
        $this->selectedProducts = [];
        $this->setPage(1);
    }

    public function notify($message)
    {
        $this->notificationMessage = $message;
        $this->dispatch('open-notification');
    }

    public function togglePublishedProduct($product)
    {
        $productModel = Product::find($product['id']);
        $productModel->update(['published' => !$productModel->published]);
        
        $message = $productModel->published 
                    ? 'Publicaste este producto' 
                    : 'El producto ya no está publicado';

        $this->notify($message);
    }

    public function toggleFeaturedProduct($product)
    {
        $productModel = Product::find($product['id']);
        $productModel->update(['featured' => !$productModel->featured]);
        
        $message = $productModel->featured 
                    ? 'Destacaste este producto' 
                    : 'El producto ya no estara destacado';

        $this->notify($message);
    }

    public function bulkAction($action)
    {
        $productsTotal = count($this->selectedProducts);
        $products = Product::find($this->selectedProducts);
        
        foreach($products as $product)
        {
            switch ($action) {
                case 'publish': $product->update(['published' => true]);
                break;
                case 'unpublish': $product->update(['published' => false]);
                break;
                case 'highlight': $product->update(['featured' => true]);
                break;
                case 'unhighlight': $product->update(['featured' => false]);
                break;
                case 'delete': $product->delete();
            }
        }

        $bulkActionTitles = [
            'publish'     => 'Publicaste',
            'unpublish'   => 'Despublicaste',
            'highlight'   => 'Destacaste',
            'unhighlight' => 'Removiste de destacados',
            'delete'      => 'Eliminaste'
        ];

        $resultTitle = $bulkActionTitles[$action];

        $this->notify($resultTitle . " $productsTotal productos");
        $this->selectedProducts = [];
    }

    public function mount()
    {
        $this->hasProducts = Product::count() > 0;
    }

    public function render()
    {
        $products = Product::with('category');

        if (!empty($this->search))
        {
            $products->where('name', 'LIKE', "%$this->search%");
            $products->orWhere('code', 'LIKE', "%$this->search%");

            $products->orWhereHas('category', function($query) {
                $query->where('name', 'LIKE', "%$this->search%");
            });
        }

        return view('livewire.admin.products.index', [
            'products' => $products->paginate(10)
        ]);
    }
}
