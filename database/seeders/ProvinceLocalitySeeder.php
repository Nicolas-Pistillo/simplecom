<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Services\Georef;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceLocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = Georef::getProvinces();

        foreach($provinces as $province)
        {
            $provinceModel = Province::firstOrCreate(['georef_id' => $province['id']], [
                'name' => $province['nombre']
            ]);

            $localities = Georef::getLocalities($province['id'], 5000);

            $uniqueLocalities = collect($localities)->unique('nombre');
            
            foreach($uniqueLocalities as $locality)
            {
                $provinceModel->localities()->firstOrCreate(['georef_id' => $locality['id']], [
                    'name' => $locality['nombre']
                ]);
            }
        }
    }
}
