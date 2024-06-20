<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Seeder;
use App\Enums\ConfigurationTopics;

class TenantConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuration::create([
            'key'           => 'fisical_address',
            'display_name'  => 'Dirección del local/comercio',
            'description'   => 'Ubicación fisica del comercio',
            'topic'         => ConfigurationTopics::EcommerceData,
            'show_in_setup' => true
        ]);

        Configuration::create([
            'key'           => 'attention_schedule',
            'display_name'  => 'Horarios de atención',
            'description'   => 'Ejemplo: Lunes a viernes de 09:00 a 18:00',
            'topic'         => ConfigurationTopics::EcommerceData,
            'show_in_setup' => true
        ]);

        Configuration::create([
            'key'           => 'contact_email',
            'display_name'  => 'Email de contacto',
            'description'   => 'Correo de consultas para clientes',
            'topic'         => ConfigurationTopics::EcommerceData,
            'input_type'    => 'email',
            'show_in_setup' => true,
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'contact_whatsapp',
            'display_name'  => 'Número de whatsapp',
            'description'   => 'Whatsapp para consultas directas de clientes',
            'topic'         => ConfigurationTopics::EcommerceData,
            'show_in_setup' => true
        ]);

        Configuration::create([
            'key'           => 'ecommerce_instagram',
            'display_name'  => 'Instagram',
            'description'   => 'Link al instagram del comercio',
            'input_type'    => 'url',
            'topic'         => ConfigurationTopics::EcommerceData,
            'show_in_setup' => true
        ]);

        Configuration::create([
            'key'           => 'ecommerce_youtube',
            'display_name'  => 'Canal de youtube',
            'description'   => 'Link al canal de youtube del comercio',
            'input_type'    => 'url',
            'topic'         => ConfigurationTopics::EcommerceData,
            'show_in_setup' => true
        ]);

        Configuration::create([
            'key'           => 'mod_product_reviews',
            'display_name'  => 'Módulo de reseñas',
            'topic'         => ConfigurationTopics::Modules,
            'input_type'    => 'boolean',
            'description'   => 'Tus productos podrán ser puntuados y reseñados por compradores',
        ]);

        Configuration::create([
            'key'           => 'mod_newsletter',
            'display_name'  => 'Módulo de newsletter',
            'topic'         => ConfigurationTopics::Modules,
            'input_type'    => 'boolean',
            'description'   => 'Envía novedades y nuevos lanzamientos a tus clientes suscritos'
        ]);
    }
}
