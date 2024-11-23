<?php

namespace App\Livewire\Admin\PaymentMethods;

use App\Models\PaymentMethod;
use Livewire\Component;

class Index extends Component
{
    public $payment_methods;

    public function mount()
    {
        $this->payment_methods = PaymentMethod::all();
    }

    public function render()
    {
        return view('livewire.admin.payment-methods.index');
    }
}
