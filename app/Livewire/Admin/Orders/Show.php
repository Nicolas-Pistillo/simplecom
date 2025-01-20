<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class Show extends Component
{
    public $order;

    public function mount($order)
    {
        $order = Order::find($order) ?? abort(404);

        $order->load(
            'items.variant.options.attribute', 'items.variant.options.attributeValue',
            'status', 'shipping.status', 'payment.status', 'user', 'feed', 
            'shippingProvider', 'paymentMethod', 'shipping'
        );

        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.admin.orders.show');
    }
}
