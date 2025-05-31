<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class EcommerceDataConfiguration extends Form
{
    #[Validate('nullable|image|max:1024', as: 'logo')]
    public $ecommerce_logo;

    public $logo_preview;

    #[Validate('required|string|max:40', as: 'nombre de comercio')]
    public $ecommerce_name;

    #[Validate('nullable|string|max:50', as: 'slogan de comercio')]
    public $ecommerce_eslogan;

    #[Validate('required|email', as: 'email de contacto')]
    public $contact_email;

    #[Validate('nullable|string|size:10', as: 'número de whatsapp')]
    public $contact_whatsapp;

    #[Validate('nullable|boolean', as: 'botón de whatsapp')]
    public $whatsapp_button;

    #[Validate('nullable|numeric', as: 'teléfono de contacto')]
    public $contact_phone;
    
    #[Validate('nullable|url', as: 'perfil de facebook')]
    public $ecommerce_facebook;

    #[Validate('nullable|url', as: 'perfil de tiktok')]
    public $ecommerce_tiktok;

    #[Validate('nullable|url', as: 'perfil de instagram')]
    public $ecommerce_instagram;

    #[Validate('nullable|url', as: 'canal de youtube')]
    public $ecommerce_youtube;

    public function autocomplete()
    {
        $this->logo_preview        = tenant()->logo();
        $this->ecommerce_name      = tenant('ecommerce_name');
        $this->ecommerce_eslogan    = tenant()->configValue('ecommerce_eslogan');
        $this->contact_email       = tenant()->configValue('contact_email');
        $this->contact_whatsapp    = tenant()->configValue('contact_whatsapp');
        $this->whatsapp_button     = (bool) tenant()->configValue('whatsapp_button');
        $this->contact_phone       = tenant()->configValue('contact_phone');
        $this->ecommerce_facebook  = tenant()->configValue('ecommerce_facebook');
        $this->ecommerce_instagram = tenant()->configValue('ecommerce_instagram');
        $this->ecommerce_tiktok    = tenant()->configValue('ecommerce_tiktok');
        $this->ecommerce_youtube   = tenant()->configValue('ecommerce_youtube');
    }

    public function getMassiveUpdateFields()
    {
        return $this->except('ecommerce_logo', 'logo_preview');
    }
}
