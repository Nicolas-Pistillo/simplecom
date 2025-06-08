<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\Order;
use App\Models\User;

class LastActivity extends Component
{
    public function getLastOrders()
    {
        return Order::with('user')->orderBy('created_at', 'DESC')->take(5)->get();
    }

    public function getLastCustomers()
    {
        return User::orderBy('created_at')->take(5)->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.last-activity', [
            'lastOrders'         => $this->getLastOrders(),
            'lastCustomers'      => $this->getLastCustomers()
        ]);
    }
}
