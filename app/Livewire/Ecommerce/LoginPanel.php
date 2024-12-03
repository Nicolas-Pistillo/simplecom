<?php

namespace App\Livewire\Ecommerce;

use App\Livewire\Forms\LoginPanelForm;
use Livewire\Component;

class LoginPanel extends Component
{
    protected $listeners = ['open-user-panel' => 'openPanel'];

    public $tab = 'login';

    public LoginPanelForm $form;

    public function openPanel($params = null)
    {
        if (isset($params['tab']))
        {
            $this->tab = $params['tab'];
        }
    }

    public function render()
    {
        return view('livewire.ecommerce.login-panel');
    }
}
