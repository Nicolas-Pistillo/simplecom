<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(TenantConfigurationSeeder::class);
        $this->call(TaxConditionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(DefaultAttributesSeeder::class);
        $this->call(PaymentMethodsSeeder::class);
        $this->call(ShippingMethodSeeder::class);
    }
}