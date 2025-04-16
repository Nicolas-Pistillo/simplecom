<?php

namespace App\Jobs;

use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SetupTenantStorage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tenant;

    /**
     * Create a new job instance.
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $tenantName = $this->tenant->name;

        Storage::makeDirectory($tenantName);
        Storage::makeDirectory("$tenantName/products");
        Storage::makeDirectory("$tenantName/collections");
        Storage::makeDirectory("$tenantName/products/variants");
        Storage::makeDirectory("$tenantName/banners");
        Storage::makeDirectory("$tenantName/categories");
        Storage::makeDirectory("$tenantName/brands");
        Storage::makeDirectory("$tenantName/invoices");

        $this->tenant->run(function($tenant) 
        {
            $storagePath = storage_path();
            mkdir("$storagePath/framework/cache", 0777, true);
        });
    }
}
