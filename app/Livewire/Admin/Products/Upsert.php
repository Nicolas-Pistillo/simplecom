<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\ProductForm;
use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Upsert extends Component
{
    use WithFileUploads;

    public ProductForm $form;
    public $product;

    public $tagSearch = '';
    public $notificationMessage = '';

    public $images = [];
    public $selectedTags = [];

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

    public function deleteImage($imageIndex)
    {
        $newImages = [];

        $image = $this->images[$imageIndex];

        if ($image instanceof ProductImage)
        {
            $image->delete();
            $this->notify("Imágen eliminada exitosamente");
        }
        
        unset($this->images[$imageIndex]);
        foreach($this->images as $image) { array_push($newImages, $image); }

        $this->images = $newImages;
    }

    public function getTags()
    {
        $tags = Tag::whereNOTIn('id', $this->selectedTags)->orderBy('name');

        if (!empty($this->tagSearch))
        {
            $tags->where('name', 'LIKE', "%$this->tagSearch%");
        }

        return $tags->get();
    }

    public function addTag($tagId)
    {
        array_push($this->selectedTags, $tagId);
    }

    public function createTag($name)
    {
        $tag = Tag::where('name', $name)->first();

        if (!$tag)
            $tag = Tag::create(['name' => trim($name)]);

        if (!in_array($tag->id, $this->selectedTags))
        {
            array_push($this->selectedTags, $tag->id);
        }
    }

    public function removeTag($tagId)
    {
        $index = array_search($tagId, $this->selectedTags);
        unset($this->selectedTags[$index]);
    }

    public function save()
    {
        $this->validate();

        $product = $this->product ? $this->updateProduct() : $this->storeNewProduct();

        if (!empty($this->images))
        {
            foreach($this->images as $index => $image)
            {
                if ($image instanceof ProductImage)
                {
                    $image->update(['order' => $index + 1]);
                    continue;
                }

                $path = $image->store($product->images_dir);

                ProductImage::create([
                    'product_id' => $product->id,
                    'url'        => $path,
                    'order'      => $index + 1
                ]);
            }
        }

        if (!empty($this->selectedTags))
        {
            $product->tags()->sync($this->selectedTags);
        }

        $actionPerformed = $product->wasRecentlyCreated ? 'product_created' : 'product_updated';
        return redirect()->route('admin.products.index')->with($actionPerformed, true);
    }

    public function updateProduct()
    {
        $this->product->update($this->form->all());

        Log::channel('resources')->info('Producto actualizado', [
            'tenant'   => tenant('name'),
            'operator' => Auth::id(),
            'product'  => $this->product
        ]);

        return $this->product;
    }

    public function storeNewProduct()
    {
        $product = Product::create($this->form->all());

        Log::channel('resources')->info('Nuevo producto', [
            'tenant'   => tenant('name'),
            'operator' => Auth::id(),
            'product'  => $product
        ]);

        return $product;
    }

    public function notify($message)
    {
        $this->notificationMessage = $message;
        $this->dispatch('open-notification');
    }

    public function mount(Product|bool $product = false)
    {
        if ($product)
        {
            $this->product = $product;
            $this->form->fill($product);
            $this->form->published = $product->published == 1;

            $product->tags->each(fn($tag) => array_push($this->selectedTags, $tag->id));
            $product->images->sortBy('order')->each(fn($image) => array_push($this->images, $image));
        }

        $this->form->created_by = Auth::id();
    }

    public function render()
    {
        return view('livewire.admin.products.upsert', [
            'categories' => Category::principal()->with('childs')->orderBy('name')->get(),
            'tags'       => $this->getTags(),
            'selectedTagsModels' => Tag::find($this->selectedTags)
        ]);
    }
}
