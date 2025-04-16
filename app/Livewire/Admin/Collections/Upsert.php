<?php

namespace App\Livewire\Admin\Collections;

use App\Models\Product;
use App\Models\ProductCollection;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Upsert extends Component
{
    use WithNotifications, WithFileUploads;

    public $collection; 
    
    #[Validate('required|string|max:35', as: 'nombre')]
    public $name;
    
    #[Validate('required|string|max:75', as: 'descripción')]
    public $description;

    #[Validate('required|array|min:1', as: 'productos')]
    public $selected_products = [];

    #[Validate(as: 'imágen')]
    public $image;

    public $image_preview;
    public $active = true;

    public $search = '';
    public Collection $product_results; 

    #[Computed]
    public function selectedProductModels()
    {
        return Product::with('category')->whereIn('id', $this->selected_products)->get();
    }

    public function updatedImage()
    {
        $this->image_preview = $this->image->temporaryUrl();
    }

    public function updatedSearch()
    {
        $this->product_results = Product::with('category')
                                        ->adminSearch($this->search)
                                        ->whereNotIn('id', $this->selected_products)
                                        ->take(5)
                                        ->get();
    }

    public function addProduct($productId)
    {
        array_push($this->selected_products, $productId);
        $this->search = '';
    }

    public function removeProduct($productId)
    {
        array_splice($this->selected_products, array_search($productId, $this->selected_products), 1);
    }

    public function mount()
    {
        $this->product_results = collect();
    }

    public function save()
    {
        $this->validate();

        if (!$this->collection)
        {
            $this->validate([
                'image' => 'required|image'
            ]);
        }

        $collection = ProductCollection::create([
            'name'        => $this->name,
            'description' => $this->description,
            'image_url'   => $this->image->store(tenant('collections_url')),
            'active'      => $this->active
        ]);

        $collection->products()->sync($this->selected_products);

        return to_route('admin.collections.index')->with('collection_created', true);
    }

    public function render()
    {
        return view('livewire.admin.collections.upsert');
    }
}
