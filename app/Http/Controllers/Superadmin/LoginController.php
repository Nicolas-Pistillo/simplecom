<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(Auth::guard('superadmin')->attempt($credentials))
        {
            return redirect()->route('superadmin.dashboard.index');
        }

        return back()->withErrors(['login-failed', 'true']);
    }
}
