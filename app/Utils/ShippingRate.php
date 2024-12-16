<?php 

namespace App\Utils;

use Illuminate\Support\Collection;

class ShippingRate
{
    public $source;
    public $source_name;
    public $source_data;

    public $service_id;
    public $service_name;

    public $carrier_id;
    public $carrier_name;
    public $carrier_logo;

    public $price;
    public $estimate;
    public Collection $branches;

    public function __construct($properties = [])
    {
        foreach($properties as $property => $value)
        {
            if (property_exists($this, $property))
            {
                $this->{$property} = $value;
            }
        }

        if (empty($this->branches)) $this->branches = collect();
    }
}