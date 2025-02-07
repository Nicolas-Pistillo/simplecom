<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\OrderStatusCode;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    use WithNotifications;

    public $order;

    public function mount($order)
    {
        $order = Order::find($order) ?? abort(404);

        $order->load(
            'items.variant.options.attribute', 'items.variant.options.attributeValue',
            'status', 'storePickup', 'shipping.status', 'payment.status', 'user', 'feed', 
            'shippingProvider', 'paymentMethod', 'shipping'
        );

        $this->order = $order;
    }

    public function setReadyForPickup()
    {
        $this->order->update(['status_code' => OrderStatusCode::PickupReady]);

        OrderFeedItem::create([
            'order_id'      => $this->order->id,
            'event'         => OrderFeedEvent::StatusUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => Auth::user()->name,
            'action'        => "marcó el pedido como listo para retirar en {$this->order->storePickup->name}",
            'meta'          => [
                'icon_code'  => 'inventory',
                'icon_color' => 'indigo'
            ]
        ]);

        $this->dispatch('close-confirm-pickup-ready');

        $this->notify([
            'type'  => 'success',
            'title' => 'Pedido actualizado',
            'body'  => "¡Todo listo! ya notificamos a {$this->order->user->name} para que pase retirar el pedido"
        ]);
    }

    public function createShippingOrder()
    {
        $service = $this->order->shippingProvider->service();

        $service->createOrder($this->order);
    }

    public function render()
    {
        return view('livewire.admin.orders.show');
    }
}
