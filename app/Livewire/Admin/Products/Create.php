<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\ProductForm;
use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class Create extends Component
{
    use WithFileUploads;

    public ProductForm $form;

    #[Validate(['images.*' => 'nullable|image|max:4020'])]
    public $images = [];

    #[On('change-images-order')]
    public function changeImagesOrder($newOrder)
    {
        foreach($this->images as $image)
        {
            $newIndex = array_search($image->path(), $newOrder);
            $this->images[$newIndex] = $image;
        }
    }

    public function deleteImage($imageIndex)
    {
        $newImages = [];
        
        unset($this->images[$imageIndex]);
        foreach($this->images as $image) { array_push($newImages, $image); }

        $this->images = $newImages;
    }

    public function save()
    {
        $this->validate();

        $product = Product::create($this->form->all());

        Log::channel('resources')->info('Nuevo producto', [
            'tenant' => tenant('name'),
            'operator' => Auth::id(),
            'product' => $product
        ]);

        if (!empty($this->images))
        {
            foreach($this->images as $index => $image)
            {
                $path = $image->store($product->images_dir);

                ProductImage::create([
                    'product_id' => $product->id,
                    'url'        => $path,
                    'order'      => $index + 1
                ]);
            }
        }
        
        return redirect()->route('admin.products.index')->with('product_created', true);
    }

    public function mount()
    {
        $this->form->created_by = Auth::id();
    }

    public function render()
    {
        $categories = Category::principal()->published()->with('childs')->orderBy('name')->get();

        return view('livewire.admin.products.create', compact('categories'));
    }
}
