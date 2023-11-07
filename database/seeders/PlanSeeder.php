<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::updateOrCreate([
            'name' => 'Free',
            'price' => 0
        ]);

        Plan::updateOrCreate([
            'name' => 'Basic',
            'price' => 15000
        ]);

        Plan::updateOrCreate([
            'name' => 'Premium',
            'price' => 36000,
            'offer_price' => 27500
        ]);
    }
}
