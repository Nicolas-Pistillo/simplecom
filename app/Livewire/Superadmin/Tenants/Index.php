<?php

namespace App\Livewire\Superadmin\Tenants;

use App\Models\Tenant;
use Livewire\Component;

class Index extends Component
{
    public $notificationMessage;

    public function toggleActive(Tenant $tenant)
    {
        $tenant->update(['active' => !$tenant->active]);

        $actionTitle = $tenant->active ? 'activado' : 'desactivado';

        $this->notify("Comercio $actionTitle con éxito");
    }

    public function deleteTenant(Tenant $tenant)
    {
        $tenant->delete();
        $this->notify("Eliminaste el comercio $tenant->ecommerce_name");
    }

    public function notify($message)
    {
        $this->notificationMessage = $message;
        $this->dispatch('open-notification');
    }

    public function render()
    {
        return view('livewire.superadmin.tenants.index', [
            'tenants' => Tenant::with(['domains', 'plan', 'sector'])->get()
        ]);
    }
}
