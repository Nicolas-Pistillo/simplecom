<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTenantRequest;
use App\Models\Admin;
use App\Models\Plan;
use App\Models\Sector;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{
    public function index()
    {
        return view('superadmin.tenants.index', [
            'tenants' => Tenant::with(['domains', 'plan', 'sector'])->get()
        ]);
    }

    public function create(Request $request)
    {
        return view('superadmin.tenants.create', [
            'sectors' => Sector::orderBy('name')->get(),
            'plans' => Plan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTenantRequest $request)
    {
        $tenant = Tenant::create([
            'name'              => $request->name,
            'ecommerce_name'    => $request->ecommerce_name,
            'sector_id'         => $request->sector_id,
            'plan_id'           => $request->plan_id,
            'tenancy_db_name'   => config('tenancy.database.prefix') . $request->name
        ]);

        $tenant->domains()->create([
            'domain' => $request->name . '.' . env('APP_DOMAIN')
        ]);

        $tenant->run(function() use ($request) {
            Admin::create([
                'name' => 'Administrador',
                'email' => $request->admin_email,
                'password' => Hash::make($request->admin_password)
            ]);
        });

        return to_route('superadmin.tenants.index')->with('tenant_created', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
