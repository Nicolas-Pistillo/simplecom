<?php

namespace App\Livewire\Forms;

use App\Enums\DeliveryType;
use App\Enums\OrderStatus;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class IndexOrdersFilters extends Form
{
    #[Validate(['nullable', new Enum(OrderStatus::class)], as: 'estado')]
    public $status;

    #[Validate(['nullable', new Enum(DeliveryType::class)], as: 'tipo de entrega')]
    public $delivery_type;

    #[Validate('nullable|boolean', as: 'facturados')]
    public $only_invoiced;

    public function isNotEmpty()
    {
        return !empty($this->status) || !empty($this->delivery_type) || $this->only_invoiced;
    }
}
