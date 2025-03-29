<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductFiltersForm extends Form
{
    public $category;

    #[Url(as: 'orden')]
    public $order = 'relevants';

    #[Url(as: 'categoria')]
    public $categoryQuery;
    
    #[Url(as: 'precio_minimo')]
    public $min_price;
    
    #[Url(as: 'precio_maximo')]
    public $max_price;
}
