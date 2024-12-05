<?php

namespace App\Livewire\Ecommerce;

use App\Enums\CustomerType;
use App\Livewire\Forms\RegisterForm;
use App\Livewire\Forms\LoginForm;
use App\Mail\EmailVerification;
use App\Mail\TestEmail;
use App\Models\EmailVerificationCode;
use App\Models\User;
use App\Traits\Livewire\WithNotifications;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class LoginPanel extends Component
{
    use WithNotifications;

    protected $listeners = ['open-login-panel' => 'open'];

    public $tab = 'login';

    public LoginForm $login_form;

    public RegisterForm $register_form;

    public function open($params = null)
    {
        if (isset($params['tab']))
        {
            $this->tab = $params['tab'];
        }
    }

    public function register()
    {
        $this->register_form->validate();

        try 
        {
            $registerEmail = $this->register_form->email;

            $verificationModel = EmailVerificationCode::create([
                'ip'         => request()->ip(),
                'email'      => $registerEmail,
                'code'       => rand(100000, 999999),
                'expires_at' => now()->addMinutes(15)->toDateTimeString()
            ]);

            $recipient_name = $this->register_form->name;
            $code = $verificationModel->code;

            Mail::to($registerEmail)->send(new EmailVerification($recipient_name, $code));
    
            dd("Mail enviado");

        } catch (\Throwable $err) 
        {
            Log::channel('error')->info($err->getMessage(), [
                'tenant'  => tenant('name'),
                'context' => 'user-registration'
            ]);

            $this->notify([
                'type'  => 'danger', 
                'title' => 'Error al enviar el correo de verificación',
                'body'  => 'Por favor, vuelva a intentarlo mas tarde'
            ]);
        }
    }

    public function mount()
    {
        $this->register_form->fill([
            'name'     => 'Nicolas',
            'lastname' => 'Pistillo',
            'email'    => 'pistillonicolas@gmail.com',
            'password' => 'Xeneize12',
            'password_repeat' => 'Xeneize12'
        ]);
    }

    public function render()
    {
        return view('livewire.ecommerce.login-panel');
    }
}
