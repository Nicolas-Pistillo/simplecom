<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class SelectOriginDropoff extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.admin.orders.select-origin-dropoff');
    }
}
