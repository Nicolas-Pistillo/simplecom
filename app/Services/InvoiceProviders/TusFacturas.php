<?php 

namespace App\Services\InvoiceProviders;

use App\Enums\InvoiceItemAliquot;
use App\Enums\InvoicePayCondition;
use App\Enums\InvoiceStatus;
use App\Enums\InvoiceType;
use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\TaxCondition;
use App\Livewire\Forms\OrderInvoiceForm;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
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

        if (!$response) return ['errors' => ['No se pudo conectar con el servicio de facturación']];

        if (isset($response['error']) && $response['error'] === 'S')
        {
            return ['errors' => data_get($response, 'errores')];
        }

        $order = Order::find($form->order_id);

        $invoice = Invoice::create([
            'status'         => InvoiceStatus::Pending,
            'type'           => $form->invoice_type,
            'number'         => $form->invoice_number,
            'reference'      => $reference,
            'receipt_number' => data_get($response, 'comprobante_nro'),
            'sell_point'     => 678,
            'operation'      => 'V',
            'send_to_client' => $form->send_to_client
        ]);

        $order->update(['invoice_id' => $invoice->id]);

        $order->feed()->create([
            'event'         => OrderFeedEvent::InvoiceUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => Auth::user()->name,
            'action'        => "generó la factura del pedido y se procesará a la brevedad",
            'comments'      => "Comprobante Nro: $invoice->receipt_number",
            'meta'          => [
                'icon_code'  => 'post_add',
                'icon_color' => 'emerald'
            ]
        ]);

        return ['success' => true];
    }

    public static function getCurrentInvoiceNumber($invoiceType)
    {
        $response = Http::asJson()->withBody(json_encode([
            'apitoken'    => env('TUSFACTURAS_API_TOKEN'),
            'apikey'      => env('TUSFACTURAS_API_KEY'),
            'usertoken'   => env('TUSFACTURAS_USER_TOKEN'),
            'comprobante' => [
                'punto_venta' => 678,
                'tipo'        => InvoiceType::tryFrom($invoiceType)->tusfacturasValue(),
                'operacion'   => 'V'
            ]
        ]))
        ->post("https://www.tusfacturas.app/app/api/v2/facturacion/numeracion")
        ->json();

        if (isset($response['rta']) && $response['rta'] === 'OK')
        {
            return data_get($response, 'comprobante.numero');
        }

        return false;
    }

    public static function searchByReference($reference)
    {
        return Http::asJson()->withBody(json_encode([
            'apitoken'    => env('TUSFACTURAS_API_TOKEN'),
            'apikey'      => env('TUSFACTURAS_API_KEY'),
            'usertoken'   => env('TUSFACTURAS_USER_TOKEN'),
            'busqueda_tipo' => 'EXT_REF',
            'comprobante' => [
                'external_reference' => $reference,
                'operacion'          => 'V',
                'punto_venta'        => 678
            ]
        ]))
        ->post("https://www.tusfacturas.app/app/api/v2/facturacion/consulta_avanzada")
        ->json('comprobantes.0');
    }
}