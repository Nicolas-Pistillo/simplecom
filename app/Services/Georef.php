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
        return Http::get("https://apis.datos.gob.ar/georef/api/provincias?max=$max")
                    ->collect('provincias');
    }

    public static function getLocalities(string $provinceId, int $max = 50)
    {
        return Http::get("https://apis.datos.gob.ar/georef/api/localidades?provincia=$provinceId&max=$max")
                ->collect('localidades');
    }
}