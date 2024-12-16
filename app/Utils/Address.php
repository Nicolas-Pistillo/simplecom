<?php 

namespace App\Utils;

class Address
{
    public $short_name;
    public $name;

    public $street;
    public $number;
    public $zipcode;
    public $locality;
    public $state;
    public $state_code;
    public $references;

    public $coordinates;
    public $lat_lng;

    public $google_place_id;
    public $google_map_url;

    public function __construct($properties = [])
    {
        foreach($properties as $property => $value)
        {
            if (property_exists($this, $property))
            {
                $this->{$property} = $value;
            }
        }        
    }
}