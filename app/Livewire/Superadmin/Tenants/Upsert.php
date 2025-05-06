<?php

namespace App\Livewire\Superadmin\Tenants;

use App\Enums\TaxCondition;
use App\Livewire\Forms\TenantForm;
use App\Mail\Welcome;
use App\Models\Operator;
use App\Models\Sector;
use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Enum;
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

    public function create()
    {
        $this->form->validate();

        $tenant = Tenant::create([
            'name'             => $this->form->code,
            'social_reason'    => $this->form->social_reason,
            'tax_condition'    => $this->form->tax_condition,
            'invoice_document' => $this->form->invoice_document,
            'invoice_address'  => $this->form->invoice_address,
            'ecommerce_name'   => $this->form->ecommerce_name,
            'sector_id'        => $this->form->sector,
            'email'            => $this->form->email,
            'tenancy_db_name'  => config('tenancy.database.prefix') . $this->form->code
        ]);

        $tenant->domains()->create(['domain' => $this->form->domain]);

        $tenant->run(function() 
        {
            Operator::create([
                'name'     => $this->form->operator_name,
                'email'    => $this->form->email,
                'password' => Hash::make($this->form->invoice_document)
            ])->assignRole('Administrador');
        });

        $welcomeMail = new Welcome($tenant, $this->form->email, $this->form->invoice_document);

        Mail::to($this->form->email)->send($welcomeMail);

        return to_route('superadmin.tenants.index')->with('tenant_created', true);
    }

    public function update()
    {
        $this->form->validateEdition();

        $this->tenant->update([
            'social_reason'    => $this->form->social_reason,
            'tax_condition'    => $this->form->tax_condition,
            'invoice_document' => $this->form->invoice_document,
            'invoice_address'  => $this->form->invoice_address,
            'ecommerce_name'   => $this->form->ecommerce_name,
            'sector_id'        => $this->form->sector,
            'email'            => $this->form->email
        ]);

        if ($this->form->domain != $this->tenant->domain())
        {
            $this->tenant->domains()->first()->delete();
            $this->tenant->domains()->create(['domain' => $this->form->domain]);
        }

        return to_route('superadmin.tenants.index')->with('tenant_updated', true);
    }

    public function save()
    {
        $this->tenant instanceof Tenant ? $this->update() : $this->create();
    }

    public function render()
    {
        return view('livewire.superadmin.tenants.upsert', [
            'sectors' => Sector::orderBy('name')->get(),
        ]);
    }
}
