<?php

namespace Database\Seeders;

use App\Models\TaxCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaxCondition::create(['name' => 'Consumidor final']);
        TaxCondition::create(['name' => 'Responsable inscripto']);
        TaxCondition::create(['name' => 'Monotributista']);
        TaxCondition::create(['name' => 'Autónomo']);
        TaxCondition::create(['name' => 'Exento']);
    }
}
