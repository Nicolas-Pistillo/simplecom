<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Upsert extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $drawerTitle, $drawerRef, $category, $categoryFather;
    public $name, $description, $image, $imagePreview, $coverImage, $coverImagePreview;

    protected $validationAttributes = [
        'name'        => 'nombre',
        'description' => 'descripción',
        'image'       => 'imagen miniatura',
        'coverImage'  => 'imagen de portada'
    ];

    public function openNewCategory()
    {
        $this->reset();

        $this->drawerTitle = "Nueva categoría";
        $this->dispatch('open-drawer');
    }

    public function openAddSubcategory(Category $categoryFather)
    {
        $this->reset();

        $this->fill([
            'drawerTitle'    => "Agregando subcategoría a $categoryFather->name",
            'categoryFather' => $categoryFather
        ]);

        $this->dispatch('open-drawer');
    }

    public function openEditCategory(Category $category)
    {
        $this->reset();

        $this->category = $category;

        $this->fill([
            'drawerTitle'       => "Editando categoría $category->name",
            'name'              => $category->name,
            'description'       => $category->description,
            'imagePreview'      => $category->image_url ? Storage::url($category->image_url) : null,
            'coverImagePreview' => $category->cover_image_url ? Storage::url($category->cover_image_url) : null
        ]);
        
        $this->dispatch('open-drawer');
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

        if ($this->category) 
        {
            $this->category->update([
                'name'            => $this->name,
                'description'     => $this->description,
            ]);

            $category = $this->category;

        } else {
            $category = Category::create([
                'name'            => $this->name,
                'description'     => $this->description,
                'category_father' => $this->categoryFather?->id
            ]);
        }

        if ($this->coverImage) {

            if ($category->cover_image_url)
                Storage::delete($this->category->cover_image_url);

            $coverImagePath = $this->coverImage->store(tenant('name') . '/categories');
            $category->update(['cover_image_url' => $coverImagePath]);
        }

        if ($this->image) {

            if ($category->image_url)
                Storage::delete($this->category->image_url);

            $imagePath = $this->image->store(tenant('name') . '/categories');
            $category->update(['image_url' => $imagePath]);
        }

        $this->reset();
        $this->dispatch('close-drawer');
    }

    public function cancelForm()
    {
        $this->reset();
        $this->dispatch('close-drawer');
    }

    public function openDeleteCategory(Category $category)
    {
        $this->category = $category;
        $this->dispatch('open-cancel-dialog');
    }

    public function deleteCategory()
    {
        $this->category->delete();
        $this->dispatch('close-cancel-dialog');
    }

    public function render()
    {
        return view('livewire.admin.categories.upsert', [
            'categories' => Category::principal()->with('childs')->orderBy('name')->paginate(7)
        ]);
    }
}
