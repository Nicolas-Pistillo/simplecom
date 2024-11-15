<?php

namespace App\Livewire\Forms;

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

    #[Validate('required|numeric', as: 'telefono')]
    public $customer_phone;

    #[Validate('required|string', as: 'código de area')]
    public $customer_area_phone;

    #[Validate('required|numeric', as: 'dirección')]
    public $address_id;


}
