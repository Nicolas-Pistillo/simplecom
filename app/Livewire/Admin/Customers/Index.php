<?php

namespace App\Livewire\Admin\Customers;

use App\Models\User;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithNotifications;

    public $search = '';

    public bool $has_customers;

    public function getCustomers()
    {
        return User::paginate(15);
    }

    public function mount()
    {
        $this->has_customers = User::count() > 0;
    }

    public function render()
    {
        return view('livewire.admin.customers.index', [
            'customers' => $this->getCustomers(),
        ]);
    }
}
