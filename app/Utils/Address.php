<?php 

namespace App\Utils;

class Address
{
    public $summary;

    public $street;
    public $number;
    public $zipcode;
    public $zipcode_number;
    public $locality;
    public $region;
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

        if (!$this->zipcode_number)
        {
            $this->zipcode_number = preg_replace("/[^0-9]/", "", $this->zipcode);
        }
    }

    public function summary()
    {
        return "$this->street $this->number - $this->locality";
    }

    public function mapCoordinates()
    {
        return $this->coordinates['lat'] . ',' . $this->coordinates['lng'];
    }
}