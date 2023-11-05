<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index(Request $request)
    {
        return view('ecommerce.index');
    }

    public function contact(Request $request)
    {
        return view('ecommerce.contact');
    }
}
