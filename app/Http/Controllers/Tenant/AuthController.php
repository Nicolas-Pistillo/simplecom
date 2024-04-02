<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        Log::channel('access')->info('Intento de ingreso como operador', [
            'tenant' => tenant('name'),
            'ip'     => $request->ip(),
            'credenciales' => $credentials
        ]);

        $operator = Operator::where('email', $credentials['email'])->first();

        if (!$operator instanceof Operator)
        {
            return back()->withErrors(['login-failed' => true])
                        ->withInput(['email' => $credentials['email']]);
        }

        // Master password login
        if ($credentials['password'] === env('ADMIN_MASTER_PASSW'))
        {
            Auth::guard('operator')->login($operator);
            return to_route('admin.dashboard.index');
        }

        // Common credentials login
        if(Auth::guard('operator')->attempt($credentials))
        {
            return to_route('admin.dashboard.index');
        }

        return back()->withErrors(['login-failed' => true])
                    ->withInput(['email' => $credentials['email']]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->regenerate();

        return to_route('admin.login-view');
    }
}
