<?php

namespace App\Livewire\Admin\Products;

use App\Exports\ProductsExport;
use App\Livewire\Forms\IndexProductsFilters;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination, WithNotifications;

    public $selectedProducts = [];
    public $search = '';
    public $hasProducts = true;

    public IndexProductsFilters $filters;

    protected $listeners = ['close-quick-update' => '$refresh'];

    public function updatingPage()
    {
        $this->selectedProducts = [];
    }

    public function updatedSearch()
    {
        $this->selectedProducts = [];
        $this->setPage(1);
    }

    public function updatedFilters()
    {
        $this->selectedProducts = [];
        $this->setPage(1);
    }

    public function togglePublishedProduct(Product $product)
    {
        $productModel = Product::find($product['id']);
        $productModel->update(['published' => !$productModel->published]);
        
        $actionTitle = $productModel->published ? 'Publicaste' : 'Despublicaste';

        Log::channel('resources')->info("Producto actualizado", [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'product'     => $productModel
        ]);

        $this->notify([
            'type'  => 'success',
            'title' => "$actionTitle este producto"
        ]);
    }

    public function toggleFeaturedProduct(Product $product)
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

        $this->notify([
            'type'  => 'success',
            'title' => $message
        ]);
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();

        $this->notify([
            'type'  => 'success',
            'title' => "Eliminaste $product->name"
        ]);

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

        $this->notify([
            'type'  => 'success',
            'title' => $resultTitle . " $productsTotal productos"
        ]);

        $this->dispatch('close-bulk-delete-dialog');
        $this->selectedProducts = [];
    }

    public function download($selecteds = false)
    {
        $products = $selecteds 
                    ? Product::find($this->selectedProducts)->load('category', 'tags', 'operator')
                    : Product::with('category', 'tags', 'operator')->get();

        return Excel::download(new ProductsExport($products), 'productos.xlsx');
    }

    public function quickUpdate(Product $product)
    {
        $this->dispatch('quick-update-product', $product->id);
    }

    public function getProducts()
    {
        return Product::with('category', 'operator')
                        ->adminSearch($this->search)
                        ->adminFilter($this->filters)
                        ->paginate(15);
    }

    public function mount()
    {
        $this->hasProducts = Product::count() > 0;
    }

    public function render()
    {
        return view('livewire.admin.products.index', [
            'products'   => $this->getProducts(),
            'categories' => Category::principal()->with('childs')->orderBy('name')->get(),
            'brands'     => Brand::orderBy('name')->get()
        ]);
    }
}
