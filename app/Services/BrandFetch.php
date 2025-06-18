<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BrandFetch
{
    /**
     * Busca información de una marca existente con el nombre proporcionado en $brandName
     */
    public static function searchBrand($brandName)
    {
        $response = Http::withToken(env('BRANDFETCH_API_KEY'))
                    ->get("https://api.brandfetch.io/v2/search/$brandName");

        if ($response->failed()) return false;

        return $response->json();
    }
}