<?php

namespace App\Livewire\Forms;

use App\Enums\DeliveryType;
use Illuminate\Support\Facades\Auth;
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

    public $show_rates_results, $show_dropoff_selection, $show_confirmation;

    public $selected_rate, $selected_branch;

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

    public function autocomplete()
    {
        if (Auth::check())
        {
            return $this->fill([
                'name'              => Auth::user()->name,
                'lastname'          => Auth::user()->lastname,
                'email'             => Auth::user()->email,
                'phone'             => Auth::user()->phone,
                'document'          => Auth::user()->document,
                'addresses'         => Auth::user()->addresses,
                'delivery_type'     => session('delivery_type') ?? DeliveryType::Shipping,
                'selected_address'  => session('selected_address'),
                'selected_rate'     => session('selected_rate'),
                'selected_branch'   => session('selected_branch')
            ]);
        }

        $this->fill([
            'name'              => session('guest_customer.name'),
            'lastname'          => session('guest_customer.lastname'),
            'email'             => session('guest_customer.email'),
            'phone'             => session('guest_customer.phone'),
            'document'          => session('guest_customer.document'),
            'addresses'         => collect(session('guest_customer.addresses')) ?? collect(),
            'delivery_type'     => session('delivery_type') ?? DeliveryType::Shipping,
            'selected_address'  => session('selected_address'),
            'selected_rate'     => session('selected_rate'),
            'selected_branch'   => session('selected_branch')
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
