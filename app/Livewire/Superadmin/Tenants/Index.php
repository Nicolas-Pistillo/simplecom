<?php

namespace App\Livewire\Superadmin\Tenants;

use App\Models\Tenant;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class Index extends Component
{
    use WithNotifications;

    public function toggleActive(Tenant $tenant)
    {
        $tenant->update(['active' => !$tenant->active]);

        $actionTitle = $tenant->active ? 'activado' : 'desactivado';

        $this->notify([
            'type'  => 'success',
            'title' => "Comercio $actionTitle"
        ]);
    }

    public function deleteTenant(Tenant $tenant)
    {
        $tenant->delete();
        
        $this->notify([
            'type'  => 'success',
            'title' => "Eliminaste el comercio $tenant->ecommerce_name"
        ]);
    }

    public function render()
    {
        return view('livewire.superadmin.tenants.index', [
            'tenants' => Tenant::with(['domains', 'sector'])->get()
        ]);
    }
}
