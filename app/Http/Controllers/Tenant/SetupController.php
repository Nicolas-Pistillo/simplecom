<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.setup.index');
    }
}
