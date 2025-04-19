<?php

namespace App\Livewire\Ecommerce;

use App\Enums\CustomerType;
use App\Enums\TaxCondition;
use App\Livewire\Forms\RegisterForm;
use App\Livewire\Forms\LoginForm;
use App\Models\User;
use App\Notifications\NewCustomerNotification;
use App\Services\EmailVerificationService;
use App\Services\NotificationService;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LoginPanel extends Component
{
    use WithNotifications;

    protected $listeners = ['open-login-panel' => 'open'];

    public $tab = 'login';

    public LoginForm $login_form;
    public RegisterForm $register_form;

    public $waiting_register_code = false;
    public $email_verify_code;

    public function open($params = null)
    {
        if (Auth::check()) return $this->dispatch('close-login-panel');

        if (isset($params['tab']))
        {
            $this->tab = $params['tab'];
        }
    }

    public function validateRegister()
    {
        $this->register_form->validate();

        try 
        {
            EmailVerificationService::sendTo($this->register_form->email, $this->register_form->name);
    
            $this->waiting_register_code = true;

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

    public function register()
    {
        try 
        {
            if (EmailVerificationService::check($this->register_form->email, $this->email_verify_code))
            {
                $user = User::create([
                    'type'          => CustomerType::Registered,
                    'name'          => $this->register_form->name,
                    'lastname'      => $this->register_form->lastname,
                    'email'         => $this->register_form->email,
                    'password'      => Hash::make($this->register_form->password),
                    'tax_condition' => TaxCondition::ConsumidorFinal,
                    'newsletter_subscribed' => $this->register_form->newsletter_check
                ]);

                NotificationService::toOperators(new NewCustomerNotification($user));

                $this->tab = 'login';
                $this->waiting_register_code = false;
                $this->register_form->reset();

                $this->notify([
                    'type'  => 'success',
                    'title' => 'Registro de cuenta',
                    'body'  => '¡Listo! Ya podes iniciar sesión con el email y contraseña que registraste'
                ]);
            }

            return $this->addError('email_verify_code', 'El código expiró o es incorrecto');

        } catch (\Throwable $err) 
        {
            Log::channel('error')->info($err->getMessage(), [
                'tenant'  => tenant('name'),
                'context' => 'user-creating-from-panel'
            ]);

            $this->notify([
                'type'  => 'danger', 
                'title' => 'Error al completar el registro',
                'body'  => 'Por favor, vuelva a intentarlo mas tarde'
            ]);
        }
    }

    public function login()
    {
        $this->login_form->validate();

        try 
        {
            $user = User::where([
                'type'     => CustomerType::Registered,
                'email'    => $this->login_form->email
            ])->first();
    
            if ($user instanceof User && Hash::check($this->login_form->password, $user->password))
            {
                Auth::login($user, $this->login_form->remember);
                return redirect(request()->header('Referer'))->with('login_message', true);
            }

            return session()->flash('login_error');

        } catch (\Throwable $err) 
        {
            Log::channel('error')->info($err->getMessage(), [
                'tenant'  => tenant('name'),
                'context' => 'user-login'
            ]);

            $this->notify([
                'type'  => 'danger',
                'title' => 'Error al generar la sesión',
                'body'  => 'Por favor, vuelva a intentarlo mas tarde'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.ecommerce.login-panel');
    }
}
