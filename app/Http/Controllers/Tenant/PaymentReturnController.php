<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Log;

class PaymentReturnController extends Controller
{
    public function handler(Request $request, $provider)
    {
        $providerModel = PaymentMethod::where('code', $provider)->first();

        if (!$providerModel instanceof PaymentMethod) abort(401);

        Log::channel('payment-returns')->info('Retorno de pago recibido', [
            'tenant'   => tenant('name'),
            'provider' => $provider,
            'payload'  => $request->all()
        ]);

        return $this->{$provider}($request);
    }

    public function mobbex(Request $request)
    {
        dd("llego al webhook de mobbex", $request->all());
    }

    public function ualabis(Request $request)
    {
        
    }
}
