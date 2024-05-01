<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use App\Services\BrandFetch;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class Upsert extends Component
{
    use WithNotifications;

    public $hasBrands, $brandSearch, $brandSearchResults;

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

        $this->notify("Agregaste la marca $brand->name");
    }

    public function mount()
    {
        $this->hasBrands = Brand::count() > 0;
    }

    public function render()
    {
        return view('livewire.admin.brands.upsert', [
            'brands' => Brand::with('products')->orderBy('name')->get()
        ]);
    }
}
