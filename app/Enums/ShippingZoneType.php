<?php

namespace App\Enums;

enum ShippingZoneType: string
{
    case CountryAll    = 'country_all';
    case ByProvinces   = 'by_provinces';
    case ByPostalCodes = 'by_postal_codes';
    case ByDistanceKm  = 'by_distance_km';

    public function name(): string
    {
        return match($this)
        {
            self::CountryAll    => 'Todo el país',
            self::ByProvinces   => 'Por provincias',
            self::ByPostalCodes => 'Por códigos postales',
            self::ByDistanceKm  => 'Por distancia en KM'
        };
    }
}