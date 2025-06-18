<?php

namespace App\Services;

use App\Utils\Address;
use Illuminate\Support\Facades\Http;

class GoogleMaps
{
    public static function geocode($search)
    {
        $api_key =  env('MAPS_API_KEY');
        return Http::get("https://maps.googleapis.com/maps/api/geocode/json?address=$search&key=$api_key")->json();
    }

    public static function autocompleteAddress($search)
    {
        $api_key =  env('MAPS_API_KEY');

        $predictions = Http::get("https://maps.googleapis.com/maps/api/place/autocomplete/json?input=$search&language=es&type=address&components=country:ar&key=$api_key")->collect('predictions');

        return $predictions->filter(fn($prediction) => !in_array('route', $prediction['types']));
    }

    public static function getPlaceDetails($placeId)
    {
        $api_key = env('MAPS_API_KEY');
        return Http::get("https://maps.googleapis.com/maps/api/place/details/json?place_id=$placeId&key=$api_key")->collect('result');
    }

    public static function getAddressByPlace($placeId)
    {
        $result = self::getPlaceDetails($placeId);

        if (!$result || $result->isEmpty()) return false;

        $address = new Address([
            'google_place_id' => $placeId,
            'google_map_url'  => $result->get('url'),
            'coordinates'     => data_get($result, 'geometry.location')
        ]);

        foreach ($result->get('address_components') as $component) 
        {
            if (in_array('route', $component['types'])) 
            {
                $address->street = $component['short_name'];
            }

            if (in_array('street_number', $component['types'])) 
            {
                $address->number = $component['short_name'];
            }

            if (in_array('postal_code', $component['types'])) 
            {
                $address->zipcode = $component['short_name'];
            }

            if (in_array('locality', $component['types'])) 
            {
                $address->locality = $component['short_name'];
            }

            if (in_array('administrative_area_level_2', $component['types']) 
            && empty($address->locality)) 
            {
                $address->locality = $component['short_name'];
            }

            if (in_array('administrative_area_level_1', $component['types'])) 
            {
                $address->state = $component['short_name'] == 'Cdad. Autónoma de Buenos Aires'
                                                            ? 'Capital Federal'
                                                            : str_replace('Provincia de ', '', $component['short_name']);
            }
        }

        if (isset($address->locality))
        {
            $cityInfo = cityInfo($address->locality);

            if (!empty($cityInfo))
            {
                $address->state_code = $cityInfo[0]['state']['code']['2digit'];
                $address->zipcode = $address->zipcode ?? $cityInfo[0]['zip_codes'][0]['zip_code'];
            }

            if (empty($cityInfo) && isset($address->zipcode))
            {
                $zipcodeInfo = zipcodeInfo($address->zipcode);

                if (!empty($zipcodeInfo))
                {
                    $address->state_code = data_get($zipcodeInfo, '0.state.code.2digit');
                }
            }
        }

        $address->summary = "$address->street $address->number - $address->locality";
        $address->lat_lng = $address->coordinates['lat'] . ',' . $address->coordinates['lng'];

        return $address;
    }
}
