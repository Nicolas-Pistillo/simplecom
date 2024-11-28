<?php 

namespace App\Services\ShippingProviders;

use App\Traits\Configurable;
use Illuminate\Support\Facades\Http;

class Zippin
{
    use Configurable;

    protected $configuration_keys = ['zippin_client_id', 'zippin_client_secret'];

    private $base_url = 'https://api.zippin.com.ar/v2';

    public function getAccounts()
    {
        return Http::withBasicAuth(env('ZIPPIN_CLIENT_ID'), env('ZIPPIN_CLIENT_SEC'))
                    ->get("$this->base_url/accounts")
                    ->json();
    }

    public function getOrigins()
    {
        return Http::withBasicAuth(env('ZIPPIN_CLIENT_ID'), env('ZIPPIN_CLIENT_SEC'))
                    ->get("$this->base_url/addresses")
                    ->json();
    }

    public function getWebhooks()
    {
        return Http::withBasicAuth(env('ZIPPIN_CLIENT_ID'), env('ZIPPIN_CLIENT_SEC'))
                    ->get("$this->base_url/accounts/16082/webhooks")
                    ->json();
    }
}