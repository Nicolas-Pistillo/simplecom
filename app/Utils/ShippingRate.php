<?php 

namespace App\Utils;

use App\Enums\LogisticType;
use Illuminate\Support\Collection;

class ShippingRate
{
    public $key;
    public $label;
    public $contract;

    public $source;
    public $source_name;
    public $source_data;
    public $source_logistic_type;
    public $source_observations;

    public $service_id;
    public $service_code;
    public $service_name;

    public LogisticType $logistic_type;

    public $carrier_id;
    public $carrier_name;
    public $carrier_code;
    public $carrier_logo;

    public $price;
    public $estimate;
    public Collection $branches;

    public function __construct($properties = [])
    {
        $this->key = uniqid();
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