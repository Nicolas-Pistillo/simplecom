<?php 

namespace App\Services\InvoiceProviders;

use App\Enums\InvoiceItemAliquot;
use App\Enums\InvoicePayCondition;
use App\Enums\InvoiceStatus;
use App\Enums\InvoiceType;
use App\Enums\OrderFeedEvent;
use App\Enums\NotificationPresentation;
use App\Enums\TaxCondition;
use App\Livewire\Forms\OrderInvoiceForm;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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

        $parameters = compact('form', 'reference', 'client', 'receipt');

        return $form->invoice_queued ? $this->invoiceOrderQueued($parameters) 
                                     : $this->invoiceOrderNow($parameters);
    }

    public function invoiceOrderNow($invoiceParameters)
    {
        $response = Http::asJson()->withBody(json_encode([
            'apitoken'    => env('TUSFACTURAS_API_TOKEN'),
            'apikey'      => env('TUSFACTURAS_API_KEY'),
            'usertoken'   => env('TUSFACTURAS_USER_TOKEN'),
            'cliente'     => data_get($invoiceParameters, 'client'),
            'comprobante' => data_get($invoiceParameters, 'receipt')
        ]))
        ->post("$this->base_url/v2/facturacion/nuevo")
        ->json();

        if (!$response) return ['errors' => ['No se pudo conectar con el servicio de facturación']];

        if (isset($response['error']) && $response['error'] === 'S')
        {
            return ['errors' => data_get($response, 'errores')];
        }

        $form = data_get($invoiceParameters, 'form');

        $order = Order::find(data_get($invoiceParameters, 'form.order_id'));

        $invoice = Invoice::create([
            'status'         => InvoiceStatus::Issued,
            'type'           => $form->invoice_type,
            'receipt_number' => data_get($response, 'comprobante_nro'),
            'reference'      => data_get($response, 'external_reference'),
            'operation'      => 'V',
            'cae'            => data_get($response, 'cae'),
            'cae_due_date'   => data_get($response, 'vencimiento_cae'),
            'sell_point'     => 678,
            'emited_at'      => date('Y-m-d H:i:s')
        ]);

        $order->update([
            'invoice_id' => $invoice->id,
            'invoiced'   => true
        ]);

        $order->feed()->create([
            'event'         => OrderFeedEvent::InvoiceUpdate,
            'presentation'  => NotificationPresentation::Icon,
            'initializator' => Auth::user()->name,
            'action'        => "facturó el pedido",
            'comments'      => "Respuesta del servicio: " . data_get($response, 'rta'),
            'meta'          => [
                'icon_code'   => 'task',
                'icon_color'  => 'emerald'
            ]
        ]);

        $pdf = file_get_contents(data_get($response, 'comprobante_pdf_url'), false);
        $ticket = file_get_contents(data_get($response, 'comprobante_ticket_url'), false);

        $pdfFile = tenant('invoices_url') . '/' . uniqid('ivc-') . '.pdf';
        $ticketFile = tenant('invoices_url') . '/' . uniqid('tkt-') . '.pdf';

        if (Storage::put($pdfFile, $pdf))
        {
            $invoice->pdf_url = $pdfFile;
        }

        if (Storage::put($ticketFile, $ticket))
        {
            $invoice->ticket_url = $ticketFile;
        }

        $invoice->save();

        return ['success' => true];
    }

    public function invoiceOrderQueued($invoiceParameters)
    {
        $response = Http::asJson()->withBody(json_encode([
            'apitoken'    => env('TUSFACTURAS_API_TOKEN'),
            'apikey'      => env('TUSFACTURAS_API_KEY'),
            'usertoken'   => env('TUSFACTURAS_USER_TOKEN'),
            'cliente'     => data_get($invoiceParameters, 'client'),
            'comprobante' => data_get($invoiceParameters, 'receipt')
        ]))
        ->post("$this->base_url/v2/facturacion/nuevo_encola")
        ->json();

        if (!$response) return ['errors' => ['No se pudo conectar con el servicio de facturación']];

        if (isset($response['error']) && $response['error'] === 'S')
        {
            return ['errors' => data_get($response, 'errores')];
        }

        $form = data_get($invoiceParameters, 'form');

        $order = Order::find(data_get($invoiceParameters, 'form.order_id'));

        $invoice = Invoice::create([
            'status'         => InvoiceStatus::Pending,
            'type'           => $form->invoice_type,
            'receipt_number' => data_get($response, 'comprobante_nro'),
            'reference'      => data_get($invoiceParameters, 'reference'),
            'operation'      => 'V',
            'sell_point'     => 678,
        ]);

        $order->update(['invoice_id' => $invoice->id]);

        $order->feed()->create([
            'event'         => OrderFeedEvent::InvoiceUpdate,
            'presentation'  => NotificationPresentation::Icon,
            'initializator' => Auth::user()->name,
            'action'        => "envió a facturar el pedido con TusFacturasAPP",
            'comments'      => "Respuesta del servicio: " . data_get($response, 'rta'),
            'meta'          => [
                'icon_code'  => 'upload_file'
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