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

        if ($this->form->category)
        {
            $categoryIds = [$this->form->category->id];
    
            if ($this->form->category->hasChilds()) 
            {
                $childsId = $this->form->category->childs->pluck('id')->toArray();
                $granchildsId = Category::whereIn('category_father', $childsId)->pluck('id')->toArray();
                $categoryIds = array_merge($categoryIds, $childsId, $granchildsId);
            }
            
            $products->whereIn('category_id', $categoryIds);
        }

        if ($this->form->brand)
        {
            $products->where('brand_id', $this->form->brand->id);
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
        $this->resetBrandFilter();

        $this->form->category_query = Str::slug($category->id . '-' . $category->name);
        $this->form->category = $category;

        $this->setPage(1);
    }

    public function setBrand(Brand $brand)
    {
        $this->form->brand_query = Str::slug($brand->id . '-' . $brand->name);
        $this->form->brand = $brand;

        $this->setPage(1);
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
        $this->form->reset('brand', 'brand_query');
    }

    public function mount()
    {
        if ($this->form->category_query)
        {
            $categoryId = explode('-', $this->form->category_query)[0];

            $category = Category::with('father', 'childs')->find($categoryId);

            if ($category instanceof Category)
            {
                $this->form->category = $category;
            }
        }

        if ($this->form->brand_query)
        {
            $brandId = explode('-', $this->form->brand_query)[0];

            $brand = Brand::find($brandId);

            if ($brand instanceof Brand)
            {
                $this->form->brand = $brand;
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
