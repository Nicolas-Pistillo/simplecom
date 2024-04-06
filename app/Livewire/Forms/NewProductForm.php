<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class NewProductForm extends Form
{
    #[Validate('required|min:3|max:40')]
    public $name;

    #[Validate('nullable|string')]
    public $code;

    #[Validate('required|exists:categories,id')]
    public $category_id;

    #[Validate('nullable|string|max:100')]
    public $short_description;

    #[Validate('nullable|string|max:700')]
    public $description;

    #[Validate('required|numeric|max:99999999|not_in:0')]
    public $price;

    #[Validate('nullable|numeric|integer|max:100|not_in:0')]
    public $discount_percent;

    #[Validate('nullable|numeric|integer|not_in:0')]
    public $min_selling = 1;

    #[Validate('nullable|numeric|integer|not_in:0')]
    public $max_selling;

    #[Validate('nullable|numeric|integer')]
    public $stock;

    #[Validate('required|numeric|not_in:0')]
    public $weight;

    #[Validate('required|numeric|not_in:0')]
    public $width;

    #[Validate('required|numeric|not_in:0')]
    public $height;

    #[Validate('required|numeric|not_in:0')]
    public $length;

    protected $validationAttributes = [
        'name'              => 'nombre',
        'code'              => 'código',
        'category_id'       => 'categoría',
        'short_description' => 'descripción breve',
        'description'       => 'descripción',
        'price'             => 'precio',
        'discount_percent'  => 'descuento',
        'min_selling'       => 'compra mínima',
        'max_selling'       => 'compra máxima',
        'weight'            => 'peso',
        'width'             => 'ancho',
        'height'            => 'alto',
        'length'            => 'largo'
    ];
}
