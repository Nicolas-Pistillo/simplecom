<?php 

namespace App\Services\InvoiceProviders;

use App\Enums\InvoiceItemAliquot;
use App\Enums\InvoicePayCondition;
use App\Enums\InvoiceType;
use App\Enums\TaxCondition;
use App\Livewire\Forms\OrderInvoiceForm;
use App\Models\Invoice;
use Illuminate\Support\Facades\Http;

class TusFacturas
{
    private $base_url = "https://www.tusfacturas.app/app/api";

    public function createOrderInvoice(OrderInvoiceForm $form)
    {
        $reference = tenant('id') . '|' . $form->order_id;

        $client = [
            "documento_tipo" => TaxCondition::needsInvoiceA($form->tax_condition) ? "CUIT" : "DNI",
            "documento_nro"  => $form->document,
            "condicion_iva"  => TaxCondition::tryFrom($form->tax_condition)->tusfacturasValue(),
            "domicilio"      => $form->address,
            "condicion_pago" => InvoicePayCondition::tryFrom($form->pay_condition)->tusfacturasValue(),           
            "razon_social"   => $form->social_reason,
            "provincia"      => "26",
            "email"          => $form->email,
            "envia_por_mail" => "S",
            "reclama_deuda"  => "N",
        ];

        $items = [];

        foreach($form->items as $item)
        {
            $items[] = [
                "cantidad" => $item['quantity'],
                "bonificacion_porcentaje" => $item['discount'],
                "producto" => [
                    "descripcion"  => $item['description'],
                    "codigo"       => $item['code'],
                    "unidad_bulto" => 1,
                    "alicuota"     => InvoiceItemAliquot::tryFrom($item['aliquot'])->tusfacturasValue(),
                    "precio_unitario_sin_iva" => $item['unit_price'],
                    "rg5329"       => "N"
                ]
            ];
        }

        $receipt = [
            "rubro"                => $form->sector,
            "rubro_grupo_contable" => $form->sector, 
            "tipo"                 => InvoiceType::tryFrom($form->invoice_type)->tusfacturasValue(), 
            "operacion"            => "V",
            "external_reference"   => $reference,
            "detalle"              => $items,
            "fecha"                => date('d/m/Y'),
            "vencimiento"          => date('d/m/Y'),
            "bonificacion"         => floatval($form->bonification),
            "total"                => $form->total,
            "moneda"               => "PES",
            "punto_venta"          => 678,
        ];

        $response = Http::asJson()->withBody(json_encode([
            'apitoken'    => env('TUSFACTURAS_API_TOKEN'),
            'apikey'      => env('TUSFACTURAS_API_KEY'),
            'usertoken'   => env('TUSFACTURAS_USER_TOKEN'),
            'cliente'     => $client,
            'comprobante' => $receipt
        ]))
        ->post("$this->base_url/v2/facturacion/nuevo_encola")
        ->json();

        dd($response);
    }
}