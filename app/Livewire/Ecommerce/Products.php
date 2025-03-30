<?php

namespace App\Livewire\Ecommerce;

use App\Livewire\Forms\ProductFiltersForm;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Products extends Component
{
    use WithPagination;

    public ProductFiltersForm $form;

    public $available_brands;

    public function loadProducts()
    {
        $products = Product::available();

        if ($this->form->category && !$this->form->brand)
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

        if ($this->form->brand)
        {
            $products->where('brand_id', $this->form->brand);
        }

        $products->orderByType($this->form->order);

        if (!empty($this->form->min_price))
        {
            $products->where('price', '>=', $this->form->min_price);
        }

        if (!empty($this->form->max_price))
        {
            $products->where('price', '<=', $this->form->max_price);
        }

        $this->available_brands = $products->get()->pluck('brand')->unique('id');

        return $products->paginate(24);
    }

    public function setCategory(Category $category)
    {
        $category->load('father', 'childs');

        $this->form->brand = null;
        $this->form->categoryQuery = Str::slug($category->id . '-' . $category->name);
        $this->form->category = $category;

        $this->setPage(1);
    }

    public function setBrand(Brand $brand)
    {
        $this->form->brand = $brand->id;
    }

    public function updatedForm()
    {
        $this->setPage(1);
    }

    public function resetPriceFilter()
    {
        $this->form->reset('min_price', 'max_price');
    }

    public function resetBrandFilter()
    {
        $this->form->reset('brand');
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
