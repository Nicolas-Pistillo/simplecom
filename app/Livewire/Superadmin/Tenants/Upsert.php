<?php

namespace App\Livewire\Superadmin\Tenants;

use App\Livewire\Forms\TenantForm;
use App\Models\Operator;
use App\Models\Sector;
use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Upsert extends Component
{
    public $tenant;

    public TenantForm $form;

    public function mount($tenant = false)
    {
        $this->tenant = Tenant::find($tenant);
        $this->form->initialize($this->tenant);
    }

    public function save()
    {
        $this->form->validate();

        return;

        $tenant = Tenant::updateOrCreate(['name' => $this->form->code], [
            'social_reason'    => $this->form->social_reason,
            'tax_condition'    => $this->form->tax_condition,
            'invoice_document' => $this->form->invoice_document,
            'invoice_address'  => $this->form->invoice_address,
            'ecommerce_name'   => $this->form->ecommerce_name,
            'sector_id'        => $this->form->sector,
            'email'            => $this->form->email
        ]);

        $currentDomain = $tenant->domains?->first();

        if (!$currentDomain)
        {
            $tenant->domains()->create(['domain' => $this->form->domain]);

        } else if ($currentDomain && $currentDomain->domain != $this->form->domain)
        {
            $currentDomain->update(['domain' => $this->form->domain]);
        }

        $tenant->run(function() 
        {
            if (empty(Operator::all()))
            {
                Operator::create([
                    'name'     => $this->form->operator_name,
                    'email'    => $this->form->email,
                    'password' => Hash::make($this->form->invoice_document)
                ])->assignRole('Administrador');
            }
        });

        return to_route('superadmin.tenants.index')->with('tenant_saved', true);
    }

    public function render()
    {
        return view('livewire.superadmin.tenants.upsert', [
            'sectors' => Sector::orderBy('name')->get(),
        ]);
    }
}
