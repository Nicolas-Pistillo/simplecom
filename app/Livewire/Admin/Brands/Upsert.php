<?php

namespace App\Livewire\Admin\Brands;

use App\Livewire\Forms\BrandForm;
use App\Models\Brand;
use App\Models\Product;
use App\Services\BrandFetch;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Upsert extends Component
{
    use WithNotifications, WithFileUploads;

    public BrandForm $form;

    public $brand, $imagePreview, $brandSearch, $brandSearchResults;

    public function togglePublished(Brand $brand, $published)
    {
        $brand->update(compact('published'));
        
        $actionTitle = $brand->published ? 'Publicaste' : 'Despublicaste';
        $this->notify([
            'type'  => 'success',
            'title' => "$actionTitle la marca $brand->name"
        ]);
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

        $this->notify([
            'type'  => 'success',
            'title' => "Agregaste la marca $brand->name"
        ]);

        $this->reset();
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

        $this->notify([
            'type'  => 'success',
            'title' => "Eliminaste la marca $brand->name"
        ]);
    }

    public function openNewBrand()
    {
        $this->reset('brand', 'imagePreview');
        $this->form->reset();

        $this->dispatch('open-brand-panel');
    }

    public function openEditBrand(Brand $brand)
    {
        $this->reset('brand', 'imagePreview');
        $this->form->reset();

        $this->brand = $brand;

        $this->form->fill([
            'name'        => $brand->name,
            'description' => $brand->description,
            'published'   => $brand->published ? true : false,
            'featured'    => $brand->featured ? true : false,
        ]);

        $this->imagePreview = $brand->image_url ? Storage::url($brand->image_url) : null;

        $this->dispatch('open-brand-panel');
    }

    public function updatedFormImage()
    {
        $this->imagePreview = $this->form->image->temporaryUrl();
    }

    public function deleteImage()
    {
        if ($this->brand?->image_url)
        {
            Storage::delete($this->brand->image_url);
            $this->brand->update(['image_url' => null]);   
        }

        $this->form->image = null;
        $this->imagePreview = null;
    }

    public function save()
    {
        $this->form->validate();

        $brand = isset($this->brand) ? $this->brand->update($this->form->except('image'))
                                     : Brand::create($this->form->except('image'));

        if ($this->form->image)
        {
            if ($brand->image_url)
                Storage::delete($brand->image_url);

            $imagePath = $this->form->image->store(tenant('brands_url'));
            $brand->update(['image_url' => $imagePath]);
        }

        Log::channel('resources')->info("Marca añadida", [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'brand'       => $brand
        ]);

        $this->notify([
            'type'  => 'success',
            'title' => "Guardaste la marca $brand->name"
        ]);

        $this->dispatch('close-brand-panel');
    }

    public function render()
    {
        return view('livewire.admin.brands.upsert', [
            'brands' => Brand::with('products')->orderBy('name')->get()
        ]);
    }
}
