<?php 

namespace App\Services\PaymentProviders;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\OrderStatusCode;
use App\Enums\PaymentRedirectType;
use App\Enums\PaymentStatusCode;
use App\Interfaces\PaymentGateway;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Models\OrderPayment;
use App\Models\PaymentMethod;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Exception;
use Illuminate\Support\Facades\Http;

class Modo implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['modo_username', 'modo_password', 'modo_store_id'];

    private $base_url = 'https://merchants.playdigital.com.ar';
    private $token;

    public function __construct()
    {
        $this->redirect_type = PaymentRedirectType::FrontendCheckout;

        if (env('MODO_TEST'))
        {
            $this->base_url = 'https://merchants.preprod.playdigital.com.ar';
        }
    }

    public function model(): PaymentMethod
    {
        return PaymentMethod::where('code', 'modo')->first();
    }

    public function generateToken()
    {
        $user = $this->key('modo_username');
        $password = $this->key('modo_password');

        $response = Http::withUserAgent('Simplecom')
                        ->asJson()
                        ->throw()
                        ->withBody(json_encode(['username' => $user, 'password' => $password])) 
                        ->post("$this->base_url/merchants/middleman/token")
                        ->json();

        if (!isset($response['accessToken']))
        {
            throw new Exception('Credenciales de MODO incorrectas');
        }

        $this->token = $response['accessToken'];
    }

    public function generateCheckout(Order $order)
    {
        $this->generateToken();

        $response = Http::withUserAgent('simplecom-'. tenant('name'))
                        ->withToken($this->token)
                        ->asJson()
                        ->throw()
                        ->withBody(json_encode([
                            'productName'         => "Pedido $order->code",
                            //'price'               => $order->total,
                            'price'               => 25.64,
                            'quantity'            => 1,
                            'currency'            => 'ARS',
                            'storeId'             => $this->key('modo_store_id'),
                            'externalIntentionId' => $order->id . '-' . uniqid()
                        ]))
                        ->post("$this->base_url/merchants/ecommerce/payment-intention")
                        ->json();

        if (!isset($response['id']))
        {
            throw new Exception('Error al generar intención de pago con MODO');
        }

        OrderPayment::updateOrCreate([
            'order_id'     => $order->id,
            'provider_id'  => $this->model()->id,
            'intention_id' => data_get($response, 'id')
        ], 
        [
            'status_code'     => PaymentStatusCode::Created,
            'external_status' => data_get($response, 'status'),
            'meta'            => [
                [
                    'name'  => 'ID intención externo',
                    'value' => data_get($response, 'externalIntentionId'),
                ],
                [
                    'name'  => 'Store ID',
                    'value' => data_get($response, 'storeId'),
                ],
                [
                    'name'     => 'QR',
                    'value'    => data_get($response, 'qr'),
                    'internal' => true
                ]
            ]
        ]);

        OrderFeedItem::create([
            'order_id'      => $order->id,
            'event'         => OrderFeedEvent::PaymentUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => $order->user->full_name,
            'action'        => 'inició el pago del pedido con MODO',
            'meta'          => [
                'icon_code' => 'qr_code_2'
            ]
        ]);

        $response['return_url'] = $order->paymentReturn();

        $this->frontend_payload = $response;
    }

    public function getPaymentInfo($intentionId)
    {
        $this->generateToken();

        $response = Http::withUserAgent('simplecom-'. tenant('name'))
                        ->withToken($this->token)
                        ->get("$this->base_url/merchants/ecommerce/payment-intention/$intentionId/data")
                        ->json();

        return $response;
    }
}