<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use App\Models\Product;
use App\Services\BrandFetch;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Upsert extends Component
{
    use WithNotifications;

    public $brandSearch, $brandSearchResults;

    public function togglePublished(Brand $brand, $published)
    {
        $brand->update(compact('published'));
        
        $actionTitle = $brand->published ? 'Publicaste' : 'Despublicaste';
        $this->notify("$actionTitle la marca $brand->name");
    }

    public function updatedBrandSearch()
    {
        if (!empty($this->brandSearch) && strlen($this->brandSearch) >= 2)
        {
            $brands = BrandFetch::searchBrand($this->brandSearch);
        }

        $this->brandSearchResults = $brands ?? [];
    }

    public function addBrand($brand)
    {
        $brand = Brand::create([
            'brandfetch_id' => $brand['brandId'],
            'name'          => $brand['name'],
            'image_url'     => $brand['icon']
        ]);

        Log::channel('resources')->info("Nueva marca", [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'brand'       => $brand
        ]);

        $this->notify("Agregaste la marca $brand->name");
    }

    public function deleteBrand(Brand $brand)
    {
        $brand->delete();
        Product::where('brand_id', $brand->id)->update(['brand_id' => null]);

        Log::channel('resources')->info("Marca eliminada", [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'brand'       => $brand
        ]);

        $this->notify("Eliminaste la marca $brand->name");
    }

    public function render()
    {
        return view('livewire.admin.brands.upsert', [
            'brands' => Brand::with('products')->orderBy('name')->get()
        ]);
    }
}
