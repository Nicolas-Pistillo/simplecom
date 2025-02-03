<?php

namespace App\Livewire\Ecommerce;

use App\Livewire\Forms\ProductFiltersForm;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Products extends Component
{
    use WithPagination;

    public ProductFiltersForm $form;

    public function loadProducts()
    {
        $products = Product::available();

        if ($this->form->category)
        {
            $products->where('category_id', $this->form->category->id);

            if ($this->form->category->hasChilds())
            {
                $childsId = $this->form->category->childs->pluck('id')->toArray();
                $products->orWhereIn('category_id', $childsId);

                $granchildsId = Category::whereIn('category_father', $childsId)->pluck('id')->toArray();
                $products->orWhereIn('category_id', $granchildsId);
            }
        }

        $products->orderByType($this->form->order);

        return $products->paginate(9);
    }

    public function setCategory(Category $category)
    {
        $category->load('father', 'childs');

        $this->form->categoryQuery = Str::slug($category->id . '-' . $category->name);
        $this->form->category = $category;
    }

    public function updateForm()
    {
        $this->resetPage();
    }

    public function mount()
    {
        if ($this->form->categoryQuery)
        {
            $categoryId = explode('-', $this->form->categoryQuery)[0];

            $category = Category::with('father', 'childs')->find($categoryId);

            if ($category instanceof Category)
            {
                $this->form->category = $category;
            }
        }
    }

    public function render()
    {
        return view('livewire.ecommerce.products', [
            'products' => $this->loadProducts()
        ]);
    }
}
