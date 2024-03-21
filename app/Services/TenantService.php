<?php 

namespace App\Services;

use App\Http\Requests\CreateTenantRequest;
use App\Models\Tenant;
use App\Models\Operator;
use Illuminate\Support\Facades\Hash;

class TenantService
{
    public static function createFromAdminForm(CreateTenantRequest $request)
    {
        $tenant = Tenant::create([
            'name'              => $request->tenant_name,
            'ecommerce_name'    => $request->ecommerce_name,
            'sector_id'         => $request->sector_id,
            'plan_id'           => $request->plan_id,
            'tenancy_db_name'   => config('tenancy.database.prefix') . $request->tenant_name
        ]);

        $tenant->domains()->create([
            'domain' => $request->tenant_name . '.' . env('APP_DOMAIN')
        ]);

        $tenant->run(function() use ($request) {
            Operator::create([
                'name'     => $request->admin_name,
                'email'    => $request->admin_email,
                'password' => Hash::make($request->admin_password)
            ])->assignRole('Administrador');
        });
    }
}