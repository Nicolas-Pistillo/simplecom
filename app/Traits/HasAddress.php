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

    public function getReferencesAttribute()
    {
        $references = collect();

        if (!empty($this->floor))
        {
            $references->push("Piso $this->floor");
        }

        if (!empty($this->apartment))
        {
            $references->push("Depto $this->apartment");
        }

        if (!empty($this->office))
        {
            $references->push("Oficina $this->office");
        }

        if (!empty($this->local))
        {
            $references->push("Local $this->local");
        }

        if (!empty($this->details))
        {
            $references->push($this->details);
        }

        return $references->isNotEmpty() ? $references->implode(', ') : '';
    }

    public function mapUrl()
    {
        if (empty($this->lat) || empty($this->lng)) return false;

        return "https://maps.google.com/?q=$this->lat,$this->lng";
    }
}