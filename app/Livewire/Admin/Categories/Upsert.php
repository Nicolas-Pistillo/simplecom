<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class Upsert extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WithNotifications;

    public $drawerTitle, $drawerRef;
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
        $this->drawerTitle = "Nueva categoría";
        $this->dispatch('open-drawer');
    }

    public function openAddSubcategory(Category $categoryFather)
    {
        $this->resetDrawer();

        $this->fill([
            'drawerTitle'    => "Agregar subcategoría a $categoryFather->name",
            'categoryFather' => $categoryFather,
            'published'      => true
        ]);

        $this->dispatch('open-drawer');
    }

    public function openEdit(Category $category)
    {
        $this->resetDrawer();

        $this->category = $category;

        $this->fill([
            'drawerTitle'       => "$category->name",
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

    public function togglePublished(Category $category)
    {
        $category->update(['published' => !$category->published]);

        $actionTitle = $category->published ? 'Publicaste' : 'Despublicaste';

        $this->notify([
            'type'  => 'success',
            'title' => "$actionTitle la categoría $category->name"
        ]);
    }

    public function toggleFeatured(Category $category)
    {
        $category->update(['featured' => !$category->featured]);

        $actionTitle = $category->featured ? 'Destacaste' : 'Removiste de destacados';

        $this->notify([
            'type'  => 'success',
            'title' => "$actionTitle la categoría $category->name"
        ]);
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
                'name'            => trim($this->name),
                'description'     => empty(trim($this->description)) ? null : trim($this->description),
                'published'       => $this->published ? true : false,
                'featured'        => $this->featured ? true : false,
            ]);

            $category = $this->category;

        } else {
            $category = Category::create([
                'name'            => trim($this->name),
                'description'     => empty(trim($this->description)) ? null : trim($this->description),
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
        $this->dispatch('reorder');

        $this->notify([
            'type'  => 'success',
            'title' => "Cambios aplicados con éxito"
        ]);
    }

    public function cancelForm()
    {
        $this->dispatch('close-drawer');
        $this->resetDrawer();
    }

    public function openDelete(Category $category)
    {
        $this->category = $category;
        $this->dispatch('open-delete-dialog');
    }

    public function delete()
    {
        $this->category->delete();
        $this->dispatch('close-delete-dialog');

        $this->notify([
            'type'  => 'success',
            'title' => "Eliminaste la categoría {$this->category->name}"
        ]);

        Log::channel('resources')->info("Categoría eliminada", [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'category'    => $this->category
        ]);

        $this->setPage(1);
    }

    public function mount()
    {
        $this->hasCategories = Category::count() > 0;
    }

    public function getCategories()
    {
        $categories = Category::principal()->with('childs.childs')->orderBy('order');
        return $categories->get();       
    }

    #[On('categoriesReordered')]
    public function updateOrder($tree)
    {
        if (empty($tree)) return;

        foreach($tree as $category)
        {
            Category::find($category['id'])?->update([
                'category_father' => $category['parent_id'],
                'order' => $category['order'],
            ]);

            if (!empty($category['children']))
            {
                foreach($category['children'] as $childCategory)
                {
                    Category::find($childCategory['id'])?->update([
                        'category_father' => $childCategory['parent_id'],
                        'order' => $childCategory['order']
                    ]);

                    if (!empty($childCategory['children']))
                    {
                        foreach($childCategory['children'] as $grandChildCategory)
                        {
                            Category::find($grandChildCategory['id'])?->update([
                                'category_father' => $grandChildCategory['parent_id'],
                                'order' => $grandChildCategory['order']
                            ]);
                        }
                    }
                }
            }
        }

        $this->dispatch('reorder');
    }

    public function render()
    {
        return view('livewire.admin.categories.upsert', [
            'categories' => $this->getCategories(),
            'emptyData'  => Category::count() === 0
        ]);
    }
}
