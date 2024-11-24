<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class PaymentReturnController extends Controller
{
    public function return(Request $request, $provider)
    {
        Log::channel('payment-returns')->info('Retorno de pago recibido', [
            'tenant'   => tenant('name'),
            'provider' => $provider,
            'payload'  => $request->all()
        ]);

        dd($request->all(), $provider);
    }
}
