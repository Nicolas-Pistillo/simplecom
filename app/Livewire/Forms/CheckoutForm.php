<?php

namespace App\Livewire\Forms;

use App\Enums\DeliveryType;
use App\Enums\TaxCondition;
use App\Models\PaymentMethod;
use App\Models\StorePickup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;
use ValueError;

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

    #[Validate('required')]
    public $tax_condition;

    #[Validate('required|min:6', as: 'dirección fiscal')]
    public $invoice_address;

    public $invoice_social_reason;
    public $invoice_document;

    #[Validate('required|numeric|min:1000000|max:999999999', as: 'dni')]
    public $document;

    #[Validate('required', as: 'tipo de entrega')]
    public $delivery_type;

    public $store_pickups, $selected_store_pickup;

    public $addresses, $selected_address;

    public $show_rates_results, $show_dropoff_selection, $show_selected_branch;

    public $selected_rate, $selected_branch, $selected_shipping_provider;

    public $payment_methods, $selected_payment_method;

    public function hasCustomerData()
    {
        return isset($this->name, $this->lastname, $this->email, $this->phone, $this->document);
    }

    public function validateCustomerData()
    { 
        $validationData = [
            'name'            => 'required|max:25',
            'lastname'        => 'required|max:30',
            'email'           => 'required|email',
            'phone'           => 'required|size:10',
            'invoice_address' => 'required|min:6',
            'tax_condition'   => ['required', Rule::in(TaxCondition::toArray())],
            'document'        => 'required|numeric|min:1000000|max:999999999',
        ];

        if ((in_array($this->tax_condition, ['monotributista', 'responsable_inscripto'])))
        {
            $validationData['invoice_document'] = 'required|cuit';
            $validationData['invoice_social_reason'] = 'required';
        }

        return $this->validate($validationData);
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
                'tax_condition'     => Auth::user()->tax_condition ?? TaxCondition::ConsumidorFinal->value,
                'invoice_address'   => Auth::user()->invoice_address,
                'invoice_social_reason' => Auth::user()->invoice_social_reason,
                'invoice_document'      => Auth::user()->invoice_document,
                'addresses'         => Auth::user()->addresses,
                'payment_methods'   => PaymentMethod::where('active', true)->get(),
                'store_pickups'     => StorePickup::where('active', true)->get(),
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
            'tax_condition'     => session('guest_customer.tax_condition') ?? TaxCondition::ConsumidorFinal->value,
            'invoice_address'   => session('guest_customer.invoice_address'),
            'invoice_social_reason' => session('guest_customer.invoice_social_reason'),
            'invoice_document'  => session('guest_customer.invoice_document'),
            'addresses'         => collect(session('guest_customer.addresses')) ?? collect(),
            'payment_methods'   => PaymentMethod::where('active', true)->get(),
            'store_pickups'     => StorePickup::where('active', true)->get(),
            'delivery_type'     => session('delivery_type') ?? DeliveryType::Shipping,
            'selected_address'  => session('selected_address'),
            'selected_rate'     => session('selected_rate'),
            'selected_branch'   => session('selected_branch')
        ]);
    }

    public function messages()
    {
        return [
            'document.min'                   => 'El dni debe tener al menos 7 digitos',
            'document.max'                   => 'El dni no puede tener más de 9 dígitos',
            'tax_condition.required'         => 'El campo condición fiscal es obligatorio',
            'tax_condition.in'               => 'Por favor seleccione una opción válida',
            'invoice_document.required'      => 'Por favor ingrese su CUIT',
            'invoice_social_reason.required' => 'El campo razón social es obligatorio',
        ];
    }
}
