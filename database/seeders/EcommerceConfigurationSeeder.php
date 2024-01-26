<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EcommerceConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuration::updateOrCreate([
            'key' => 'fisical_address',
            'display_name' => 'Dirección del local/comercio',
            'description'   => 'Ubicación fisica del comercio'
        ]);

        Configuration::updateOrCreate([
            'key' => 'attention_schedule',
            'display_name' => 'Horarios de atención',
            'description'   => 'Tus horarios de atención al cliente'
        ]);

        Configuration::updateOrCreate([
            'key' => 'fisical_address',
            'display_name' => 'Dirección del local/comercio',
            'description'   => 'Ubicación fisica del comercio'
        ]);

        Configuration::updateOrCreate([
            'key' => 'contact_email',
            'display_name' => 'Email de contacto',
            'description'   => 'Correo de consultas para clientes'
        ]);

        Configuration::updateOrCreate([
            'key' => 'contact_whatsapp',
            'display_name' => 'Número de whatsapp',
            'description'   => 'Número para consultas directas de clientes'
        ]);

        Configuration::updateOrCreate([
            'key' => 'ecommerce_instagram',
            'display_name' => 'Instagram',
            'description'   => 'Link al instagram del comercio'
        ]);

        Configuration::updateOrCreate([
            'key' => 'ecommerce_youtube',
            'display_name' => 'Canal de youtube',
            'description'   => 'Link al canal de youtube del comercio'
        ]);
    }
}
