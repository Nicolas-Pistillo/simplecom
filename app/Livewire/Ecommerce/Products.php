<?php

namespace App\Livewire\Ecommerce;

use App\Livewire\Forms\ProductFiltersForm;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCollection;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Products extends Component
{
    use WithPagination;

    public ProductFiltersForm $form;

    public $available_brands;
    public $available_collections;

    public function loadProducts()
    {
        $products = Product::available();

        if ($this->form->category) {
            $categoryIds = [$this->form->category->id];

            if ($this->form->category->hasChilds()) {
                $childsId = $this->form->category->childs()->pluck('id')->toArray();
                $granchildsId = Category::whereIn('category_father', $childsId)->pluck('id')->toArray();
                $categoryIds = array_merge($categoryIds, $childsId, $granchildsId);
            }

            $products->whereIn('category_id', $categoryIds);
        }

        if ($this->form->brand) {
            $products->where('brand_id', $this->form->brand->id);
        }

        if ($this->form->collection) {
            $products->whereHas('collections', function ($query) {
                $query->where('product_collections.id', $this->form->collection->id);
            });
        }

        if (!empty($this->form->min_price)) {
            $products->where('price', '>=', $this->form->min_price);
        }

        if (!empty($this->form->max_price)) {
            $products->where('price', '<=', $this->form->max_price);
        }

        $products->orderByType($this->form->order);

        $results = $products->get();

        $this->available_brands = $results->pluck('brand')->filter(fn($item) => $item != null)->unique('id');

        $this->available_collections = ProductCollection::where('active', true)
                                        ->whereHas('products', function ($query) use ($results) 
                                        {
                                            $query->whereIn('product_id', $results->pluck('id'));
                                        })
                                        ->get()
                                        ->unique('id');

        return $products->paginate(24);
    }

    public function setCategory(Category $category)
    {
        $category->load('father', 'childs');

        /* $this->resetBrandFilter();
        $this->resetCollectionFilter(); */

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

    public function setCollection(ProductCollection $collection)
    {
        $this->form->collection_query = Str::slug($collection->id . '-' . $collection->name);
        $this->form->collection = $collection;

        $this->setPage(1);
    }

    public function updatedForm()
    {
        $this->setPage(1);
    }

    public function resetFilters()
    {
        $this->form->reset();
    }

    public function resetPriceFilter()
    {
        $this->form->reset('min_price', 'max_price');
    }

    public function resetMinPriceFilter()
    {
        $this->form->reset('min_price');
    }

    public function resetMaxPriceFilter()
    {
        $this->form->reset('max_price');
    }

    public function resetCategoryFilter()
    {
        $this->form->reset('category', 'category_query');
    }

    public function resetBrandFilter()
    {
        $this->form->reset('brand', 'brand_query');
    }
    
    public function resetCollectionFilter()
    {
        $this->form->reset('collection', 'collection_query');
    }

    public function mount()
    {
        if ($this->form->category_query) {
            $categoryId = explode('-', $this->form->category_query)[0];

            $category = Category::with('father', 'childs')->find($categoryId);

            if ($category instanceof Category) {
                $this->form->category = $category;
            }
        }

        if ($this->form->brand_query) {
            $brandId = explode('-', $this->form->brand_query)[0];

            $brand = Brand::find($brandId);

            if ($brand instanceof Brand) {
                $this->form->brand = $brand;
            }
        }

        if ($this->form->collection_query)
        {
            $collectionId = explode('-', $this->form->collection_query)[0];

            $collection = ProductCollection::find($collectionId);

            if ($collection instanceof ProductCollection) {
                $this->form->collection = $collection;
            }
        }
    }

    public function render()
    {
        return view('livewire.ecommerce.products', [
            'products' => $this->loadProducts(),
            'hasFilters' => $this->form->hasFilters()
        ]);
    }
}
