<?php

namespace App\Livewire\Forms;

use App\Enums\DeliveryType;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CheckoutForm extends Form
{
    #[Validate('required|max:25', as: 'nombre')]
    public $name;

    #[Validate('required|max:30', as: 'apellido')]
    public $lastname;

    #[Validate('required|email', as: 'email')]
    public $email;

    #[Validate('required|size:10', as: 'telefono')]
    public $phone;

    #[Validate('required|numeric|min:1000000|max:999999999', as: 'dni')]
    public $document;

    #[Validate('required', as: 'tipo de entrega')]
    public $delivery_type = DeliveryType::Shipping;

    public $addresses, $selected_address;

    public $shipping_rates, $selected_shipping_rate;

    public $payment_methods, $selected_payment_method;

    public function hasCustomerData()
    {
        return isset($this->name, $this->lastname, $this->email, $this->phone, $this->document);
    }

    public function validateCustomerData()
    {
        return $this->validate([
            'name'       => 'required|max:25',
            'lastname'   => 'required|max:30',
            'email'      => 'required|email',
            'phone'      => 'required|size:10',
            'document'   => 'required|numeric|min:1000000|max:999999999',
        ]);
    }

    public function messages()
    {
        return [
            'document.min' => 'El dni debe tener al menos 7 digitos',
            'document.max' => 'El dni no puede tener más de 9 dígitos'
        ];
    }
}
