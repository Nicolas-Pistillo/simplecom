<?php

namespace App\Livewire\Admin;

use App\Models\Configuration;
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

    public $availableColors = [
        'pink', 'red', 'indigo', 'purple', 'sky', 'cyan', 'orange',
        'emerald', 'lime', 'blue', 'green', 'rose', 'yellow',
        'violet', 'amber', 'teal', 'fuchsia'
    ];

    protected $validationAttributes = [
        'fisical_address'     => 'dirección fisica',
        'attention_schedule'  => 'horarios de atención',
        'contact_email'       => 'email de contacto',
        'contact_whatsapp'    => 'whatsapp',
        'ecommerce_instagram' => 'link a instagram',
        'ecommerce_youtube'   => 'link a youtube'
    ];

    private function configValue($key)
    {
        return $this->configurationModels->where('key', $key)->first()->value;
    }

    public function mount()
    {
        if (tenant()->logo_url)
            $this->ecommerceLogoPreview = Storage::url(tenant()->logo_url);

        $this->ecommerceColor = tenant()->color;
        $this->configurationModels = tenant()->getSetupConfigs();

        $this->fill([
            'fisical_address'     => $this->configValue('fisical_address'),
            'attention_schedule'  => $this->configValue('attention_schedule'),
            'contact_email'       => $this->configValue('contact_email'),
            'contact_whatsapp'    => $this->configValue('contact_whatsapp'),
            'ecommerce_instagram' => $this->configValue('ecommerce_instagram'),
            'ecommerce_youtube'   => $this->configValue('ecommerce_youtube')
        ]);
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
        $fields = $this->validate([
            'fisical_address'     => 'required|string',
            'attention_schedule'  => 'required|string',
            'contact_email'       => 'required|email',
            'contact_whatsapp'    => 'required|numeric',
            'ecommerce_instagram' => 'nullable|url',
            'ecommerce_youtube'   => 'nullable|url'
        ]);

        foreach($fields as $key => $value)
        {
            Configuration::where('key', $key)->update(compact('value'));
        }

        tenant()->update(['setup_completed' => true]);

        $this->currentStep = 'finished';
    }

    public function render()
    {
        return view('livewire.admin.setup');
    }
}
