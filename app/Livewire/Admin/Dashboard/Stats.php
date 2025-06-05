<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class Stats extends Component
{
    public function getAverageTicket()
    {
        return Order::paid()->sum('total') / Order::paid()->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.stats', [
            'averageTicket' => $this->getAverageTicket(),
            'lastOrders'    => Order::with('user')->orderBy('created_at', 'DESC')->take(5)->get(),
            'lastCustomers' => User::orderBy('created_at')->take(5)->get()
        ]);
    }
}
