<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upsert extends Component
{
    use WithFileUploads;

    public $title, $drawerRef, $category, $categoryFather;

    public $name, $description, $image, $imagePreview, $coverImage, $coverImagePreview;

    protected $validationAttributes = [
        'name'        => 'nombre',
        'description' => 'descripción',
        'image'       => 'imagen miniatura',
        'coverImage'  => 'imagen de portada'
    ];

    public function mount()
    {
        $this->title = $this->category ? 'Editando categoría TAL' : 'Nueva categoría';
    }

    public function updatedImage()
    {
        $this->imagePreview = $this->image->temporaryUrl();
    }

    public function updatedCoverImage()
    {
        $this->coverImagePreview = $this->coverImage->temporaryUrl();
    }

    public function save()
    {
        $this->validate([
            'name'        => 'required|string|max:30',
            'description' => 'nullable|string|max:150',
            'image'       => 'nullable|image|max:1024',
            'coverImage'  => 'nullable|image|max:1024'
        ]);

        $category = Category::create([
            'name'            => $this->name,
            'description'     => $this->description,
            'category_father' => $this->categoryFather?->id
        ]);

        if ($this->coverImage)
        {
            $coverImagePath = $this->coverImage->store(tenant('name') . '/categories');
            $category->update(['cover_image_url' => $coverImagePath]);
        }

        if ($this->image)
        {
            $imagePath = $this->image->store(tenant('name') . '/categories');
            $category->update(['image_url' => $imagePath]);
        }

        $this->dispatch('reRenderParent');
        $this->dispatch('close-drawer');
    }

    public function render()
    {
        return view('livewire.admin.categories.upsert');
    }
}