<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\InvoiceItemAliquot;
use App\Enums\TaxCondition;
use App\Livewire\Forms\OrderInvoiceForm;
use App\Models\Order;
use Livewire\Attributes\Computed;
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

    #[Computed]
    public function subtotal()
    {
        return collect($this->form->items)->sum(function($item) 
        {
            $itemPrice = $item['unit_price'] * $item['quantity'];

            if ($item['discount'] > 0) 
            {
                $itemPrice -= $itemPrice * ($item['discount'] / 100);
            }
            
            return $itemPrice;
        });
    }

    #[Computed]
    public function totalIva()
    {
        $this->form->validateOnly('items');

        return collect($this->form->items)->sum(function($item) 
        {
            $itemPrice = $item['unit_price'] * $item['quantity'];

            if ($item['discount'] > 0) 
            {
                $itemPrice -= $itemPrice * ($item['discount'] / 100);
            }

            $aliquot = InvoiceItemAliquot::tryFrom($item['aliquot'])->numberValue();

            if ($aliquot <= 0) return 0;

            return $aliquot * $itemPrice / 100;
        });
    }

    #[Computed]
    public function total()
    {
        return $this->subtotal + $this->totalIva;
    }

    public function addItem()
    {
        $aliquot = TaxCondition::needsInvoiceA($this->form->tax_condition)
                    ? InvoiceItemAliquot::IVA21->value
                    : InvoiceItemAliquot::IVA0->value;

        array_push($this->form->items, [
            'code'         => null,
            'description'  => null,
            'quantity'     => null,
            'aliquot'      => $aliquot,
            'unit_price'   => null,
            'discount'     => 0
        ]);
    }

    public function removeItem($index)
    {
        unset($this->form->items[$index]);
        $this->form->items = array_values($this->form->items);
    }

    public function save()
    {
        $this->form->validate();

        dd($this->subtotal);

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
