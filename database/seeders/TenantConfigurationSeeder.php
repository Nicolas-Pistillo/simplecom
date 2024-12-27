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
            'topic'         =>  ConfigurationTopics::EcommerceData,
            'input_type'    => 'email',
            'show_in_setup' => true,
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'contact_whatsapp',
            'display_name'  => 'Número de whatsapp',
            'description'   => 'Whatsapp para consultas directas de clientes',
            'topic'         =>  ConfigurationTopics::EcommerceData,
            'show_in_setup' => true
        ]);

        Configuration::create([
            'key'           => 'ecommerce_instagram',
            'display_name'  => 'Instagram',
            'description'   => 'Link al instagram del comercio',
            'input_type'    => 'url',
            'topic'         =>  ConfigurationTopics::EcommerceData
        ]);

        Configuration::create([
            'key'           =>  'ecommerce_youtube',
            'display_name'  =>  'Canal de youtube',
            'description'   =>  'Link al canal de youtube del comercio',
            'input_type'    =>  'url',
            'topic'         =>  ConfigurationTopics::EcommerceData
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
            'key'           => 'ualabis_client_secret',
            'display_name'  => 'Client Secret',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Client Secret proveido por ualá',
            'helper'        => 'Lo encontraras junto al mail enviado con el asunto "¡Ya podés integrar la API!"',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'gocuotas_redirect_email',
            'display_name'  => 'Email',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Email - Api Redirect',
            'helper'        => 'Email proveido por gocuotas para el servicio API Redirect',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'gocuotas_redirect_password',
            'display_name'  => 'Contraseña (Api Key)',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Contraseña (Api Key) - API Redirect',
            'helper'        => 'Contraseña (Api Key) proveida por gocuotas para el servicio API Redirect',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'mobbex_api_key',
            'display_name'  => 'Api Key',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Api Key generada en portal de desarrolladores',
            'helper'        => 'Podes generar estas claves en tu portal de desarrolladores',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'mobbex_access_token',
            'display_name'  => 'Access Token',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Access token generado en portal de desarrolladores',
            'helper'        => 'Podes generar estas claves en tu portal de desarrolladores',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'getnet_client_id',
            'display_name'  => 'Client ID',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Client ID generado en dashboard',
            'helper'        => 'Podes generar estas claves en la sección Comercios > Credenciales de tu dashboard',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'getnet_client_secret',
            'display_name'  => 'Client Secret',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Client secret generado en dashboard',
            'helper'        => 'Podes generar estas claves en la sección Comercios > Credenciales de tu dashboard',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'stripe_key',
            'display_name'  => 'Clave pública',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave pública para acceder a los servicios de stripe',
            'helper'        => 'Encontrarás estas claves en tu dashboard de Stripe',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'stripe_secret',
            'display_name'  => 'Clave secreta',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave secreta para acceder a los servicios de stripe',
            'helper'        => 'Encontrarás estas claves en tu dashboard de Stripe',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'sipago_client_id',
            'display_name'  => 'Client ID',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave pública para acceder a los servicios de sipago',
            'helper'        => 'Solicitá estas claves a tu asesor comercial',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'sipago_client_secret',
            'display_name'  => 'Client Secret',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave secreta para acceder a los servicios de sipago',
            'helper'        => 'Solicitá estas claves a tu asesor comercial',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'nave_client_id',
            'display_name'  => 'Client ID',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave pública para acceder a los servicios de nave',
            'helper'        => 'Recibiras estas claves de parte del equipo de navenegocios',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'nave_client_secret',
            'display_name'  => 'Client Secret',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave secreta para acceder a los servicios de nave',
            'helper'        => 'Recibiras estas claves de parte del equipo de navenegocios',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'nave_platform',
            'display_name'  => 'Platform',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'código de plataforma',
            'helper'        => 'Código de plataforma para tu integración',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'nave_store_id',
            'display_name'  => 'Store ID',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Código de comercio',
            'helper'        => 'Código de comercio para tu integración',
            'required'      => true
        ]);

        Configuration::create([
            'key'           => 'cajero24_token',
            'display_name'  => 'Clave de acceso',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave de acceso',
            'helper'        => 'La encontrarás en tu panel dentro de la sección integraciones > Punto de cobro > Ver clave de acceso',
            'required'      => true
        ]);

        Configuration::create([
            'key'          => 'envia_token',
            'display_name' => 'Token',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Token de acceso a la API de envía',
            'helper'       => 'Podras verlo o generarlo dentro de tu panel en la sección Desarrolladores > Acceso de API',
            'required'     => true
        ]);

        Configuration::create([
            'key'          => 'zippin_account_id',
            'display_name' => 'ID de tu cuenta',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'ID de tu cuenta de Zippin',
            'helper'       => 'Lo encontraras dentro de tu panel en la sección Configuración > Integraciones > Gestionar Credenciales y Webhooks',
            'required'     => true
        ]);

        Configuration::create([
            'key'          => 'zippin_key',
            'display_name' => 'API KEY',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'API KEY de tu cuenta',
            'helper'       => 'Lo encontraras dentro de tu panel en la sección Configuración > Integraciones > Gestionar Credenciales y Webhooks',
            'required'     => true
        ]);

        Configuration::create([
            'key'          => 'zippin_secret',
            'display_name' => 'API SECRET',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'API SECRET de tu cuenta',
            'helper'       => 'Lo encontraras dentro de tu panel en la sección Configuración > Integraciones > Gestionar Credenciales y Webhooks',
            'required'     => true
        ]);

        Configuration::create([
            'key'          => 'zippin_origin_id',
            'display_name' => 'ID de tu origen',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'ID del origen',
            'helper'       => 'Es el origen que usaras para calcular las tarifas e indicar las recolecciones (si corresponde), copialo desde tu panel en la sección Configuración > Orígenes > ID del origen que quieras usar',
            'required'     => true
        ]);

        Configuration::create([
            'key'          => 'enviopack_api_key',
            'display_name' => 'API KEY',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'API KEY de tu cuenta',
            'helper'       => 'Lo encontraras en tu panel haciendo click en los 3 puntos debajo a la izquierda y luego Configuración > Integraciones > Ver claves',
            'required'     => true
        ]);

        Configuration::create([
            'key'          => 'enviopack_secret_key',
            'display_name' => 'SECRET KEY',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'SECRET KEY de tu cuenta',
            'helper'       => 'Lo encontraras en tu panel haciendo click en los 3 puntos debajo a la izquierda y luego Configuración > Integraciones > Ver claves',
            'required'     => true
        ]);
    }
}
