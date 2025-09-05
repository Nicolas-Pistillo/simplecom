<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Argentina public geographical API
 */
class Georef
{
    public static function getProvinces(int $max = 50)
    {
        return Http::get("https://apis.datos.gob.ar/georef/api/provincias?campos=id,iso_nombre&max=$max")
                    ->collect('provincias')
                    ->sort();
    }

    public static function searchLocalities(string $provinceId, int $max = 50)
    {
        return Http::get("https://apis.datos.gob.ar/georef/api/localidades?provincia=$provinceId&campos=id,iso_nombre&max=$max")
                ->collect('');
    }
}