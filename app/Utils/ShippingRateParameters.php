<?php 

namespace App\Utils;

use App\Models\UserAddress;

class ShippingRateParameters
{
    public $recipient_name;
    public $recipient_email;
    public $recipient_phone;
    public $recipient_document;
    public UserAddress|Address $recipient_address;

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