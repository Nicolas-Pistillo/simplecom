<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\OrderShipping;
use App\Models\ShippingProvider;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShippingWebhookController extends Controller
{
    public function handler($tenant, $orderShipping, $provider, Request $request)
    {
        $tenantModel = Tenant::where('name', $tenant)->first();

        if (!$tenantModel instanceof Tenant) return response('Tenant not found', 401);

        tenancy()->initialize($tenantModel);

        $orderShipping = OrderShipping::find($orderShipping);

        if (!$orderShipping || !$orderShipping instanceof OrderShipping) 
            return response('order shipping does not exist', 401);

        $providerModel = ShippingProvider::where('code', $provider)->first();

        if (!$providerModel || !$providerModel instanceof ShippingProvider) 
            return response('Provider not found', 401);

        return $this->{$provider}($request, $orderShipping);
    }

    public function epick(Request $request, OrderShipping $shipping)
    {
        Log::channel('webhooks')->info('Webhook de E-pick recibido', [
            'tenant'   => tenant('name'),
            'order_id' => $shipping->order_id,
            'payload'  => $request->all()
        ]);
    }

    public function envia(Request $request, $tenant)
    {
        Log::channel('webhooks')->info('Webhook de Envia.com recibido', [
            'tenant'   => $tenant,
            'payload'  => $request->all()
        ]);
    }
}
