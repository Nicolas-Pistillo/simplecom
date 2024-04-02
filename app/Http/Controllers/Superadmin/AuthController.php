<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
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

        Log::channel('access')->info('Intento de ingreso como superadmin', [
            'ip'           => $request->ip(),
            'credenciales' => $credentials
        ]);

        if(Auth::guard('superadmin')->attempt($credentials))
        {
            return to_route('superadmin.dashboard.index');
        }

        return back()->withErrors(['login-failed', true])
                    ->withInput(['email' => $request->email]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->regenerate();

        return to_route('superadmin.login-view');
    }
}
