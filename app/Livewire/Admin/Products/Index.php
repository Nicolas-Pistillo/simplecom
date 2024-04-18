<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

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

        Log::channel('resources')->info("Producto actualizado", [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'product'     => $productModel
        ]);

        $this->notify($message);
    }

    public function toggleFeaturedProduct($product)
    {
        $productModel = Product::find($product['id']);
        $productModel->update(['featured' => !$productModel->featured]);
        
        $message = $productModel->featured 
                    ? 'Destacaste este producto' 
                    : 'El producto ya no estara destacado';

        Log::channel('resources')->info("Producto actualizado", [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'product'     => $productModel
        ]);

        $this->notify($message);
    }

    public function toggleMassiveSelect($value)
    {
        dd($value);
    }

    public function deleteProduct($product)
    {
        $product = Product::find($product['id']);
        $product->delete();

        $this->notify("Eliminaste $product->name");

        Log::channel('resources')->info("Producto eliminado", [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'product'     => $product
        ]);
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

        $logTitleByAction = [
            'publish'     => 'publicados',
            'unpublish'   => 'despublicados',
            'highlight'   => 'marcados como destacados',
            'unhighlight' => 'removidos de destacados',
            'delete'      => 'eliminados'
        ];

        $resultTitle = $bulkActionTitles[$action];
        $logActionTitle = $logTitleByAction[$action];

        Log::channel('resources')->info("$productsTotal productos $logActionTitle", [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'products'    => $products
        ]);

        $this->notify($resultTitle . " $productsTotal productos");
        $this->dispatch('close-bulk-delete-dialog');
        $this->selectedProducts = [];
    }

    public function mount()
    {
        $this->hasProducts = Product::count() > 0;
    }

    public function getProducts()
    {
        $products = Product::with('category');

        if (!empty(trim($this->search)))
        {
            $search = trim($this->search);

            $products->where('name', 'LIKE', "%$search%");
            $products->orWhere('code', 'LIKE', "%$search%");

            $products->orWhereHas('category', function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            });
        }

        return $products->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.products.index', [
            'products' => $this->getProducts()
        ]);
    }
}
