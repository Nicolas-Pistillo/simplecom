<?php 

namespace App\Utils;

use Illuminate\Support\Collection;

class ShippingRate
{
    public $label;

    public $source;
    public $source_name;
    public $source_data;

    public $service_id;
    public $service_code;
    public $service_name;

    public $dispatch_type;

    public $carrier_id;
    public $carrier_name;
    public $carrier_logo;

    public $price;
    public $estimate;
    public $meta;
    public Collection $branches;

    public function __construct($properties = [])
    {
        $this->branches = collect();

        foreach($properties as $property => $value)
        {
            if (property_exists($this, $property))
            {
                $this->{$property} = $value;
            }
        }
    }
}