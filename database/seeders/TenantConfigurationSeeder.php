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
            'topic'         => ConfigurationTopics::EcommerceData
        ]);

        Configuration::create([
            'key'           => 'ecommerce_youtube',
            'display_name'  => 'Canal de youtube',
            'description'   => 'Link al canal de youtube del comercio',
            'input_type'    => 'url',
            'topic'         => ConfigurationTopics::EcommerceData
        ]);

        Configuration::create([
            'key'           => 'mod_product_reviews',
            'display_name'  => 'Módulo de reseñas',
            'topic'         => ConfigurationTopics::Modules,
            'input_type'    => 'boolean',
            'value'         => true,
            'description'   => 'Tus productos podrán ser puntuados y reseñados por compradores',
        ]);

        Configuration::create([
            'key'           => 'mod_newsletter',
            'display_name'  => 'Módulo de newsletter',
            'topic'         => ConfigurationTopics::Modules,
            'input_type'    => 'boolean',
            'value'         => false,
            'description'   => 'Envía novedades y nuevos lanzamientos a tus clientes suscritos'
        ]);

        // Bank transfer configs
        Configuration::create([
            'key'           => 'transfer_bank',
            'display_name'  => 'Nombre del banco',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'El banco donde pertenece tu cuenta',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'transfer_account_owner',
            'display_name'  => 'Nombre del titular',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Titular de la cuenta (como figura en el online banking)',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'transfer_cbu',
            'display_name'  => 'CBU',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'CBU de tu cuenta bancaria',
            'helper'        => 'Podes consultarlo en el online banking',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'transfer_alias',
            'display_name'  => 'Alias',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => '(Opcional) podes añadirlo a modo de facilidad para el comprador',
            'helper'        => 'Podes consultarlo en el online banking'
        ]);

        // MercadoPago Configs
        Configuration::create([
            'key'           => 'mp_access_token',
            'display_name'  => 'Access Token',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Token de acceso para el Checkout Pro',
            'helper'        => 'Lo encontraras en la sección "credenciales de producción"',
            'required'      => true
        ]);

        // MODO Configs
        Configuration::create([
            'key'           => 'modo_username',
            'display_name'  => 'Username',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Usuario proveido por comercial de MODO',
            'helper'        => 'Lo encontraras junto a las credenciales que te envió el personal de MODO por email',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'modo_password',
            'display_name'  => 'Password',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Contraseña proveida por comercial de MODO',
            'helper'        => 'Lo encontraras junto a las credenciales que te envió el personal de MODO por email',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'modo_store_id',
            'display_name'  => 'Store ID',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Store ID proveido por comercial de MODO',
            'helper'        => 'Lo encontraras junto a las credenciales que te envió el personal de MODO por email',
            'required'      => true
        ]);

        // Ualabis Configs
        Configuration::create([
            'key'           => 'ualabis_username',
            'display_name'  => 'Username',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Username proveido por ualá',
            'helper'        => 'Lo encontraras junto al mail enviado con el asunto "¡Ya podés integrar la API!"',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'ualabis_client_id',
            'display_name'  => 'Client ID',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Client ID proveido por ualá',
            'helper'        => 'Lo encontraras junto al mail enviado con el asunto "¡Ya podés integrar la API!"',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'ualabis_client_secret_id',
            'display_name'  => 'Client Secret',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Client Secret proveido por ualá',
            'helper'        => 'Lo encontraras junto al mail enviado con el asunto "¡Ya podés integrar la API!"',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'gocuotas_redirect_email',
            'display_name'  => 'Email',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Email - Api Redirect',
            'helper'        => 'Email proveido por gocuotas para el servicio API Redirect',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'gocuotas_redirect_password',
            'display_name'  => 'Contraseña (Api Key)',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Contraseña (Api Key) - API Redirect',
            'helper'        => 'Contraseña (Api Key) proveida por gocuotas para el servicio API Redirect',
            'required'      => true
        ]);
    }
}
