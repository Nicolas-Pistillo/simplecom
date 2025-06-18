<?php

namespace App\Services\PaymentProviders;

use App\Enums\OrderFeedEvent;
use App\Enums\NotificationPresentation;
use App\Enums\PaymentStatus;
use App\Interfaces\PaymentGateway;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Models\OrderPayment;
use App\Models\PaymentMethod;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class Nave implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = [
        'nave_client_id', 'nave_client_secret', 'nave_platform', 'nave_store_id'
    ];

    private $token;

    public function model(): PaymentMethod
    {
        return PaymentMethod::where('code', 'nave')->first();
    }

    public function generateToken()
    {
        $url = env('NAVE_TEST') 
                ? 'https://homoservices.apinaranja.com/security-ms/api/security/auth0/b2b/m2msPrivate' 
                : 'https://services.apinaranja.com/security-ms/api/security/auth0/b2b/m2msPrivate';

        $response = Http::withBody(json_encode([
            'client_id'     => $this->key('nave_client_id'),
            'client_secret' => $this->key('nave_client_secret'),
            'audience'      => 'https://naranja.com/ranty/merchants/api'
        ]))
        ->throw()
        ->post($url)
        ->json();

        $this->token = $response['access_token'];
    }

    public function generateCheckout(Order $order)
    {
        $this->generateToken();

        $url = env('NAVE_TEST')
                ? 'https://e3-api.ranty.io/ecommerce/payment_request/external'
                : 'https://api.ranty.io/ecommerce/payment_request/external';

        $products = [];

        foreach($order->items as $item)
        {
            array_push($products, [
                'id'          => "$item->id",
                'name'        => $item->name,
                'description' => $item->product->description ?? 'Sin descripción',
                'quantity'    => $item->quantity,
                'unit_price'  => [
                    'currency' => 'ARS',
                    'value'    => $item->sell_price
                ]
            ]);
        }

        if ($order->shipping_cost > 0)
        {
            array_push($products, [
                'id'          => "{$order->shipping->provider_id}",
                'name'        => 'Envío',
                'description' => $order->shipping->provider_service ?? 'Servicio de envío',
                'quantity'    => 1,
                'unit_price'  => [
                    'currency' => 'ARS',
                    'value'    => "$order->shipping_cost"
                ]
            ]);
        }

        $response = Http::withToken($this->token)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->retry(3)
            ->withBody(json_encode([
                "platform"      => $this->key('nave_platform'),
                "store_id"      => $this->key('nave_store_id'),
                "callback_url"  => $order->paymentReturn(),
                "order_id"      => $order->id,
                "mobile"        => true,
                'payment_request' => [
                    'transactions' => [
                        [
                            'products' => $products,
                            'amount'   => [
                                "currency" => "ARS",
                                "value"    => "$order->total"
                            ]
                        ]
                    ],
                    'buyer' => [
                        "user_id"    => "{$order->user->id}",
                        "doc_type"   => "DNI",
                        "doc_number" => $order->user->document,
                        "user_email" => $order->user->email,
                        "name"       => $order->user->full_name,
                        "phone"      => $order->user->phone
                    ]
                ]
            ]))
            ->throw()
            ->post($url)
            ->json();

        OrderPayment::create([
            'order_id'        => $order->id,
            'provider_id'     => $this->model()->id,
            'status'          => PaymentStatus::Created,
            'checkout_url'    => data_get($response, 'data.checkout_url'),
            'intention_id'    => data_get($response, 'data.payment_request_id'),
            'meta'            => [
                [
                    'name'  => 'ID pago interno',
                    'value' => data_get($response, 'data.transaction_id')
                ]
            ]
        ]);

        OrderFeedItem::create([
            'order_id'      => $order->id,
            'event'         => OrderFeedEvent::PaymentUpdate,
            'presentation'  => NotificationPresentation::Icon,
            'initializator' => $order->user->full_name,
            'action'        => 'inició el pago del pedido con Nave',
            'meta'          => [
                'icon_code' => 'credit_card'
            ]
        ]);

        $this->provider_checkout_url = data_get($response, 'data.checkout_url');
    }

    public function getPaymentInfo($id)
    {
        $this->generateToken();

        $url =  env('NAVE_TEST') 
                ? 'https://e3-api.ranty.io/api/payment_requests' 
                : 'https://api.ranty.io/api/payment_requests';

        return Http::withToken($this->token)->get("$url/$id")->json();
    }

    public function checkCredentials(Collection $credentials): bool
    {
        $clientId     = $credentials->firstWhere('key', 'nave_client_id')['value'];
        $clientSecret = $credentials->firstWhere('key', 'nave_client_secret')['value'];
        $platform     = $credentials->firstWhere('key', 'nave_platform')['value'];
        $storeId      = $credentials->firstWhere('key', 'nave_store_id')['value'];

        $url = env('NAVE_TEST') 
                ? 'https://homoservices.apinaranja.com/security-ms/api/security/auth0/b2b/m2msPrivate' 
                : 'https://services.apinaranja.com/security-ms/api/security/auth0/b2b/m2msPrivate';

        $authResponse = Http::withBody(json_encode([
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'audience'      => 'https://naranja.com/ranty/merchants/api'
        ]))
        ->post($url)
        ->json();

        if (!isset($authResponse['access_token'])) return false;

       $url = env('NAVE_TEST')
                ? 'https://e3-api.ranty.io/ecommerce/payment_request/external'
                : 'https://api.ranty.io/ecommerce/payment_request/external';

        $checkoutTest = Http::withToken($authResponse['access_token'])
            ->withHeaders(['Content-Type' => 'application/json'])
            ->retry(2, 0, null, false)
            ->withBody(json_encode([
                "platform"      => $platform,
                "store_id"      => $storeId,
                "callback_url"  => 'https://google.com',
                'mobile'        => true,
                "order_id"      => 0,
                'payment_request' => [
                    'transactions' => [
                        [
                            'products' => [
                                [
                                    'id'          => '0',
                                    'name'        => 'Test',
                                    'description' => 'Chequeo de servicio',
                                    'quantity'    => 1,
                                    'unit_price'  => [
                                        'currency' => 'ARS',
                                        'value'    => "500"
                                    ]
                                ]
                            ],
                            'amount'   => [
                                "currency" => "ARS",
                                "value"    => "500"
                            ]
                        ]
                    ],
                    'buyer' => [
                        "user_id"    => "0",
                        "doc_type"   => "DNI",
                        "doc_number" => "42333444",
                        "user_email" => "test@test.com",
                        "name"       => "Testing",
                        "phone"      => "1122334455"
                    ]
                ]
            ]))
            ->post($url)
            ->json();

        return isset($checkoutTest['data'], $checkoutTest['data']['checkout_url']);
    }
}
