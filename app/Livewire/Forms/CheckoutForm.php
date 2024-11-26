<?php

namespace App\Livewire\Forms;

use App\Enums\DeliveryType;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CheckoutForm extends Form
{
    #[Validate('required|max:25', as: 'nombre')]
    public $customer_name;

    #[Validate('required|max:30', as: 'apellido')]
    public $customer_lastname;

    #[Validate('required|email', as: 'email')]
    public $customer_email;

    #[Validate('required|numeric', as: 'cod. de área')]
    public $customer_phone_area;

    #[Validate('required|numeric', as: 'telefono')]
    public $customer_phone;

    #[Validate('required', as: 'dni')]
    public $customer_document;

    #[Validate('required|numeric', as: 'código postal')]
    public $customer_postal_code;

    #[Validate('required|numeric', as: 'dirección')]
    public $address_id;

    #[Validate('required', as: 'tipo de entrega')]
    public $delivery_type = DeliveryType::Picking;
}
