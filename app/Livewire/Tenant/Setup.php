<?php

namespace App\Livewire\Tenant;

use Livewire\Component;

class Setup extends Component
{
    public $currentStep = 'welcome';

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
