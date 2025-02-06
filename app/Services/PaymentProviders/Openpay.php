<?php 

namespace App\Services\PaymentProviders;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\PaymentStatusCode;
use App\Interfaces\PaymentGateway;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Models\OrderPayment;
use App\Models\PaymentMethod;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Illuminate\Support\Facades\Http;

class Openpay implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['openpay_client_id', 'openpay_client_secret'];

    private $token;

    public function model(): PaymentMethod
    {
        return PaymentMethod::where('code', 'openpay')->first();
    }

    public function generateToken()
    {
        $url = env('OPENPAY_TEST')
            ? 'https://auth.preprod.geopagos.com'
            : 'https://auth.geopagos.com';

        $response = Http::withBody(json_encode([
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->key('openpay_client_id'),
            'client_secret' => $this->key('openpay_client_secret'),
            'scope'         => '*'
        ]))
        ->throw()
        ->post("$url/oauth/token")
        ->json();

        $this->token = $response['access_token'];
    }

    public function generateCheckout(Order $order)
    {
        $this->generateToken();

        $url = env('OPENPAY_TEST')
                ? 'https://api-openpay-ar.preprod.geopagos.com'
                : 'https://api.openpayargentina.com.ar';

        $attributes = [
            'currency'      => "032",
            'items'         => [],
            'webhookUrl'    => $order->paymentWebhook(),
            'redirect_urls' => [
                'success' => $order->paymentReturn(),
                'failed'  => $order->paymentReturn()
            ]
        ];

        foreach ($order->items as $item) {
            array_push($attributes['items'], [
                'id' => $item->id,
                'name' => $item->name,
                'unitPrice' => [
                    'currency' => '032',
                    //'amount'   => $item->sell_price * 100
                    'amount'   => 150 * 100
                ],
                'quantity' => $item->quantity
            ]);
        }

        if ($order->shipping_cost > 0) {
            $attributes['shipping'] = [
                'name'  => 'Envío',
                'price' => [
                    'currency' => '032',
                    'amount'   => 150 * 100
                    //'amount'   => $order->shipping_cost * 100
                ]
            ];
        }

        $response = Http::withToken($this->token)
            ->withBody(json_encode([
                'data' => ['attributes' => $attributes]
            ]), 'application/vnd.api+json')
            ->withHeaders([
                'Content-Type' => 'application/vnd.api+json',
                'Accept'       => 'application/vnd.api+json'
            ])
            ->throw()
            ->post("$url/api/v2/orders")
            ->json();

        OrderPayment::create([
            'order_id'        => $order->id,
            'checkout_url'    => data_get($response, 'data.links.0.checkout'),
            'status_code'     => PaymentStatusCode::Created,
            'external_status' => data_get($response, 'data.attributes.status'),
            'intention_id'    => data_get($response, 'data.attributes.uuid'),
            'provider_id'     => $this->model()->id,
            'meta'            => [
                [
                    'name'  => 'Nro de orden',
                    'value' => data_get($response, 'data.attributes.orderNumber')
                ]
            ]
        ]);

        OrderFeedItem::create([
            'order_id'      => $order->id,
            'event'         => OrderFeedEvent::PaymentUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => $order->user->full_name,
            'action'        => "inició el pago del pedido con Openpay",
            'meta'          => [
                'icon_code' => 'credit_card'
            ]
        ]);

        $this->provider_checkout_url = data_get($response, 'data.links.0.checkout');
    }

    public function getPaymentInfo($id)
    {
        $this->generateToken();

        $url = env('OPENPAY_TEST')
                ? 'https://api-openpay-ar.preprod.geopagos.com'
                : 'https://api.openpayargentina.com.ar';
                
        return Http::withToken($this->token)->get("$url/api/v2/orders/$id")->json();
    }
}