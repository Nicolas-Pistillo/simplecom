<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class Index extends Component
{
    public $search;

    public function getOrders()
    {
        return Order::orderBy('created_at', 'DESC')->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.orders.index', [
            'orders' => $this->getOrders()
        ]);
    }
}
