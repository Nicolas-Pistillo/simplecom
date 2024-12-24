<?php 

namespace App\Utils;

use App\Utils\Address;

class ShippingBranch
{
    public $source;
    public $source_name;

    public $price;
    public $meta;

    public $external_id;
    public $external_code;
    public $external_type;

    public $name;
    public $phone;
    public $schedule;
    public Address $address;

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