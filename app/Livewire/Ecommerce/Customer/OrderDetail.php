<?php

namespace App\Livewire\Ecommerce\Customer;

use App\Enums\CustomerType;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderDetail extends Component
{
    public $order;

    public function mount($order)
    {
        $model = Order::with('user')->find($order) ?? abort(404);

        if ($model->user->type === CustomerType::Registered && $model->user->id !== Auth::id())
        {
            session()->flash('login_required');
            $this->redirectRoute('ecommerce.index');
        }

        $model->load(
            'items.variant.options.attribute', 'items.variant.options.attributeValue',
            'storePickup', 'shipping.userAddress', 'payment', 'invoice', 
            'shippingProvider', 'paymentMethod'
        );

        $this->order = $model;
    }

    public function render()
    {
        return view('livewire.ecommerce.customer.order-detail');
    }
}
