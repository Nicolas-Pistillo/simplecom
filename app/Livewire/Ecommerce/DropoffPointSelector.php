<?php

namespace App\Livewire\Ecommerce;

use App\Livewire\Forms\CheckoutForm;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class DropoffPointSelector extends Component
{
    #[Reactive]
    public CheckoutForm $form;

    public $search;

    public function mount()
    {
        /* dd(session('rates_results.dropoff_rates')); */
    }

    public function render()
    {
        return view('livewire.ecommerce.dropoff-point-selector');
    }
}
