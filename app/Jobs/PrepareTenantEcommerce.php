<?php

namespace App\Jobs;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class PrepareTenantEcommerce implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Tenant $tenant;
    private string $testName = "Nombre de usuario job";

    /**
     * Create a new job instance.
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Insert the tenant ecommerce data to prepare their marketplace
     */
    public function handle(): void
    {
        $this->tenant->run(function($tenant) {

            // Tenant domain
            $tenant->domains()->create([
                'domain' => $tenant->name . '.localhost'
            ]);

            User::create([
                'name' => $this->testName,
                'email' => 'test@test.com',
                'password' => Hash::make('password')
            ]);

        });

        tenancy()->initialize($this->tenant);
    }
}
