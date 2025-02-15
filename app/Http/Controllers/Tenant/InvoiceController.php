<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
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

            Log::channel('webhooks')->info('Referencias de facturación', compact('tenant', 'order'));

        }
    }
}
