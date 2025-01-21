<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Services\PaymentProviders\MercadoPago;
use App\Services\PaymentProviders\Modo;

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
        dd("MP | Chequear estado de pedido y redireccionar al comprador");
    }

    public function modo(Request $request, $order)
    {
        if (!isset($request->intention_id)) abort(404);

        $modo = new Modo();

        $paymentInfo = $modo->getPaymentInfo($request->intention_id);

        dd($paymentInfo);

        dd("MODO | Chequear estado y redireccionar al comprador", $order, $request->all());
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
