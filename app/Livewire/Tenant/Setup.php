<?php

namespace App\Livewire\Tenant;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Setup extends Component
{
    use WithFileUploads;

    public $currentStep = 'welcome';

    public $ecommerceLogo;

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
