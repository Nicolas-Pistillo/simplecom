<?php

namespace App\Traits;

trait HasAddress
{
    public function getAddressAttribute()
    {
        $address = "$this->street $this->number - $this->locality";


        if (!empty($this->floor))
        {
            $address .= " Piso $this->floor";
        }

        if (!empty($this->local))
        {
            $address .= " Local $this->local";
        }

        return $address;
    }

    public function getZipcodeNumberAttribute()
    {
        return preg_replace("/[^0-9]/", "", $this->zipcode);
    }

    public function mapUrl()
    {
        if (empty($this->lat) || empty($this->lng)) return false;

        return "https://maps.google.com/?q=$this->lat,$this->lng";
    }
}