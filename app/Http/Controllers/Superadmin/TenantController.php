<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    public function index()
    {
        return view('superadmin.tenants.index', [
            'tenants' => Tenant::with('domains')->get()
        ]);
    }

    public function create()
    {
        return view('superadmin.tenants.create', [
            'sectors' => Sector::orderBy('name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tenantData = $request->validate([
            'name' => ['required', 'string', 'unique:tenants,name', 'regex:/^\S*$/u'],
            'ecommerce_name' => ['required', 'string']
        ]);

        $tenantData['tenancy_db_name'] = config('tenancy.database.prefix') . $tenantData['name'];

        $tenant = Tenant::create($tenantData);

        $tenant->domains()->create([
            'domain' => $tenantData['name'] . '.localhost'
        ]);

        return redirect()->route('superadmin.tenants.index')->with('tenant_created', true);
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
