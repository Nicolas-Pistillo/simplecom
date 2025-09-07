<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Superadmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Superadmin::firstOrCreate(['email' => 'pistillonicolas@gmail.com'],
        [
            'name' => 'Nicolas Pistillo',
            'email' => 'pistillonicolas@gmail.com',
            'password' => Hash::make('simplecom')
        ]);

        $this->call(SectorSeeder::class);
    }
}
