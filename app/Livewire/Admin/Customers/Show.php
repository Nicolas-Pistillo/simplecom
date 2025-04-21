<?php

namespace App\Livewire\Admin\Customers;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public $customer;

    public function mount($customer)
    {
        $customer = User::with('orders', 'addresses')->find($customer);

        if (!$customer || !$customer instanceof User) abort(404);

        $this->customer = $customer;
    }

    public function render()
    {
        return view('livewire.admin.customers.show');
    }
}
