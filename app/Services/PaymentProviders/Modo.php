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
                        ->withBody(json_encode(['username' => $user, 'password' => $password])) 
                        ->post("$this->base_url/merchants/middleman/token")
                        ->json();

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
                            'price'               => 50,
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

        if (!$order->status_code != OrderStatusCode::PaymentPending)
        {
            $order->update(['status_code' => OrderStatusCode::PaymentPending]);
        }

        OrderPayment::updateOrCreate([
            'order_id'    => $order->id,
            'provider_id' => $this->model()->id,
        ], 
        [
            'status_code'     => PaymentStatusCode::Created,
            'external_status' => $response['status'],
            'meta'            => [
                [
                    'name'  => 'ID intención',
                    'value' => $response['id']
                ],
                [
                    'name'  => 'ID intención externo',
                    'value' => $response['externalIntentionId'],
                ],
                [
                    'name'  => 'Store ID',
                    'value' => $response['storeId']
                ],
                [
                    'name'     => 'QR',
                    'value'    => $response['qr'],
                    'internal' => true
                ]
            ]
        ]);

        OrderFeedItem::create([
            'order_id'      => $order->id,
            'event'         => OrderFeedEvent::PaymentUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => $order->user->full_name,
            'action'        => 'inició el proceso de pago utilizando MODO',
            'meta'          => [
                'icon_code' => 'qr_code_2_add'
            ]
        ]);

        $response['return_url'] = route('payment.return', [
            'provider'     => 'modo',
            'order'        => $order->id,
            'intention_id' => $response['id']
        ]);

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