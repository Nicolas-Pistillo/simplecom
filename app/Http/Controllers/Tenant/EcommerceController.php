<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index(Request $request)
    {
        return view('ecommerce.index', [
            'banners' => Banner::published()->get()
        ]);
    }

    public function contact(Request $request)
    {
        return view('ecommerce.contact');
    }

    public function about(Request $request)
    {
        return view('ecommerce.about');
    }
}
