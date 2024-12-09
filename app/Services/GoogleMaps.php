<?php

namespace App\Services;

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

        $results = collect();

        $response = Http::get("https://maps.googleapis.com/maps/api/place/autocomplete/json?input=$search&language=es&type=address&components=country:ar&key=$api_key")->json();

        if (!empty($response) && !empty($response['predictions']))
        {
            foreach ($response['predictions'] as $prediction) 
            {
                if (in_array('route', $prediction['types'])) continue;
                $results->push($prediction);
            }
        }

        return $results;
    }

    public static function getPlaceDetails($placeId)
    {
        $api_key = env('MAPS_API_KEY');

        $data = [];

        $response = Http::get("https://maps.googleapis.com/maps/api/place/details/json?place_id=$placeId&key=$api_key")->json();

        if (isset($response['status']) && $response['status'] == 'OK')
        {
            $data['place_id'] = $placeId;

            $data['name'] = $response['result']['name'];

            $data['full_name'] = $response['result']['formatted_address'];

            $data['map_url'] = $response['result']['url'];

            $data['coordinates'] = $response['result']['geometry']['location'];

            foreach($response['result']['address_components'] as $component)
            {
                if (in_array('route', $component['types']))
                {
                    $data['street'] = $component['short_name'];
                }

                if (in_array('street_number', $component['types']))
                {
                    $data['number'] = $component['short_name'];
                }

                if (in_array('postal_code', $component['types']))
                {
                    $data['raw_zipcode'] = $component['short_name'];
                    $data['zipcode'] = preg_replace("/[^0-9.]/", '', $data['raw_zipcode']);
                }

                if (in_array('locality', $component['types']))
                {
                    $data['locality'] = $component['short_name'];
                }

                if (in_array('administrative_area_level_1', $component['types']))
                {
                    $data['province'] = str_replace('Provincia de ', '', $component['short_name']);
                }
            }
        }

        return $data;
    }
}