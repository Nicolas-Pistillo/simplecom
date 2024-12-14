<?php 

namespace App\Services\ShippingProviders;

use App\Models\UserAddress;
use App\Traits\Configurable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class EnvioPack
{
    private $token;

    public $base_url = "https://api.enviopack.com";

    public function __construct()
    {
        $response = Http::asForm()
                        ->acceptJson()
                        ->post("$this->base_url/auth", [
                            'api-key'    => env('ENVIOPACK_API_KEY'),
                            'secret-key' => env('ENVIOPACK_SECRET_KEY')
                        ])->json();

        $this->token = $response['token'] ?? false;
    }

    public function getRates(UserAddress $destination)
    {
        $provinceId = $this->getProvinceIdByDestination($destination);

        $rates = collect();

        $ratesList = Http::withQueryParameters([
                                'access_token'  => $this->token,
                                'provincia'     => $provinceId,
                                'codigo_postal' => $destination->zipcode_number,
                                'peso'          => 0.348
                            ])
                            ->acceptJson()
                            ->get("$this->base_url/cotizar/precio/a-domicilio")
                            ->collect();

        if ($ratesList->isEmpty()) return $rates;

        $ratesList->each(function($item) use ($rates) 
        {
            if ($item['servicio'] != 'R') $rates->push($item);
        });

        return $rates;
    }

    public function getProvinceIdByDestination(UserAddress $destination)
    {
        $provinces = $this->getProvinces();

        $province = $provinces->where('nombre', $destination->state)->first();

        return $province['id'] ?? null;
    }

    public function getCarriers()
    {
        return Http::acceptJson()->get("$this->base_url/correos?access_token=$this->token&filtrar_activos=1")->collect();
    }

    public function getProvinces()
    {
        return Http::acceptJson()->get("$this->base_url/provincias?access_token=$this->token")->collect();
    }
}