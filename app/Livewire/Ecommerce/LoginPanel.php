<?php

namespace App\Livewire\Ecommerce;

use App\Enums\CustomerType;
use App\Livewire\Forms\LoginPanelForm;
use App\Mail\TestEmail;
use App\Models\User;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class LoginPanel extends Component
{
    use WithNotifications;

    protected $listeners = ['open-login-panel' => 'open'];

    public $tab = 'login';

    public LoginPanelForm $form;

    public function open($params = null)
    {
        if (isset($params['tab']))
        {
            $this->tab = $params['tab'];
        }
    }

    public function register()
    {
        $register_fields = $this->form->register_fields;

        foreach($register_fields as $field)
        {
            $this->form->validateOnly($field);
        }

        $email_used = User::where([
            'type'  => CustomerType::Registered->value, 
            'email' => $this->form->register_email
        ])->exists();

        if ($email_used) return $this->addError('form.register_email', 'Este email ya se encuentra en uso');

        $code = rand(100000, 999999);

        dd($code);

        Mail::to($this->form->register_email)->send(new TestEmail());

        dd("Mail enviado");
    }

    public function render()
    {
        return view('livewire.ecommerce.login-panel');
    }
}
