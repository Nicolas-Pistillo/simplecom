<?php 

namespace App\Services;

use App\Enums\PaymentRedirectType;
use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Illuminate\Support\Facades\Http;

class Modo implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['modo_username', 'modo_password', 'modo_store_id'];

    public function __construct()
    {
        $this->redirect_type = PaymentRedirectType::FrontendCheckout;
        $this->base_url = 'https://merchants.preprod.playdigital.com.ar/merchants';
    }

    public function generateToken()
    {
        $user = tenant()->configValue('modo_username');
        $password = tenant()->configValue('modo_password');

        $response = Http::withUserAgent('Simplecom')
                        ->asJson()
                        ->withBody(json_encode(['username' => $user, 'password' => $password])) 
                        ->post("$this->base_url/middleman/token")
                        ->json();

        $this->token = $response['accessToken'];
    }

    public function generateCheckout($order)
    {
        $this->generateToken();

        $store_id = tenant()->configValue('modo_store_id');

        $response = Http::withUserAgent('Simplecom')
                        ->withToken($this->token)
                        ->asJson()
                        ->withBody(json_encode([
                            'productName' => 'Zapatillas dupla',
                            'price'       => 12500.60,
                            'quantity'    => 2,
                            'currency'    => 'ARS',
                            'storeId'     => $store_id,
                            'externalIntentionId' => uniqid()
                        ]))
                        ->post("$this->base_url/ecommerce/payment-intention")
                        ->json();

        $this->frontend_payload = $response;
    }
}