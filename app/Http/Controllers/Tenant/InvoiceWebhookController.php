<?php

namespace App\Http\Controllers\Tenant;

use App\Enums\InvoiceStatus;
use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Tenant;
use App\Services\InvoiceProviders\TusFacturas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InvoiceWebhookController extends Controller
{
    public function handler(Request $request)
    {
        if (isset($request->recurso, $request->external_reference) 
        && $request->recurso === 'facturacion')
        {
            $references = explode('|', data_get($request, 'external_reference'));

            $tenant_id = $references[0];
            $order_id = $references[1];

            Log::channel('webhooks')->info('Actualización de facturación recibida', [
                'request'   => $request->all(),
                'tenant_id' => $tenant_id,
                'order_id'  => $order_id
            ]);

            $tenant = Tenant::find($tenant_id);
            
            if (!$tenant instanceof Tenant)
                return response(401, 'Tenant not found');

            tenancy()->initialize($tenant);

            $order = Order::find($order_id);

            if (!$order instanceof Order || !$order->invoice)
                return response(401, 'Order or invoice not found');

            if ($request->evento === 'encolado')
            {
                $order->invoice->update([
                    'status' => InvoiceStatus::Queued
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::InvoiceUpdate,
                    'presentation'  => OrderFeedPresentation::Image,
                    'initializator' => 'TusFacturas',
                    'action'        => 'ya está procesando tu factura',
                    'meta'          => [
                        'img_src'   => Storage::url('providers/tusfacturas.png'),
                        'hook_id'   => $request->hook_id
                    ]
                ]);
            }

            if ($request->evento === 'emitido')
            {
                $receipt = TusFacturas::searchByReference($request->external_reference);

                $order->invoice->update([
                    'status'       => InvoiceStatus::Issued,
                    'number'       => data_get($receipt, 'comprobante.numero'),
                    'cae'          => data_get($receipt, 'comprobante.cae'),
                    'cae_due_date' => data_get($receipt, 'comprobante.vencimiento_cae'),
                    'pdf_url'      => data_get($receipt, 'comprobante.comprobante_pdf_url'),
                    'ticket_url'   => data_get($receipt, 'comprobante.comprobante_ticket_url')
                ]);

                $order->update(['invoiced' => true]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::InvoiceUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'La factura',
                    'action'        => 'del pedido ha sido emitida correctamente',
                    'meta'          => [
                        'icon_code'   => 'task',
                        'icon_color'  => 'green',
                        'hook_id'     => $request->hook_id
                    ]
                ]);
            }
        }
    }
}
