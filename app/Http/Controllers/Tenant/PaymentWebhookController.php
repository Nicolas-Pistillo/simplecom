<?php

namespace App\Http\Controllers\Tenant;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\OrderStatusCode;
use App\Enums\PaymentStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Tenant;
use App\Services\PaymentProviders\GOcuotas;
use App\Services\PaymentProviders\MercadoPago;
use App\Services\PaymentProviders\Mobbex;
use App\Services\PaymentProviders\Ualabis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
    public function handler($tenant, $order, $provider, Request $request)
    {
        $tenantModel = Tenant::find($tenant);

        if (!$tenantModel instanceof Tenant) return response('Tenant not found', 401);

        tenancy()->initialize($tenant);

        $order = Order::find($order);

        if (!$order || !$order instanceof Order) abort(401, 'order does not exist');

        $providerModel = PaymentMethod::where('code', $provider)->first();

        if (!$providerModel || !$providerModel instanceof PaymentMethod) abort(401, 'Provider not found');

        return $this->{$provider}($request, $order);
    }

    public function mercadopago(Request $request, Order $order)
    {
        if (isset($request->topic) && $request->topic === 'payment')
        {
            $payment = MercadoPago::getPaymentInfo($request->id);

            if (!$payment || !isset($payment->id)) abort(401, 'Payment does not exist');

            $paymentOrderCode = str_replace('Pedido ', '', $payment->external_reference);

            if ($order->code != $paymentOrderCode) abort(401, 'Target order does not match');

            Log::channel('webhooks')->info('Actualización de pago recibida', [
                'proveedor' => 'mercadopago',
                'tenant'    => tenant('name'),
                'pedido'    => $order->code,
                'payload'   => $payment
            ]);

            if ($payment->status === 'approved' && $order->payment->status_code != PaymentStatusCode::Confirmed)
            {
                $order->update(['status_code' => OrderStatusCode::Confirmed]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Confirmed,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'aprobó el pago',
                    'meta'          => [
                        'icon_code'  => 'credit_score',
                        'icon_color' => 'green'
                    ]
                ]);
            }

            if ($payment->status === 'pending' && $order->payment->status_code != PaymentStatusCode::Pending)
            {
                $order->update(['status_code' => OrderStatusCode::PaymentPending]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Pending,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'está esperando el pago del comprador',
                    'meta'          => [
                        'icon_code'  => 'credit_card_clock',
                        'icon_color' => 'orange'
                    ]
                ]);
            }

            if ($payment->status === 'authorized' && $order->payment->status_code != PaymentStatusCode::Authorized)
            {
                $order->update(['status_code' => OrderStatusCode::Confirmed]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Authorized,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'autorizó el pago y se espera el desembolso',
                    'meta'          => [
                        'icon_code'  => 'credit_card_clock',
                        'icon_color' => 'lime'
                    ]
                ]);
            }

            if ($payment->status === 'rejected')
            {
                $order->update(['status_code' => OrderStatusCode::PaymentRejected]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Rejected,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'rechazó un intento de pago, el comprador puede reintentar la compra',
                    'meta'          => [
                        'icon_code'  => 'credit_card_off',
                        'icon_color' => 'red'
                    ]
                ]);
            }

            if ($payment->status === 'in_process' && $order->payment->status_code != PaymentStatusCode::InRevision)
            {
                $order->update(['status_code' => OrderStatusCode::ProviderPayPending]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::InRevision,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'está revisando el pago, se esperan actualizaciónes de estado',
                    'meta'          => [
                        'icon_code'  => 'credit_card_clock',
                        'icon_color' => 'orange'
                    ]
                ]);
            }

            if ($payment->status === 'cancelled' && $order->payment->status_code != PaymentStatusCode::Cancelled)
            {
                $order->update(['status_code' => OrderStatusCode::PaymentCancelled]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Cancelled,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'canceló o caducó el pago del pedido, la compra queda rechazada',
                    'meta'          => [
                        'icon_code'  => 'cancel',
                        'icon_color' => 'red'
                    ]
                ]);
            }

            if ($payment->status === 'in_mediation' && $order->payment->status_code != PaymentStatusCode::ProviderClaimed)
            {
                $order->update(['status_code' => OrderStatusCode::ProviderPayClaimed]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::ProviderClaimed,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'informó que el comprador inició una disputa por este pago',
                    'meta'          => [
                        'icon_code'  => 'checkbook',
                        'icon_color' => 'orange'
                    ]
                ]);
            }

            if ($payment->status === 'refunded' && $order->payment->status_code != PaymentStatusCode::Refunded)
            {
                $order->update(['status_code' => OrderStatusCode::Refunded]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Refunded,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'confirmó el reembolso de este pago',
                    'meta'          => [
                        'icon_code'  => 'currency_exchange',
                        'icon_color' => 'blue'
                    ]
                ]);
            }

            $order->payment->update([
                'meta' => [
                    [
                        'name'  => 'Tipo operación',
                        'value' => $payment->operation_type
                    ],
                    [
                        'name'  => 'Código estado',
                        'value' => $payment->status_detail
                    ],
                    [
                        'name'  => 'Ultima actualización',
                        'value' => Carbon::parse($payment->date_last_updated)->format('d/m/Y H:i:s')
                    ],
                    [
                        'name'  => 'ID colector',
                        'value' => $payment->collector_id
                    ],
                    [
                        'name'  => 'ID orden',
                        'value' => $payment->order->id
                    ],
                    [
                        'name'  => 'Recurso externo',
                        'value' => $payment->transaction_details->external_resource_url,
                        'type'  => 'link'
                    ]
                ]
            ]);
        }
    }

    public function mobbex(Request $request, Order $order)
    {
        $body = $request->all();

        if (isset($body['data']) && isset($body['data']['payment']))
        {
            $paymentInfo = Mobbex::getPaymentInfo(data_get($body, 'data.payment.id'));

            if (!empty($paymentInfo->get('transaction')))
            {
                Log::channel('webhooks')->info('Actualización de pago recibida', [
                    'proveedor' => 'mobbex',
                    'tenant'    => tenant('name'),
                    'pedido'    => $order->code,
                    'payload'   => $paymentInfo
                ]);

                $mbxOrderCode = str_replace('Pedido ', '', data_get($paymentInfo, 'transaction.payment.description'));

                if ($mbxOrderCode != $order->code) abort(401, 'Target order does not match');

                $transaction = $paymentInfo->get('transaction');
                $transactionDetails = $paymentInfo->get('transaction_details');
                $mbxStatusCode = data_get($transaction, 'payment.status.code');

                // Approved
                if (in_array($mbxStatusCode, ['200', '210', '201', '300', '301', '302', '303', '800', '4'])
                && $order->payment->status_code != PaymentStatusCode::Confirmed)
                {
                    $order->update(['status_code' => OrderStatusCode::Confirmed]);

                    $order->payment->update([
                        'status_code'     => PaymentStatusCode::Confirmed,
                        'external_id'     => data_get($transaction, 'payment.id'),
                        'instrument'      => data_get($transaction, 'source.name'),
                        'installments'    => data_get($transaction, 'payment.source.installment.count'),
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
                        'installments'    => data_get($transaction, 'payment.source.installment.count'),
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
                        'installments'    => data_get($transaction, 'payment.source.installment.count'),
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
                        'installments'    => data_get($transaction, 'payment.source.installment.count'),
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
                        'name'  => 'Valor de cuota',
                        'value' => data_get($transaction, 'payment.source.installment.amount')
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

                $order->payment->update(compact('meta'));
            }
        }
    }

    public function ualabis(Request $request, Order $order)
    {
        if (isset($request->uuid, $request->status))
        {
            $ualabisOrder = str_replace('Pedido-', '', $request->external_reference);

            if ($ualabisOrder != $order->code) abort(401, 'Target order does not match');

            $service = new Ualabis();

            $paymentInfo = $service->getPaymentInfo($request->uuid);

            Log::channel('webhooks')->info('Actualización de pago recibida', [
                'proveedor' => 'ualabis',
                'tenant'    => tenant('name'),
                'pedido'    => $order->code,
                'payload'   => $paymentInfo
            ]);

            $paymentStatus = data_get($paymentInfo, 'status');

            if (!$paymentStatus) abort(401, 'Payment not found');

            if ($paymentStatus === 'APPROVED')
            {
                $order->update(['status_code' => OrderStatusCode::Confirmed]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Confirmed,
                    'external_id'     => data_get($paymentInfo, 'uuid'),
                    'instrument'      => data_get($paymentInfo, 'customer.card.issuer'),
                    'installments'    => data_get($paymentInfo, 'customer.card.installments.number'),
                    'external_status' => $paymentStatus,
                    'total_paid'      => data_get($paymentInfo, 'customer.card.installments.total')
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'Ualabis',
                    'action'        => 'aprobó el pago',
                    'meta'          => [
                        'icon_code'  => 'credit_score',
                        'icon_color' => 'green'
                    ]
                ]);
            }

            if ($paymentStatus === 'PROCESSED')
            {
                $order->update(['status_code' => OrderStatusCode::Confirmed]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Authorized,
                    'external_id'     => data_get($paymentInfo, 'uuid'),
                    'instrument'      => data_get($paymentInfo, 'customer.card.issuer'),
                    'installments'    => data_get($paymentInfo, 'customer.card.installments.number'),
                    'external_status' => $paymentStatus,
                    'total_paid'      => data_get($paymentInfo, 'customer.card.installments.total')
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'Ualabis',
                    'action'        => 'procesó correctamente el pago y se espera el desembolso',
                    'meta'          => [
                        'icon_code'  => 'credit_card_clock',
                        'icon_color' => 'lime'
                    ]
                ]);
            }

            if ($paymentStatus === 'REJECTED')
            {
                $order->update(['status_code' => OrderStatusCode::PaymentRejected]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Rejected,
                    'external_id'     => data_get($paymentInfo, 'uuid'),
                    'instrument'      => data_get($paymentInfo, 'customer.card.issuer'),
                    'installments'    => data_get($paymentInfo, 'customer.card.installments.number'),
                    'external_status' => $paymentStatus,
                    'total_paid'      => data_get($paymentInfo, 'customer.card.installments.total')
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'Ualabis',
                    'action'        => 'rechazó un intento de pago, el comprador puede reintentar la compra',
                    'meta'          => [
                        'icon_code'  => 'credit_card_off',
                        'icon_color' => 'red'
                    ]
                ]);
            }

            $order->payment->update([
                'meta' => [
                    [
                        'name'  => 'Referencia',
                        'value' => data_get($paymentInfo, 'external_reference')
                    ],
                    [
                        'name'  => 'Tarjeta',
                        'value' => data_get($paymentInfo, 'customer.card.pan')
                    ],
                    [
                        'name'  => 'Titular tarjeta',
                        'value' => data_get($paymentInfo, 'customer.card.holder_name')
                    ],
                    [
                        'name'  => 'Costo financiero',
                        'value' => data_get($paymentInfo, 'customer.card.installments.financial_cost') > 0
                                    ? '%' . data_get($paymentInfo, 'customer.card.installments.financial_cost')
                                    : null
                    ],
                    [
                        'name'  => 'Valor de cuota',
                        'value' => $order->payment->installments > 1 
                                    ? '$' . data_get($paymentInfo, 'customer.card.installments.value_per_installment') 
                                    : null
                    ]
                ]
            ]);
        }
    }

    public function gocuotas(Request $request, Order $order)
    {
        if (isset($request->order_reference_id, $request->order_id))
        {
            $gocuotasOrder = str_replace('Pedido ', '', $request->order_reference_id);

            if ($gocuotasOrder != $order->code) abort(401, 'Target order does not match');

            $service = new GOcuotas();

            $paymentInfo = $service->getPaymentInfo($request->order_id);

            if (empty($paymentInfo) || !isset($paymentInfo['id'])) abort(401, 'Payment not found');

            Log::channel('webhooks')->info('Actualización de pago recibida', [
                'proveedor' => 'gocuotas',
                'tenant'    => tenant('name'),
                'pedido'    => $order->code,
                'payload'   => $paymentInfo
            ]);

            $paymentStatus = data_get($paymentInfo, 'status');

            if ($paymentStatus === 'approved')
            {
                $order->update(['status_code' => OrderStatusCode::Confirmed]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Confirmed,
                    'external_id'     => data_get($paymentInfo, 'id'),
                    'instrument'      => data_get($paymentInfo, 'payment.card.name'),
                    'installments'    => data_get($paymentInfo, 'number_of_installments'),
                    'external_status' => $paymentStatus,
                    'total_paid'      => data_get($paymentInfo, 'amount_in_cents') / 100,
                    'meta'            => [
                        [
                            'name'  => 'Referencia',
                            'value' => data_get($paymentInfo, 'order_reference_id')
                        ],
                        [
                            'name'  => 'Tarjeta',
                            'value' => data_get($paymentInfo, 'payment.card.number')
                        ]
                    ]
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'GOcuotas',
                    'action'        => 'aprobó el pago',
                    'meta'          => [
                        'icon_code'  => 'credit_score',
                        'icon_color' => 'green'
                    ]
                ]);
            }

            if ($paymentStatus === 'undefined')
            {
                $order->update(['status_code' => OrderStatusCode::PaymentPending]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Pending,
                    'external_id'     => data_get($paymentInfo, 'id'),
                    'instrument'      => data_get($paymentInfo, 'payment.card.name'),
                    'installments'    => data_get($paymentInfo, 'number_of_installments'),
                    'external_status' => $paymentStatus,
                    'total_paid'      => data_get($paymentInfo, 'amount_in_cents') / 100,
                    'meta'            => [
                        [
                            'name'  => 'Referencia',
                            'value' => data_get($paymentInfo, 'order_reference_id')
                        ],
                        [
                            'name'  => 'Tarjeta',
                            'value' => data_get($paymentInfo, 'payment.card.number')
                        ]
                    ]
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'GOcuotas',
                    'action'        => 'está esperando el pago del comprador',
                    'meta'          => [
                        'icon_code'  => 'credit_card_clock',
                        'icon_color' => 'orange'
                    ]
                ]);
            }

            if ($paymentStatus === 'denied')
            {
                $order->update(['status_code' => OrderStatusCode::PaymentCancelled]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Cancelled,
                    'external_id'     => data_get($paymentInfo, 'id'),
                    'instrument'      => data_get($paymentInfo, 'payment.card.name'),
                    'installments'    => data_get($paymentInfo, 'number_of_installments'),
                    'external_status' => $paymentStatus,
                    'total_paid'      => data_get($paymentInfo, 'amount_in_cents') / 100,
                    'meta'            => [
                        [
                            'name'  => 'Referencia',
                            'value' => data_get($paymentInfo, 'order_reference_id')
                        ],
                        [
                            'name'  => 'Tarjeta',
                            'value' => data_get($paymentInfo, 'payment.card.number')
                        ]
                    ]
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'GOcuotas',
                    'action'        => 'rechazó el pago',
                    'meta'          => [
                        'icon_code'  => 'cancel',
                        'icon_color' => 'red'
                    ]
                ]);
            }
        }
    }

    public function sipago(Request $request, Order $order)
    {
        Log::channel('webhooks')->info('Webhook de Sipago recibido', [
            'request' => $request->all()
        ]);

        if (isset($request->data, $request->data->order))
        {
            Log::channel('webhooks')->info('Trabajar con esta data de sipago', [
                'order' => $request->data->order
            ]);
        }
    }
}
