<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    // ----- Fields -----
    #[Validate('nullable|boolean')]
    public $published = false;

    #[Validate('nullable|boolean')]
    public $featured = false;

    #[Validate('required|min:3|max:70', as: 'nombre')]
    public $name;

    #[Validate('nullable|string', as: 'código')]
    public $code;

    #[Validate('required|exists:categories,id', as: 'categoría')]
    public $category_id;

    #[Validate('nullable|exists:brands,id', as: 'marca')]
    public $brand_id;

    #[Validate('nullable|string|max:2400', as: 'descripción')]
    public $description;

    #[Validate('required|numeric|max:99999999|not_in:0', as: 'precio')]
    public $price;

    #[Validate('nullable|numeric|max:99999999', as: 'costo')]
    public $unit_cost;

    #[Validate('nullable|numeric|integer|max:100|not_in:0', as: 'descuento')]
    public $discount_percent;

    #[Validate('nullable|numeric|integer|not_in:0', as: 'compra mínima')]
    public $min_sale = 1;

    #[Validate('nullable|numeric|integer|not_in:0', as: 'compra máxima')]
    public $max_sale;
        
    #[Validate('required|numeric|integer')]
    public $stock = 0;

    #[Validate('required|numeric|not_in:0', as: 'peso')]
    public $weight;

    #[Validate('required|integer|exists:operators,id', as: 'peso')]
    public $created_by;

    #[Validate('required|numeric|not_in:0', as: 'ancho')]
    public $width;

    #[Validate('required|numeric|not_in:0', as: 'alto')]
    public $height;

    #[Validate('required|numeric|not_in:0', as: 'largo')]
    public $length;

    // ----- Custom error messages -----
    public function messages()
    {
        return [
            'stock.required'            => 'El stock es obligatorio',
            'price.not_in'              => 'El precio no puede ser 0',
            'discount_percent.not_in'   => 'El descuento no puede ser 0',
            'min_sale.not_in'           => 'La compra mínima no puede ser 0',
            'max_sale.not_in'           => 'La compra máxima no puede ser 0',
            'weight.not_in'             => 'El peso no puede ser 0',
            'width.not_in'              => 'El ancho no puede ser 0',
            'height.not_in'             => 'El alto no puede ser 0',
            'length.not_in'             => 'El largo no puede ser 0'
        ];
    }

    public function autocomplete(Product $product)
    {
        $this->fill([
            'published'        => $product->published,
            'featured'         => $product->featured,
            'name'             => $product->name,
            'description'      => $product->description,
            'code'             => $product->code,
            'category_id'      => $product->category_id,
            'brand_id'         => $product->brand_id,
            'price'            => $product->price,
            'unit_cost'        => $product->unit_cost,
            'discount_percent' => $product->discount_percent,
            'min_sale'         => $product->min_sale,
            'max_sale'         => $product->max_sale,
            'stock'            => $product->stock,
            'width'            => $product->width,
            'height'           => $product->height,
            'length'           => $product->length,
            'weight'           => $product->weight,
            'created_by'       => $product->created_by
        ]);
    }
}
