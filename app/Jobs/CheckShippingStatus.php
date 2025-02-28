<?php

namespace App\Jobs;

use App\Enums\ShippingStatus;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CheckShippingStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach(Tenant::all() as $tenant)
        {
            tenancy()->initialize($tenant);

            $orderShippings = OrderShipping::whereNotIn('status', [
                ShippingStatus::NotCreated,
                ShippingStatus::Cancelled,
                ShippingStatus::Delivered
            ])->get();

            foreach($orderShippings as $orderShipping)
            {
                try 
                {
                    $orderShipping->syncStatus();

                } catch (\Throwable $err) 
                {
                    dd("Excepción generada: " . $err->getMessage());
                }
            }
        }
    }
}
