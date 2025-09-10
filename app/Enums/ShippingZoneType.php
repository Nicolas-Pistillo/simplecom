<?php

namespace App\Enums;

enum ShippingZoneType: string
{
    case CountryAll    = 'country_all';
    case ByLocalities  = 'by_localities';
    case ByZipcodes    = 'by_zipcodes';
    case ByDistanceKm  = 'by_distance_km';

    public function name(): string
    {
        return match($this)
        {
            self::CountryAll    => 'Todo el país',
            self::ByLocalities  => 'Por localidades',
            self::ByZipcodes    => 'Por códigos postales',
            self::ByDistanceKm  => 'Por distancia en KM'
        };
    }
}