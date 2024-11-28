<?php 

namespace App\Services\ShippingProviders;

use Illuminate\Support\Facades\Http;

class Envia
{
    private $token;

    public $api_base_url = 'https://api.envia.com';
    public $queries_base_url = 'https://queries.envia.com';

    public function __construct()
    {
        $this->token = env('ENVIA_TOKEN');

        if (env('ENVIA_TEST'))
        {
            $this->token = env('ENVIA_TEST_TOKEN');

            $this->api_base_url = 'https://api-test.envia.com';
            $this->queries_base_url = 'https://queries-test.envia.com';
        }
    }

    /**
     * Muestra los proveedores de mensajeria activos en envia.com
     * URL: https://docs.envia.com/?version=latest#5962b030-c37f-449c-899b-7935cb93d66b
     */
    public function getCarriers()
    {
        return Http::withToken($this->token)->get("$this->queries_base_url/available-carrier/AR/0")->json();
    }

    /**
     * Muestra los servicios que dispone cada proveedor de logística
     * URL: https://docs.envia.com/?version=latest#04f62716-1922-4be1-ae35-2abc48288fb0
     */
    public function getCarrierServices()
    {
        return Http::get("$this->queries_base_url/service?country_code=AR")->json();
    }

    public static function geocodeByPostalCode($postal_code)
    {
        return Http::get("https://geocodes.envia.com/zipcode/AR/$postal_code")->json();
    }

    public static function geocodeByCity($city)
    {
        return Http::get("https://geocodes.envia.com/locate/AR/$city")->json();
    }
}