<?php

namespace App\Livewire\Admin\DeliveryMethods;

use App\Models\ShippingProvider;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class Upsert extends Component
{
    use WithNotifications;

    public $configuring_provider, $configuring_provider_keys;

    public function configProvider(ShippingProvider $provider)
    {
        $this->configuring_provider = $provider;
        $this->configuring_provider_keys = $provider->service()->getconfigurableFields()->toArray();

        $this->dispatch('open-provider-config');
    }

    public function saveProviderConfig()
    {
        dd($this->configuring_provider_keys);
    }

    public function render()
    {
        return view('livewire.admin.delivery-methods.upsert', [
            'shipping_providers' => ShippingProvider::orderBy('name')->get()
        ]);
    }
}
