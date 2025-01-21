<?php

namespace App\Http\Controllers\Tenant;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\OrderStatusCode;
use App\Enums\PaymentStatusCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Services\PaymentProviders\MercadoPago;
use App\Services\PaymentProviders\Modo;
use Illuminate\Support\Facades\Storage;

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

    public function modo(Request $request, Order $order)
    {
        if (!isset($request->intention_id)) abort(404);

        $modo = new Modo();

        $paymentInfo = $modo->getPaymentInfo($request->intention_id);

        if (!$paymentInfo || !isset($paymentInfo['id'])) abort(404);

        if ($paymentInfo['status'] === 'ACCEPTED' && $order->status_code != OrderStatusCode::Confirmed)
        {
            $bankName   = data_get($paymentInfo, 'payment_data.bank_name');
            $issuerName = data_get($paymentInfo, 'payment_data.issuer_name');
            $cardType   = data_get($paymentInfo, 'payment_data.card_type');

            $instrument = "$bankName $issuerName - $cardType";

            $order->update(['status_code' => OrderStatusCode::Confirmed]);

            $order->payment->update([
                'status_code'     => PaymentStatusCode::Confirmed,
                'external_id'     => $paymentInfo['payment_id'],
                'external_status' => $paymentInfo['status'],
                'total_paid'      => $paymentInfo['price'],
                'instrument'      => $instrument,
                'installments'    => data_get($paymentInfo, 'payment_data.additional_info.installments.quantity', 1),
                'meta'            => [
                    [
                        'name'  => 'ID intención',
                        'value' => data_get($paymentInfo, 'id')
                    ],
                    [
                        'name'  => 'ID intención externo',
                        'value' => data_get($paymentInfo, 'external_intention_id')
                    ],
                    [
                        'name'  => 'Store ID',
                        'value' => data_get($paymentInfo, 'store_id')
                    ],
                    [
                        'name'  => 'Store name',
                        'value' => data_get($paymentInfo, 'additional_info.store_name')
                    ],
                    [
                        'name'  => 'Token de transacción',
                        'value' => data_get($paymentInfo, 'payment_data.transaction_token')
                    ],
                    [
                        'name'  => 'Código de referencia',
                        'value' => data_get($paymentInfo, 'payment_data.reference_code')
                    ],
                    [
                        'name'   => 'ID transacción gateway',
                        'helper' => 'Es el ID devuelto por el procesador del pago',
                        'value'  => data_get($paymentInfo, 'payment_data.gateway_transaction_id')
                    ],
                    [
                        'name'   => 'Ticket',
                        'helper' => 'Número de ticket/cupón de la operación de la pasarela de pagos (gateway)',
                        'value'  => data_get($paymentInfo, 'payment_data.ticket')
                    ],
                    [
                        'name'   => 'Cod.Aut de tarjeta',
                        'helper' => 'Número de autorización correspondiente de la tarjeta utilizada',
                        'value'  => data_get($paymentInfo, 'payment_data.card_authorization_code')
                    ]
                ]
            ]);

            $order->feed()->create([
                'event'         => OrderFeedEvent::PaymentUpdate,
                'presentation'  => OrderFeedPresentation::Icon,
                'initializator' => 'MODO',
                'action'        => "aceptó el pago",
                'meta'          => [
                    'icon_code'  => 'credit_score',
                    'icon_color' => 'green'
                ]
            ]);
        }

        if ($paymentInfo['status'] === 'REJECTED' && $order->status_code != OrderStatusCode::PaymentCancelled)
        {
            $bankName   = data_get($paymentInfo, 'payment_data.bank_name');
            $issuerName = data_get($paymentInfo, 'payment_data.issuer_name');
            $cardType   = data_get($paymentInfo, 'payment_data.card_type');

            $instrument = "$bankName $issuerName - $cardType";

            $order->update(['status_code' => OrderStatusCode::PaymentCancelled]);

            $order->payment->update([
                'status_code'     => PaymentStatusCode::Cancelled,
                'external_id'     => data_get($paymentInfo, 'payment_data.payment_id'),
                'external_status' => $paymentInfo['status'],
                'total_paid'      => $paymentInfo['price'],
                'instrument'      => $instrument,
                'installments'    => data_get($paymentInfo, 'payment_data.additional_info.installments.quantity', 1),
                'meta'            => [
                    [
                        'name'  => 'ID intención',
                        'value' => data_get($paymentInfo, 'id')
                    ],
                    [
                        'name'  => 'ID intención externo',
                        'value' => data_get($paymentInfo, 'external_intention_id')
                    ],
                    [
                        'name'  => 'Store ID',
                        'value' => data_get($paymentInfo, 'store_id')
                    ],
                    [
                        'name'  => 'Store name',
                        'value' => data_get($paymentInfo, 'additional_info.store_name')
                    ],
                    [
                        'name'  => 'Código de referencia',
                        'value' => data_get($paymentInfo, 'payment_data.reference_code')
                    ],
                    [
                        'name'  => 'Motivo rechazo',
                        'value' => data_get($paymentInfo, 'payment_data.operation_error')
                    ]
                ]
            ]);

            $order->feed()->create([
                'event'         => OrderFeedEvent::PaymentUpdate,
                'presentation'  => OrderFeedPresentation::Icon,
                'initializator' => 'MODO',
                'action'        => "rechazó el pago",
                'meta'          => [
                    'icon_code'  => 'credit_card_off',
                    'icon_color' => 'red'
                ]
            ]);
        }

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
