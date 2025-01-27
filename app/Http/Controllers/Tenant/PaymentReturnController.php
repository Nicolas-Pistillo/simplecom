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
use App\Services\PaymentProviders\Mobbex;
use App\Services\PaymentProviders\Modo;

class PaymentReturnController extends Controller
{
    public function handler(Request $request, $provider, Order $order)
    {
        $providerModel = PaymentMethod::where('code', $provider)->first();

        if (!$providerModel instanceof PaymentMethod) abort(404);

        $order->load('status', 'user', 'items', 'shipping', 'payment');

        return $this->{$provider}($request, $order);
    }

    public function transfer(Request $request, Order $order)
    {
        return view('ecommerce.checkout-result', compact('order'));
    }

    public function mercadopago(Request $request, Order $order)
    {
        return view('ecommerce.checkout-result', compact('order'));
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

            $instrument = "$bankName $issuerName";

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
                'action'        => "aprobó el pago",
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

            $instrument = "$bankName $issuerName";

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

        $order->refresh();
        return response()->view('ecommerce.checkout-result', compact('order'));
    }

    public function mobbex(Request $request, Order $order)
    {
        if (!isset($request->transactionId))
        {
            return view('ecommerce.checkout-result', compact('order'));
        }

        $paymentInfo = Mobbex::getPaymentInfo($request->transactionId);

        if (!$paymentInfo->get('transaction'))
        {
            return view('ecommerce.checkout-result', compact('order'));
        }

        $mbxOrderCode = str_replace('Pedido ', '', data_get($paymentInfo, 'transaction.payment.description'));

        if($mbxOrderCode != $order->code) abort(404);

        $transaction = $paymentInfo->get('transaction');
        $transactionDetails = $paymentInfo->get('transaction_details');
        $mbxStatusCode = data_get($transaction, 'payment.status.code');

        // Approved
        if (in_array($mbxStatusCode, ['200', '201', '210', '300', '301', '302', '303', '800', '4'])
        && $order->payment->status_code != PaymentStatusCode::Confirmed)
        {
            $order->update(['status_code' => OrderStatusCode::Confirmed]);

            $order->payment->update([
                'status_code'     => PaymentStatusCode::Confirmed,
                'external_id'     => data_get($transaction, 'payment.id'),
                'instrument'      => data_get($transaction, 'source.name'),
                'external_status' => data_get($transaction, 'payment.status.text'),
                'total_paid'      => data_get($transaction, 'payment.total')
            ]);

            $order->feed()->create([
                'event'         => OrderFeedEvent::PaymentUpdate,
                'presentation'  => OrderFeedPresentation::Icon,
                'initializator' => 'Mobbex',
                'action'        => 'aprobó el pago',
                'meta'          => [
                    'icon_code'  => 'credit_score',
                    'icon_color' => 'green'
                ]
            ]);
        }

        // Pending
        if (in_array($mbxStatusCode, ['2', '3', '100']) 
        && $order->payment->status_code != PaymentStatusCode::Pending)
        {
            $order->update(['status_code' => OrderStatusCode::PaymentPending]);

            $order->payment->update([
                'status_code'     => PaymentStatusCode::Pending,
                'external_id'     => data_get($transaction, 'payment.id'),
                'instrument'      => data_get($transaction, 'source.name'),
                'external_status' => data_get($transaction, 'payment.status.text'),
                'total_paid'      => data_get($transaction, 'payment.total')
            ]);

            $order->feed()->create([
                'event'         => OrderFeedEvent::PaymentUpdate,
                'presentation'  => OrderFeedPresentation::Icon,
                'initializator' => 'Mobbex',
                'action'        => 'está esperando el pago del comprador',
                'meta'          => [
                    'icon_code'  => 'credit_card_clock',
                    'icon_color' => 'orange'
                ]
            ]);
        }

        // Rejected & recuperable
        if (in_array($mbxStatusCode, ['400', '403', '410', '411', '412', '413', '414', '415', '416', '417', '500']))
        {
            $order->update(['status_code' => OrderStatusCode::PaymentRejected]);

            $order->payment->update([
                'status_code'     => PaymentStatusCode::Rejected,
                'external_id'     => data_get($transaction, 'payment.id'),
                'instrument'      => data_get($transaction, 'source.name'),
                'external_status' => data_get($transaction, 'payment.status.text'),
                'total_paid'      => data_get($transaction, 'payment.total')
            ]);

            $order->feed()->create([
                'event'         => OrderFeedEvent::PaymentUpdate,
                'presentation'  => OrderFeedPresentation::Icon,
                'initializator' => 'Mobbex',
                'action'        => 'rechazó un intento de pago, el comprador puede reintentar la compra',
                'meta'          => [
                    'icon_code'  => 'credit_card_off',
                    'icon_color' => 'red'
                ]
            ]);
        }

        // Rejected & NO recuperable
        if (in_array($mbxStatusCode, ['401', '402', '600', '601', '602', '603', '610', '604'])
        && $order->payment->status_code != PaymentStatusCode::Cancelled)
        {
            $order->update(['status_code' => OrderStatusCode::PaymentCancelled]);

            $order->payment->update([
                'status_code'     => PaymentStatusCode::Cancelled,
                'external_id'     => data_get($transaction, 'payment.id'),
                'instrument'      => data_get($transaction, 'source.name'),
                'external_status' => data_get($transaction, 'payment.status.text'),
                'total_paid'      => data_get($transaction, 'payment.total')
            ]);

            $order->feed()->create([
                'event'         => OrderFeedEvent::PaymentUpdate,
                'presentation'  => OrderFeedPresentation::Icon,
                'initializator' => 'Mobbex',
                'action'        => 'canceló o caducó el pago del pedido, la compra queda rechazada',
                'meta'          => [
                    'icon_code'  => 'cancel',
                    'icon_color' => 'red'
                ]
            ]);
        }

        $meta = [
            [
                'name'  => 'Tipo operación',
                'value' => data_get($transaction, 'payment.operation.type')
            ],
            [
                'name'  => 'Mensaje de estado',
                'value' => data_get($transaction, 'payment.status.message')
            ],
            [
                'name'  => 'Referencia',
                'value' => data_get($transaction, 'payment.reference')
            ],
            [
                'name'  => 'Referencia interna',
                'value' => data_get($transaction, 'payment.description')
            ],
            [
                'name'  => 'Recurso externo',
                'value' => data_get($transaction, 'payment.source.url'),
                'type'  => 'link'
            ]
        ];

        if (!empty($transactionDetails))
        {
            foreach($transactionDetails as $detailItem)
            {
                array_push($meta, [
                    'name'  => $detailItem['label'],
                    'value' => $detailItem['value']
                ]);
            }
        }

        $order->payment->update(['meta' => $meta]);

        $order->refresh();
        return view('ecommerce.checkout-result', compact('order'));
    }

    public function ualabis(Request $request, Order $order)
    {
        return view('ecommerce.checkout-result', compact('order'));
    }

    public function gocuotas(Request $request, Order $order)
    {
        return view('ecommerce.checkout-result', compact('order'));
    }

    public function stripe(Request $request, Order $order)
    {
        dd("llego al return de stripe", $request->all(), $order);
    }
}
