<?php 

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantService
{
    public static function updateTenantFromAdminForm(Request $request, Tenant $tenant)
    {
        if ($request->tenant_name != $tenant->name)
        {
            $request->validate([
                'tenant_name' => ['required', 'string', 'unique:tenants,name', 'regex:/^\S*$/u']
            ]);

            $tenant->update(['name' => $request->tenant_name]);

            $tenant->domains->first()->update([
                'domain' => $request->tenant_name . '.'  . env('APP_DOMAIN')
            ]);
        }

        $fields = $request->validate([
            'ecommerce_name' => ['required', 'string'],
            'sector_id'      => ['required', 'exists:sectors,id']
        ]);

        $tenant->update($fields);
    }
}