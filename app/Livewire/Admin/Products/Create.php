<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\NewProductForm;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class Create extends Component
{
    use WithFileUploads;

    public NewProductForm $form;

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
        $newImagesItem = [];
        
        unset($this->images[$imageIndex]);
        foreach($this->images as $image) { array_push($newImagesItem, $image); }

        $this->images = $newImagesItem;
    }

    public function save()
    {
        $this->validate();

        dd("Paso toda la validación");
    }

    public function render()
    {
        $categories = Category::principal()->published()->with('childs')->orderBy('name')->get();

        return view('livewire.admin.products.create', compact('categories'));
    }
}
