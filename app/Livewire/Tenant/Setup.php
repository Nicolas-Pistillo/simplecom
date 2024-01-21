<?php

namespace App\Livewire\Tenant;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Setup extends Component
{
    use WithFileUploads;

    public $currentStep = 'welcome';

    public $ecommerceLogo, $ecommerceLogoPreview, $ecommerceColor;

    public function mount()
    {
        if (tenant()->logo_url)
        {
            $this->ecommerceLogoPreview = Storage::url(tenant()->logo_url);
        }

        $this->ecommerceColor = tenant()->color;
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
        $this->validate([
            'ecommerceColor' => 'required'
        ]);

        if (!tenant()->logo_url)
        {
            $this->validate([
                'ecommerceLogo'  => 'required|image|max:1024'
            ]);
        }

        if ($this->ecommerceLogo)
        {
            $path = $this->ecommerceLogo->store(tenant()->name);

            if (!$path) abort(500);

            if (tenant()->logo_url) Storage::delete(tenant()->logo_url);

            tenant()->update([
                'logo_url' => $path
            ]);
        }

        tenant()->update([
            'color'    => $this->ecommerceColor
        ]);

        $this->currentStep = 2;
    }

    public function submitSecondStep()
    {
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
