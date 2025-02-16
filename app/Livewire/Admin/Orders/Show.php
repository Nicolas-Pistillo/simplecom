<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Livewire\Forms\OrderInvoiceForm;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Show extends Component
{
    use WithNotifications;

    public $order;

    public OrderInvoiceForm $invoiceForm;

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
            'action'        => "confirmó el pago por transferencia del comprador",
            'meta'          => [
                'icon_code'  => 'list_alt_check',
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

    public function createInvoice()
    {
        $reference = tenant('id') . '|' . $this->order->id;

        $client = [
            "documento_tipo" => "CUIT",
            "condicion_iva"  => "RI",
            "domicilio"      => "Av Sta Fe 23132",
            "condicion_pago" => "201",
            "documento_nro"  => "20423950316",
            "razon_social"   => "Juan Pedro KJL",
            "provincia"      => "2",
            "email"          => "email@dominio.com",
            "envia_por_mail" => "N"
        ];

        $receipt = [
            "rubro"                => "Sevicios web", 
            "tipo"                 => "FACTURA A", 
            "operacion"            => "V",
            "external_reference"   => $reference,
            "detalle"              => [
                [
                    "cantidad" => 2,
                    "producto" => [
                        "descripcion"  => "Hosting pagina web",
                        "codigo"       => 37,
                        "leyenda"      => "Leyenda de ejemplo",
                        "unidad_bulto" => 1,
                        "alicuota"     => 21,
                        "precio_unitario_sin_iva" => 114.88
                    ]
                ]
            ],
            "fecha"                => date('d/m/Y'),
            "vencimiento"          => date('d/m/Y'),
            "rubro_grupo_contable" => "Sevicios",
            "total"                => 139.0,
            "cotizacion"           => 1,
            "moneda"               => "PES",
            "punto_venta"          => 678,
        ];

        dd([
            'apitoken'    => 'asd123',
            'apikey'      => '123asd',
            'usertoken'   => 'dsa321',
            'cliente'     => $client,
            'comprobante' => $receipt
        ]);
    }

    public function mount($order)
    {
        $order = Order::find($order) ?? abort(404);

        $order->load(
            'items.variant.options.attribute', 'items.variant.options.attributeValue',
            'storePickup', 'shipping.userAddress', 'payment', 'user', 'feed', 
            'shippingProvider', 'paymentMethod'
        );

        $this->order = $order;

        $this->invoiceForm->autocomplete($order);
    }

    public function render()
    {
        return view('livewire.admin.orders.show');
    }
}
