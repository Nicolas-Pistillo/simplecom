<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Upsert extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $drawerTitle, $drawerRef, $notificationMessage, $search = '';
    public $category, $categoryFather;
    public $name, $description, $image, $imagePreview, $coverImage, $coverImagePreview;
    public $featured, $published;
    public $hasCategories;

    protected $validationAttributes = [
        'name'        => 'nombre',
        'description' => 'descripción',
        'image'       => 'imagen miniatura',
        'coverImage'  => 'imagen de portada'
    ];

    private function resetDrawer()
    {
        $this->resetExcept('notificationMessage', 'search', 'drawerTitle');
    }

    public function openNewCategory()
    {
        $this->resetDrawer();

        $this->published = true;
        $this->drawerTitle = "Nueva categoría principal";
        $this->dispatch('open-drawer');
    }

    public function openAddSubcategory(Category $categoryFather)
    {
        $this->resetDrawer();

        $this->fill([
            'drawerTitle'    => "Agregando subcategoría a $categoryFather->name",
            'categoryFather' => $categoryFather,
            'published'      => true
        ]);

        $this->dispatch('open-drawer');
    }

    public function openEditCategory(Category $category)
    {
        $this->resetDrawer();

        $this->category = $category;

        $this->fill([
            'drawerTitle'       => "Editando categoría $category->name",
            'name'              => $category->name,
            'description'       => $category->description,
            'published'         => $category->published ? true : false,
            'featured'          => $category->featured ? true : false,
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

    public function deleteImage()
    {
        if ($this->category?->image_url)
        {
            Storage::delete($this->category->image_url);
            $this->category->update(['image_url' => null]);   
        }

        $this->image = null;
        $this->imagePreview = null;
    }

    public function deleteCoverImage()
    {
        if ($this->category?->cover_image_url)
        {
            Storage::delete($this->category->cover_image_url);
            $this->category->update(['cover_image_url' => null]);   
        }

        $this->coverImage = null;
        $this->coverImagePreview = null;
    }

    public function save()
    {
        $this->validate([
            'name'        => 'required|string|max:30',
            'description' => 'nullable|string|max:150',
            'image'       => 'nullable|image|max:1024',
            'coverImage'  => 'nullable|image|max:1024'
        ]);

        $logTitle = "Nueva categoría";

        if ($this->category) 
        {
            $logTitle = "Categoría actualizada";

            $this->category->update([
                'name'            => $this->name,
                'description'     => $this->description,
                'published'       => $this->published ? true : false,
                'featured'        => $this->featured ? true : false,
            ]);

            $category = $this->category;

        } else {
            $category = Category::create([
                'name'            => $this->name,
                'description'     => $this->description,
                'published'       => $this->published ? true : false,
                'featured'        => $this->featured ? true : false,
                'category_father' => $this->categoryFather?->id
            ]);
        }

        if ($this->coverImage) {

            if ($category->cover_image_url)
                Storage::delete($this->category->cover_image_url);

            $coverImagePath = $this->coverImage->store(tenant('categories_url'));
            $category->update(['cover_image_url' => $coverImagePath]);
        }

        if ($this->image) {

            if ($category->image_url)
                Storage::delete($this->category->image_url);

            $imagePath = $this->image->store(tenant('categories_url'));
            $category->update(['image_url' => $imagePath]);
        }

        Log::channel('resources')->info($logTitle, [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'category'    => $category
        ]);

        $this->resetDrawer();
        $this->dispatch('close-drawer');

        $this->notificationMessage = 'Cambios aplicados con éxito';
        $this->dispatch('open-notification');
    }

    public function cancelForm()
    {
        $this->dispatch('close-drawer');
        $this->resetDrawer();
    }

    public function openDeleteCategory(Category $category)
    {
        $this->category = $category;
        $this->dispatch('open-delete-dialog');
    }

    public function deleteCategory()
    {
        $this->category->delete();
        $this->dispatch('close-delete-dialog');

        $this->notificationMessage = "Eliminaste la categoría {$this->category->name}";
        $this->dispatch('open-notification');

        Log::channel('resources')->info("Categoría eliminada", [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'category'    => $this->category
        ]);
    }

    public function mount()
    {
        $this->hasCategories = Category::count() > 0;
    }

    public function render()
    {
        $search = trim($this->search);

        $categories = Category::principal()
                        ->when(!empty($search), function($query) use ($search) {
                            return $query->where('name', 'LIKE', "%$search%")
                                        ->orWhere('description', 'LIKE', "%$search%")
                                        ->whereNull('category_father');
                        })
                        ->orderBy('name')
                        ->with('childs');

        return view('livewire.admin.categories.upsert', [
            'categories' => $categories->paginate(7),
            'emptyData'  => Category::count() === 0
        ]);
    }
}
