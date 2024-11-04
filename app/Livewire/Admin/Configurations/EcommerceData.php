<?php

namespace App\Livewire\Admin\Configurations;

use App\Enums\ConfigurationTopics;
use App\Models\Configuration;
use Livewire\Component;

class EcommerceData extends Component
{
    public $configurations;

    public $ecommerce_logo;
    public $fisical_address;
    public $attention_schedule;
    public $contact_email;
    public $contact_whatsapp;
    public $ecommerce_instagram;
    public $ecommerce_youtube;

    public $excludes = ['contact_whatsapp'];

    public function save()
    {
        $this->validate([
            'ecommerce_logo'      => 'nullable',
            'fisical_address'     => 'required',
            'ecommerce_instagram' => 'nullable',
            'attention_schedule'  => 'required',
            'contact_whatsapp'    => 'required'
        ]);
    }

    public function mount()
    {
        $configurations = Configuration::where('topic', ConfigurationTopics::EcommerceData)->get();

        foreach ($configurations as $configuration) 
        {
            if (property_exists(self::class, $configuration->key))
                $this->{$configuration->key} = $configuration->value; 
        }

        $this->configurations = $configurations->whereNotIn('key', $this->excludes);
    }

    public function render()
    {
        return view('livewire.admin.configurations.ecommerce-data');
    }
}
