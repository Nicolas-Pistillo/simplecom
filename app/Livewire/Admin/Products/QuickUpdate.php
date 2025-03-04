<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\ProductForm;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class QuickUpdate extends Component
{
    use WithNotifications, WithFileUploads;

    protected $listeners = ['quick-update-product' => 'initialize'];

    public Product $product;

    public ProductForm $form;

    public $images = [];

    public function deleteImage($imageIndex)
    {
        $newImages = [];

        $image = $this->images[$imageIndex];

        if ($image instanceof ProductImage)
        {
            $image->delete();

            $this->notify([
                'type'  => 'success',
                'title' => "Imágen eliminada exitosamente"
            ]);
        }
        
        unset($this->images[$imageIndex]);
        foreach($this->images as $image) { array_push($newImages, $image); }

        $this->images = $newImages;
    }

    #[On('change-images-order')]
    public function changeImagesOrder($newOrder)
    {
        foreach($this->images as $image)
        {
            $isSavedImage = $image instanceof ProductImage;

            $newIndex = array_search($isSavedImage ? $image->id : $image->path(), $newOrder);
            $this->images[$newIndex] = $image;
        }
    }

    public function initialize(Product $product)
    {
        $this->reset('images');
        $this->form->reset();

        $product->load('images', 'category', 'brand');

        $this->product = $product;
        $this->form->autocomplete($product);

        $product->images->sortBy('order')->each(fn($image) => array_push($this->images, $image));

        $this->dispatch('open-quick-update');
    }

    public function save()
    {
        try 
        {
            $this->form->validate();

            $this->product->update($this->form->all());

            if (!empty($this->images))
            {
                foreach($this->images as $index => $image)
                {
                    if ($image instanceof ProductImage)
                    {
                        $image->update(['order' => $index + 1]);
                        continue;
                    }

                    $path = $image->store($this->product->images_dir);

                    ProductImage::create([
                        'product_id' => $this->product->id,
                        'url'        => $path,
                        'order'      => $index + 1
                    ]);
                }
            }

            Log::channel('resources')->info('Producto actualizado', [
                'tenant'      => tenant('name'),
                'operator_id' => Auth::id(),
                'product'     => $this->product
            ]);

            $this->notify([
                'type'  => 'success',
                'title' => "Producto actualizado",
                'body'  => 'Guardaste correctamente los cambios de este producto'
            ]);

            $this->dispatch('close-quick-update');

        } catch (\Throwable $err) 
        {
            $this->notify([
                'type'  => 'danger',
                'title' => "Error al actualizar el producto",
                'body'  => 'Estamos teniendo problemas internos, por favor vuelva a intentarlo a la brevedad'
            ]);

            Log::channel('error')->info('Error al actualizar producto', [
                'tenant'      => tenant('name'),
                'operator_id' => Auth::id(),
                'message'     => $err->getMessage(),
                'product'     => $this->product
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.products.quick-update', [
            'brands'     => Brand::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get()
        ]);
    }
}
