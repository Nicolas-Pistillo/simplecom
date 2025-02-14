<?php

namespace App\Jobs;

use App\Http\Requests\CreateTenantRequest;
use App\Models\Operator;
use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class CreateTenantFromAdminForm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $request;

    /**
     * Create a new job instance.
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $tenant = Tenant::create([
            'name'              => $this->request['tenant_name'],
            'ecommerce_name'    => $this->request['ecommerce_name'],
            'sector_id'         => $this->request['sector_id'],
            'tenancy_db_name'   => config('tenancy.database.prefix') . $this->request['tenant_name']
        ]);

        $tenant->domains()->create([
            'domain' => $this->request['tenant_name'] . '.' . env('APP_DOMAIN')
        ]);

        $tenant->run(function() {
            Operator::create([
                'name'     => $this->request['admin_name'],
                'email'    => $this->request['admin_email'],
                'password' => Hash::make($this->request['admin_password'])
            ])->assignRole('Administrador');
        });
    }
}
