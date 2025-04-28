<?php

namespace App\Livewire\Superadmin\Tenants;

use App\Livewire\Forms\TenantForm;
use App\Models\Sector;
use Livewire\Component;

class Upsert extends Component
{
    public $tenant;

    public TenantForm $form;

    public function mount($tenant = false)
    {
        
    }

    public function render()
    {
        return view('livewire.superadmin.tenants.upsert', [
            'sectors' => Sector::orderBy('name')->get(),
        ]);
    }
}
