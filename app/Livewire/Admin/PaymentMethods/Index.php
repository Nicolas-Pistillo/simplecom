<?php

namespace App\Livewire\Admin\PaymentMethods;

use App\Models\PaymentMethod;
use Livewire\Component;

class Index extends Component
{
    public $payment_methods;

    public $drawerTitle; 
    public $method_editing, $checkout_name, $configurable_fields;

    public function mount()
    {
        $this->payment_methods = PaymentMethod::all();
    }

    public function openConfiguration(PaymentMethod $method)
    {
        $this->method_editing = $method;
        $this->checkout_name = $method->checkout_name;
        $this->configurable_fields = $method->service()->getconfigurableFields()->toArray();

        $this->drawerTitle = $method->display_name;

        $this->dispatch('open-drawer');
    }

    public function save()
    {
        dd($this->configurable_fields, $this->checkout_name);
    }

    public function cancel()
    {
        $this->reset('drawerTitle', 'method_editing', 'configurable_fields');
        $this->dispatch('close-drawer');
    }

    public function render()
    {
        return view('livewire.admin.payment-methods.index');
    }
}
