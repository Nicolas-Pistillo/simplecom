<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect(Request $request, $driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback(Request $request, $driver)
    {
        $user = Socialite::driver($driver)->user();

        dd($user);
    }
}
