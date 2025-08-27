<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductFiltersForm extends Form
{
    public $category, $brand, $collection;

    #[Url(as: 'orden')]
    public $order = 'relevants';

    #[Url(as: 'categoria')]
    public $category_query;

    #[Url(as: 'marca')]
    public $brand_query;

    #[Url(as: 'coleccion')]
    public $collection_query;
    
    #[Url(as: 'precio_minimo')]
    public $min_price;
    
    #[Url(as: 'precio_maximo')]
    public $max_price;

    public function hasFilters()
    {
        return !empty($this->category) || !empty($this->brand) || !empty($this->collection) || 
               !empty($this->min_price) || !empty($this->max_price);
    }
}
