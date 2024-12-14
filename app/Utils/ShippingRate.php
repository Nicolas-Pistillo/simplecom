<?php 

namespace App\Utils;

class ShippingRate
{
    public $source;
    public $source_name;

    public $service_id;
    public $service_name;

    public $carrier_id;
    public $carrier_name;
    public $carrier_logo;

    public $price;
    public $estimate;
    public $branch;

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