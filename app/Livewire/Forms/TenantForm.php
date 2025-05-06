<?php

namespace App\Livewire\Forms;

use App\Enums\TaxCondition;
use App\Models\Tenant;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TenantForm extends Form
{
    #[Validate('required|string|min:3|max:40', as: 'razón social')]
    public $social_reason;

    #[Validate(['required', new Enum(TaxCondition::class)], as: 'condición fiscal')]
    public $tax_condition;

    #[Validate('required|cuit', as: 'cuit-cuil')]
    public $invoice_document;

    #[Validate('required|string|min:3', as: 'domicilio fiscal')]
    public $invoice_address;

    #[Validate('required|string|min:3|max:40', as: 'nombre de comercio')]
    public $ecommerce_name;

    #[Validate('required|string|min:3|unique:tenants,name', as: 'código')]
    public $code;

    #[Validate('required|string|min:3', as: 'dominio')]
    public $domain;

    #[Validate('required|exists:sectors,id', as: 'rubro')]
    public $sector;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|string|max:30', as: 'nombre administrador')]
    public $operator_name;

    public function validateEdition()
    {
        $this->validate([
            'social_reason'    => 'required|string|min:3|max:40',
            'tax_condition'    => ['required', new Enum(TaxCondition::class)],
            'invoice_document' => 'required|cuit',
            'invoice_address'  => 'required|string|min:3',
            'code'             => 'required|string|min:3',
            'domain'           => 'required|string|min:3',
            'ecommerce_name'   => 'required|string|min:3|max:40',
            'sector'           => 'required|exists:sectors,id',
            'email'            => 'required|email'
        ]);
    }

    public function initialize($tenant = false)
    {
        if ($tenant instanceof Tenant)
        {
            $this->fill([
                'social_reason'     => $tenant->social_reason,
                'tax_condition'     => $tenant->tax_condition,
                'invoice_document'  => $tenant->invoice_document,
                'invoice_address'   => $tenant->invoice_address,
                'ecommerce_name'    => $tenant->ecommerce_name,
                'code'              => $tenant->name,
                'domain'            => $tenant->domain(),
                'sector'            => $tenant->sector_id,
                'email'             => $tenant->email
            ]);
        }
    }
}
