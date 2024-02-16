<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(Auth::guard('operator')->attempt($credentials))
        {
            return to_route('admin.dashboard.index');
        }

        return back()->withErrors(['login-failed' => true])
                    ->withInput(['email' => $request->email]);
    }

    public function logoutAdmin(Request $request)
    {
        Auth::logout();

        $request->session()->regenerate();

        return to_route('admin.login-view');
    }
}
