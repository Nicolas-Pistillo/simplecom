<?php

namespace App\Livewire\Ecommerce\Customer\Settings;

use App\Enums\TaxCondition;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Invoicing extends Component
{
    use WithNotifications;

    #[Validate(['required', new Enum(TaxCondition::class)], as: 'condición fiscal')]
    public $tax_condition;

    #[Validate('required|min:6', as: 'dirección fiscal')]
    public $invoice_address;

    #[Validate(as: 'razón social')]
    public $invoice_social_reason;

    #[Validate(as: 'CUIT')]
    public $invoice_document;

    public function mount()
    {
        $this->fill([
            'tax_condition'         => Auth::user()->tax_condition ?? TaxCondition::ConsumidorFinal->value,
            'invoice_address'       => Auth::user()->invoice_address,
            'invoice_social_reason' => Auth::user()->invoice_social_reason ?? Auth::user()->full_name,
            'invoice_document'      => Auth::user()->invoice_document,
        ]);
    }

    public function save()
    {
        $this->validate();

        if (TaxCondition::needsInvoiceA($this->tax_condition)) 
        {
            $this->validate([
                'invoice_document'      => 'required|numeric|cuit',
                'invoice_social_reason' => 'required|min:3',
            ]);
        }

        Auth::user()->update([
            'tax_condition'         => $this->tax_condition,
            'invoice_address'       => $this->invoice_address,
            'invoice_social_reason' => $this->invoice_social_reason,
            'invoice_document'      => $this->invoice_document,
        ]);

        $this->notify([
            'type'    => 'success',
            'title'   => 'Datos de facturación actualizados correctamente'
        ]);

        $this->dispatch('close-edit-invoicing');
    }

    public function render()
    {
        return view('livewire.ecommerce.customer.settings.invoicing');
    }
}
