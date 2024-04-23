<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTenantRequest;
use App\Jobs\CreateTenantFromAdminForm;
use App\Models\Plan;
use App\Models\Sector;
use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        return view('superadmin.tenants.index');
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
        CreateTenantFromAdminForm::dispatch($request->all());
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
    public function edit(Tenant $tenant)
    {
        return view('superadmin.tenants.edit', [
            'tenant'  => $tenant,
            'sectors' => Sector::all(),
            'plans'   => Plan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        TenantService::updateTenantFromAdminForm($request, $tenant);
        return to_route('superadmin.tenants.index')->with('tenant_updated', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
