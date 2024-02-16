<?php

namespace App\Livewire\Tenant;

use App\Models\Configuration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Setup extends Component
{
    use WithFileUploads;

    public $currentStep = 'welcome';

    public $ecommerceLogo, $ecommerceLogoPreview, $ecommerceColor;

    public $fisical_address, $attention_schedule, $contact_email, $contact_whatsapp,
    $ecommerce_instagram, $ecommerce_youtube;

    public $configurationModels;

    protected $validationAttributes = [
        'fisical_address'     => 'dirección fisica',
        'attention_schedule'  => 'horarios de atención',
        'contact_email'       => 'email de contacto',
        'contact_whatsapp'    => 'whatsapp',
        'ecommerce_instagram' => 'link a instagram',
        'ecommerce_youtube'   => 'link a youtube'
    ];

    public function mount()
    {
        if (tenant()->logo_url)
            $this->ecommerceLogoPreview = Storage::url(tenant()->logo_url);

        $this->ecommerceColor = tenant()->color;
        $this->configurationModels = tenant()->getSetupConfigs();
    }

    public function updatedEcommerceLogo()
    {
        $this->ecommerceLogoPreview = $this->ecommerceLogo->temporaryUrl();
    }

    public function beginSetup()
    {
        $this->currentStep = 1;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function submitFirstStep()
    {
        $this->validate(['ecommerceColor' => 'required']);

        if (!tenant()->logo_url)
        {
            $this->validate(['ecommerceLogo' => 'required|image|max:1024']);
        }

        if ($this->ecommerceLogo)
        {
            $path = $this->ecommerceLogo->store(tenant()->name);

            if (!$path) abort(500);

            if (tenant()->logo_url) Storage::delete(tenant()->logo_url);

            tenant()->update(['logo_url' => $path]);
        }

        tenant()->update(['color' => $this->ecommerceColor]);

        $this->currentStep = 2;
    }

    public function submitSecondStep()
    {
        $validated = $this->validate([
            'fisical_address'     => 'required|string',
            'attention_schedule'  => 'required|string',
            'contact_email'       => 'required|email',
            'contact_whatsapp'    => 'required|numeric',
            'ecommerce_instagram' => 'nullable|url',
            'ecommerce_youtube'   => 'nullable|url'
        ]);

        dd($validated);

        $this->currentStep = 3;
    }

    public function submitThirdStep()
    {
        dd("LO LOGRASTE");
    }

    public function render()
    {
        return view('livewire.tenant.setup');
    }
}
