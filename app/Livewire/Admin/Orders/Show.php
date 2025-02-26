<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Services\ShippingProviders\Rapiboy;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Show extends Component
{
    use WithNotifications;

    protected $listeners = ['order-invoice-created' => '$refresh'];

    public $order;

    public function confirmTransferReceived()
    {
        if ($this->order->status === OrderStatus::PaymentPending)
        {
            $this->order->update(['status' => OrderStatus::Confirmed]);
        }

        $this->order->payment->update(['status' => PaymentStatus::Confirmed]);

        OrderFeedItem::create([
            'order_id'      => $this->order->id,
            'event'         => OrderFeedEvent::StatusUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => Auth::user()->name,
            'action'        => "confirmó que recibió la transferencia por el pago del pedido",
            'meta'          => [
                'icon_code'  => 'price_check',
                'icon_color' => 'green'
            ]
        ]);

        $this->dispatch('close-show-transfer-confirm');

        $this->notify([
            'type'  => 'success',
            'title' => 'Pedido actualizado',
            'body'  => "Confirmaste la transferencia correctamente"
        ]);
    }

    public function setReadyForPickup()
    {
        $this->order->update(['status' => OrderStatus::PickupReady]);

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

    public function evalShippingOrderConfirmation()
    {
        /* if ($this->order->shipping->logistic_type->isFromDropoff())
        {
            $service = $this->order->shippingProvider->service();
            $branches = $service->getOriginPointBranches($this->order->shipping);

            dd($branches);
        } */

        $this->dispatch('open-confirm-shipping-create');
    }

    public function createShippingOrder()
    {
        try 
        {
            $service = $this->order->shippingProvider->service();

            $service->createOrder($this->order);

            $this->notify([
                'type'  => 'success',
                'title' => 'Orden de envío generada',
                'body'  => 'Generaste la orden de envío correctamente'
            ]);

            $this->dispatch('close-confirm-shipping-create');

        } catch (\Throwable $err) 
        {
            Log::channel('error')->error('Error al generar una orden de envío',
            [
                'pedido'  => $this->order->id,
                'mensaje' => $err->getMessage()
            ]);

            $this->dispatch('close-confirm-shipping-create');

            return $this->notify([
                'type'  => 'danger',
                'title' => 'Error al generar orden de envío',
                'body'  => $err->getMessage()
            ]);
        }
    }

    public function downloadOrderInvoice($ticket = false)
    {
        if ($ticket)
        {
            return Storage::download(
                $this->order->invoice->ticket_url, 
                "Ticket Pedido {$this->order->id}.pdf"
            );    
        }

        return Storage::download(
            $this->order->invoice->pdf_url, 
            "Factura Pedido {$this->order->id}.pdf"
        );
    }

    public function mount($order)
    {
        $order = Order::find($order) ?? abort(404);

        $order->load(
            'items.variant.options.attribute', 'items.variant.options.attributeValue',
            'storePickup', 'shipping.userAddress', 'payment', 'invoice', 
            'user', 'feed', 'shippingProvider', 'paymentMethod'
        );

        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.admin.orders.show');
    }
}
