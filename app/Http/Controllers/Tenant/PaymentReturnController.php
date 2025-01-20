<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Services\PaymentProviders\MercadoPago;

class PaymentReturnController extends Controller
{
    public function handler(Request $request, $provider, Order $order)
    {
        $providerModel = PaymentMethod::where('code', $provider)->first();

        if (!$providerModel instanceof PaymentMethod) abort(404);

        $order->load('payment');

        return $this->{$provider}($request, $order);
    }

    public function mercadopago(Request $request, Order $order)
    {
        dd("Chequear estado de pedido y redireccionar al comprador");
    }

    public function mobbex(Request $request, Order $order)
    {
        dd("llego al return de mobbex", $request->all(), $order);
    }

    public function ualabis(Request $request, Order $order)
    {
        dd("llego al return de ualabis", $request->all(), $order);
    }

    public function stripe(Request $request, Order $order)
    {
        dd("llego al return de stripe", $request->all(), $order);
    }
}
