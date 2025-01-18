<?php 

namespace App\Services\PaymentProviders;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\PaymentStatusCode;
use App\Interfaces\PaymentGateway;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Models\OrderPayment;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MercadoPago implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['mp_access_token'];

    public function generateCheckout(Order $order)
    {
        MercadoPagoConfig::setAccessToken($this->key('mp_access_token'));

        $client = new PreferenceClient();

        $returnRoute = route('payment.return', [
            'provider' => 'mercadopago',
            'order'    => $order->id
        ]);

        $preference = $client->create([
            'auto_return' => 'approved',
            'items' => [
                [
                    'title'      => 'Producto pruebita',
                    'quantity'   => 1,
                    'unit_price' => 3500
                ]
            ],
            'back_urls' => [
                'success' => $returnRoute,
                'failure' => $returnRoute,
                'pending' => $returnRoute,
            ]
        ]);

        OrderPayment::create([
            'order_id'     => $order->id,
            'checkout_url' => $preference->init_point,
            'status_code'  => PaymentStatusCode::Created,
            'provider_id'  => 2,
            'meta'         => [
                [
                    'name'  => 'ID prefrencia',
                    'value' => $preference->id
                ],
                [
                    'name'  => 'ID colector',
                    'value' => $preference->collector_id
                ],
                [
                    'name'  => 'Fecha inicio',
                    'value' => Carbon::parse($preference->date_created)->format('d/m/Y H:i:s')
                ],
                [
                    'name'  => 'Tipo operacion',
                    'value' => $preference->operation_type
                ]
            ]
        ]);

        OrderFeedItem::create([
            'order_id'      => $order->id,
            'event'         => OrderFeedEvent::PaymentUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => $order->user->full_name,
            'action'        => "inició el pago del pedido con MercadoPago",
            'meta'          => [
                'icon_code' => 'credit_card'
            ]
        ]);

        $this->provider_checkout_url = $preference->init_point;
    }

    public static function getPaymentInfo($payment_id)
    {
        return Http::withToken(tenant()->configValue('mp_access_token'))
                    ->get("https://api.mercadopago.com/v1/payments/$payment_id")
                    ->object();
    }
}