<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public static function getCustomColumns(): array
    {
        return [
            'id', 
            'name', 
            'ecommerce_name',
            'logo_url',
            'color',
            'sector_id', 
            'plan_id', 
            'active'
        ];
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function config($key = null)
    {
        return $key ? Configuration::where('key', $key)->first() : Configuration::all();
    }

    public function getSetupConfigs()
    {
        return Configuration::where('show_in_setup', 1)->get();
    }
}