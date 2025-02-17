<?php

namespace App\Livewire\Admin\Orders;

use App\Livewire\Forms\OrderInvoiceForm;
use App\Models\Order;
use Livewire\Component;

class NewInvoice extends Component
{
    public Order $order;
    public OrderInvoiceForm $form;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->form->autocomplete($order);
    }

    public function addItem()
    {
        array_push($this->form->items, [
            'code'         => null,
            'description'  => null,
            'quantity'     => null,
            'aliquot'      => null,
            'unit_price'   => null
        ]);
    }

    public function save()
    {
        $this->form->validate();

        dd("PASO TODO", $this->form->all());

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

    public function render()
    {
        return view('livewire.admin.orders.new-invoice');
    }
}
