<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\ProductForm;
use App\Models\Attribute;
use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Tag;
use App\Models\VariantOption;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Upsert extends Component
{
    use WithFileUploads, WithNotifications;

    public ProductForm $form;
    public $product;

    public $calculatedStock = false;

    public $tagSearch = '';
    public $images = [];
    public $variants = [];
    public $selectedTags = [];
    public $selectedAttributes = [];
    public $selectedBrand;

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

    public function selectBrand(Brand $brand)
    {
        $this->selectedBrand = $brand;
    }

    public function removeBrand()
    {
        $this->reset('selectedBrand');
    }

    public function toggleVariantAttribute(Attribute $attribute, bool $append)
    {
        if ($append)
        {
            array_push($this->selectedAttributes, $attribute);

            if (empty($this->variants)) return $this->addVariant();

            if (!empty($this->variants))
            {
                $newArr = [];

                foreach($this->variants as $variant)
                {
                    $variant['attributes'][$attribute->id] = null;
                    array_push($newArr, $variant);
                }

                $this->variants = $newArr;
            }
            return;
        }

        foreach($this->selectedAttributes as $key => $attributeItem)
        {
            if (!empty($this->variants))
            {
                $newArr = [];

                foreach($this->variants as $variant)
                {
                    unset($variant['attributes'][$attribute->id]);
                    array_push($newArr, $variant);
                }

                $this->variants = $newArr;
            }

            if ($attributeItem->name === $attribute->name)
            {
                unset($this->selectedAttributes[$key]);
                return;
            }
        }
    }

    public function addVariant()
    {
        $newVariant = [
            'attributes' => [],
            'stock' => 0
        ];

        foreach($this->selectedAttributes as $attribute)
        {
            $newVariant['attributes'][$attribute->id] = null;
        }

        array_push($this->variants, $newVariant);
    }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
    }

    public function save()
    {
        $this->validate();

        if (!empty($this->variants))
        {
            $this->validate([
                'variants.*.stock'        => 'integer|min:0',
                'variants.*.attributes'   => 'array|present',
                'variants.*.attributes.*' => 'required|exists:attribute_values,id'
            ]);
        }

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

        if (!empty($this->variants))
        {
            $this->upsertVariants($product);
        }

        if (!empty($this->selectedTags))
        {
            $product->tags()->sync($this->selectedTags);
        }

        if ($this->selectedBrand)
        {
            $product->update(['brand_id' => $this->selectedBrand->id]);
        }

        $actionPerformed = $product->wasRecentlyCreated ? 'product_created' : 'product_updated';
        return redirect()->route('admin.products.index')->with($actionPerformed, true);
    }

    public function upsertVariants(Product $product)
    {
        foreach($this->variants as $variant)
        {
            if (isset($variant['id']))
            {
                $productVariant = ProductVariant::find($variant['id']);

                $productVariant->update([
                    'stock'      => $variant['stock']
                ]);

                $productVariant->options()->delete();

            } else {
                $productVariant = ProductVariant::create([
                    'product_id' => $product->id,
                    'stock'      => $variant['stock']
                ]);
            }

            foreach($variant['attributes'] as $attributeId => $attributeValueId)
            {
                VariantOption::create(
                [
                    'product_id'   => $product->id,
                    'variant_id'   => $productVariant->id,
                    'attribute_id' => $attributeId,
                    'attribute_value_id' => $attributeValueId
                ]);
            }
        }
    }

    public function updateProduct()
    {
        $this->product->update($this->form->all());

        Log::channel('resources')->info('Producto actualizado', [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'product'     => $this->product
        ]);

        return $this->product;
    }

    public function storeNewProduct()
    {
        $product = Product::create($this->form->all());

        Log::channel('resources')->info('Nuevo producto', [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'product'     => $product
        ]);

        return $product;
    }

    public function calculateStockByVariants()
    {
        if (!empty($this->variants))
        {
            $this->calculatedStock = true;
            return $this->form->stock = array_sum(array_column($this->variants, 'stock'));;
        }

        $this->calculatedStock = false;
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

            $this->selectedBrand = $product->brand;

            if ($product->hasVariants())
            {
                $product->load('variants.options');

                $attributes = $product->getSelectableAttributes();
                $attributes->each(fn($attribute) => array_push($this->selectedAttributes, $attribute));

                foreach($product->variants as $variant)
                {
                    $variantItem = [
                        'id'         => $variant->id,
                        'attributes' => [],
                        'stock'      => $variant->stock,
                    ];

                    foreach($variant->options as $option)
                    {
                        $variantItem['attributes'][$option->attribute_id] = $option->attribute_value_id;
                    }

                    array_push($this->variants, $variantItem);
                }
            }
        }

        $this->form->created_by = Auth::id();
    }

    public function render()
    {
        $this->calculateStockByVariants();

        return view('livewire.admin.products.upsert', [
            'categories' => Category::principal()->with('childs')->orderBy('name')->get(),
            'tags'       => $this->getTags(),
            'brands'     => Brand::orderBy('name')->get(),
            'attributes' => Attribute::with('values')->get(),
            'selectedTagsModels' => Tag::find($this->selectedTags)
        ]);
    }
}
