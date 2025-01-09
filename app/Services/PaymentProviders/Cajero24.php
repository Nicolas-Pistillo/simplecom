<?php 

namespace App\Services\PaymentProviders;

use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;

class Cajero24 implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['cajero24_token'];

    public function generateCheckout($order)
    {
        $items = Cart::content()->map(fn($product) => [
            'name'               => $product->name, 
            'external_reference' => $product->id,
            'amount'             => $product->price * $product->qty
        ])->toArray();

        $response = Http::withBody(json_encode([
            'access_token'       => $this->key('cajero24_token'),
            'currency'           => 'ARS',
            'external_reference' => 'PEDIDO XXX',
            'url_success'        => route('payment.return', 'cajero24'),
            'url_pending'        => route('payment.return', 'cajero24'),
            'url_failure'        => route('payment.return', 'cajero24'),
            'ipn'                => route('payment.webhook', 'cajero24'),
            'items'              => $items
        ]))
        ->post('https://cajero24.co/api/pay/create')
        ->json();

        $this->provider_checkout_url = $response['link'];
    }
}