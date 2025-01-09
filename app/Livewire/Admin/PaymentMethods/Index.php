<?php

namespace App\Livewire\Admin\PaymentMethods;

use App\Models\Configuration;
use App\Models\PaymentMethod;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class Index extends Component
{
    use WithNotifications;

    public $payment_methods;

    public $drawerTitle; 
    public $method_editing, $checkout_name, $configurable_fields;

    public function openConfiguration(PaymentMethod $method)
    {
        $this->resetErrorBag();

        $this->method_editing = $method;
        $this->checkout_name = $method->checkout_name;
        $this->configurable_fields = $method->service()->getconfigurableFields()->toArray();

        $this->drawerTitle = $method->display_name;

        $this->dispatch('open-drawer');
    }

    public function toggleActivated(PaymentMethod $method)
    {
        $method->update(['active' => !$method->active]);

        $actionExecuted = $method->active ? 'Activaste' : 'Desactivaste';

        $this->notify([
            'type'  => 'success',
            'title' => "$actionExecuted esta forma de pago con éxito"
        ]);
    }

    public function save()
    {
        $checkout_name = trim($this->checkout_name);

        if (empty($checkout_name))
        {
            return $this->addError('checkout_name', 'El campo nombre público no puede estar vacio');
        }

        foreach($this->configurable_fields as $field)
        {
            if ($field['required'] && empty(trim($field['value'])))
            {
                return $this->addError($field['key'], "El campo {$field['display_name']} no puede estar vacío");
            }
        }

        $this->method_editing->update(['checkout_name' => $checkout_name]);

        foreach($this->configurable_fields as $field)
        {
            Configuration::find($field['id'])->update(['value' => $field['value']]);
        }

        $this->dispatch('close-drawer');
        
        $this->notify([
            'type'  => 'success',
            'title' => 'Configuración guardada con éxito'
        ]);
    }

    public function cancel()
    {
        $this->dispatch('close-drawer');
    }

    public function mount()
    {
        $this->payment_methods = PaymentMethod::orderBy('active', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.admin.payment-methods.index');
    }
}
