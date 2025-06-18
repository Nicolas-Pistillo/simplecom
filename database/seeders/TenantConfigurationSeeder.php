<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Seeder;
use App\Enums\ConfigurationTopics;
use App\Enums\InputType;

class TenantConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuration::firstOrCreate([
            'key'           => 'contact_email',
            'display_name'  => 'Email de contacto',
            'description'   => 'Correo de consultas para clientes',
            'topic'         => ConfigurationTopics::EcommerceData,
            'input_type'    => InputType::Email,
            'show_in_setup' => true,
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'ecommerce_eslogan',
            'display_name'  => 'Eslogan del comercio',
            'description'   => 'Tu eslogan o frase que te identifica',
            'topic'         => ConfigurationTopics::EcommerceData,
            'input_type'    => InputType::Text,
            'show_in_setup' => false,
            'required'      => false
        ]);

        Configuration::firstOrCreate([
            'key'           => 'contact_whatsapp',
            'display_name'  => 'Número de whatsapp',
            'description'   => 'Whatsapp para consultas directas de clientes',
            'topic'         => ConfigurationTopics::EcommerceData,
            'show_in_setup' => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'ecommerce_instagram',
            'display_name'  => 'Instagram',
            'description'   => 'Link al instagram del comercio',
            'input_type'    => InputType::Url,
            'topic'         => ConfigurationTopics::EcommerceData
        ]);

        Configuration::firstOrCreate([
            'key'           => 'ecommerce_facebook',
            'display_name'  => 'Facebook',
            'description'   => 'Link al facebook del comercio',
            'input_type'    => InputType::Url,
            'topic'         => ConfigurationTopics::EcommerceData
        ]);

        Configuration::firstOrCreate([
            'key'           => 'ecommerce_tiktok',
            'display_name'  => 'TikTok',
            'description'   => 'Link al tiktok del comercio',
            'input_type'    => InputType::Url,
            'topic'         => ConfigurationTopics::EcommerceData
        ]);

        Configuration::firstOrCreate([
            'key'           => 'ecommerce_youtube',
            'display_name'  => 'Canal de youtube',
            'description'   => 'Link al canal de youtube del comercio',
            'input_type'    => InputType::Url,
            'topic'         => ConfigurationTopics::EcommerceData
        ]);

        Configuration::firstOrCreate([
            'key'          => 'promotional_message',
            'display_name' => 'Mensaje promocional',
            'topic'        => ConfigurationTopics::EcommerceData,
            'description'  => 'Un texto llamativo que aparecerá en el inicio de tu ecommerce para atraer la atención de tus clientes',
            'helper'       => 'Por ejemplo: 20% de descuento abonando con transferencia',
            'required'     => false
        ]);

        Configuration::firstOrCreate([
            'key'           => 'whatsapp_button',
            'display_name'  => 'Botón de whatsapp',
            'description'   => 'Activar botón de whatsapp en el ecommerce',
            'input_type'    => InputType::Boolean,
            'topic'         => ConfigurationTopics::EcommerceData
        ]);

        Configuration::firstOrCreate([
            'key'           => 'contact_phone',
            'display_name'  => 'Telefono fijo',
            'description'   => 'Telefono de contacto',
            'input_type'    => InputType::Number,
            'topic'         => ConfigurationTopics::EcommerceData
        ]);

        Configuration::firstOrCreate([
            'key'           => 'mod_product_reviews',
            'display_name'  => 'Módulo de reseñas',
            'topic'         => ConfigurationTopics::Modules,
            'input_type'    => InputType::Boolean,
            'value'         => true,
            'description'   => 'Tus productos podrán ser puntuados y reseñados por compradores',
        ]);

        Configuration::firstOrCreate([
            'key'           => 'mod_newsletter',
            'display_name'  => 'Módulo de newsletter',
            'topic'         => ConfigurationTopics::Modules,
            'input_type'    => InputType::Boolean,
            'value'         => false,
            'description'   => 'Envía novedades y nuevos lanzamientos a tus clientes suscritos'
        ]);

        // Bank transfer configs
        Configuration::firstOrCreate([
            'key'           => 'transfer_bank',
            'display_name'  => 'Nombre del banco',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'El banco donde pertenece tu cuenta',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'transfer_account_owner',
            'display_name'  => 'Nombre del titular',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Titular de la cuenta (como figura en el online banking)',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'transfer_cbu',
            'display_name'  => 'CBU',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'CBU de tu cuenta bancaria',
            'helper'        => 'Podes consultarlo en el online banking',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'transfer_alias',
            'display_name'  => 'Alias',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => '(Opcional) podes añadirlo a modo de facilidad para el comprador',
            'helper'        => 'Podes consultarlo en el online banking'
        ]);

        // MercadoPago Configs
        Configuration::firstOrCreate([
            'key'           => 'mp_access_token',
            'display_name'  => 'Access Token',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Token de acceso para el Checkout Pro',
            'helper'        => 'Lo encontraras en la sección "credenciales de producción"',
            'required'      => true
        ]);

        // MODO Configs
        Configuration::firstOrCreate([
            'key'           => 'modo_username',
            'display_name'  => 'Username',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Usuario proveido por comercial de MODO',
            'helper'        => 'Lo encontraras junto a las credenciales que te envió el personal de MODO por email',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'modo_password',
            'display_name'  => 'Password',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Contraseña proveida por comercial de MODO',
            'helper'        => 'Lo encontraras junto a las credenciales que te envió el personal de MODO por email',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'modo_store_id',
            'display_name'  => 'Store ID',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Store ID proveido por comercial de MODO',
            'helper'        => 'Lo encontraras junto a las credenciales que te envió el personal de MODO por email',
            'required'      => true
        ]);

        // Ualabis Configs
        Configuration::firstOrCreate([
            'key'           => 'ualabis_username',
            'display_name'  => 'Username',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Username proveido por ualá',
            'helper'        => 'Lo encontraras junto al mail enviado con el asunto "¡Ya podés integrar la API!"',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'ualabis_client_id',
            'display_name'  => 'Client ID',
            'topic'         => ConfigurationTopics::PaymentMethods,
            'description'   => 'Client ID proveido por ualá',
            'helper'        => 'Lo encontraras junto al mail enviado con el asunto "¡Ya podés integrar la API!"',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'ualabis_client_secret',
            'display_name'  => 'Client Secret',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Client Secret proveido por ualá',
            'helper'        => 'Lo encontraras junto al mail enviado con el asunto "¡Ya podés integrar la API!"',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'gocuotas_redirect_email',
            'display_name'  => 'Email',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Email - Api Redirect',
            'helper'        => 'Email proveido por gocuotas para el servicio API Redirect',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'gocuotas_redirect_password',
            'display_name'  => 'Contraseña (Api Key)',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Contraseña (Api Key) - API Redirect',
            'helper'        => 'Contraseña (Api Key) proveida por gocuotas para el servicio API Redirect',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'mobbex_api_key',
            'display_name'  => 'Api Key',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Api Key generada en portal de desarrolladores',
            'helper'        => 'Podes generar estas claves en tu portal de desarrolladores',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'mobbex_access_token',
            'display_name'  => 'Access Token',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Access token generado en portal de desarrolladores',
            'helper'        => 'Podes generar estas claves en tu portal de desarrolladores',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'getnet_client_id',
            'display_name'  => 'Client ID',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Client ID generado en dashboard',
            'helper'        => 'Podes generar estas claves en la sección Comercios > Credenciales de tu dashboard',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'getnet_client_secret',
            'display_name'  => 'Client Secret',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Client secret generado en dashboard',
            'helper'        => 'Podes generar estas claves en la sección Comercios > Credenciales de tu dashboard',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'stripe_key',
            'display_name'  => 'Clave pública',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave pública para acceder a los servicios de stripe',
            'helper'        => 'Encontrarás estas claves en tu dashboard de Stripe',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'stripe_secret',
            'display_name'  => 'Clave secreta',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave secreta para acceder a los servicios de stripe',
            'helper'        => 'Encontrarás estas claves en tu dashboard de Stripe',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'sipago_client_id',
            'display_name'  => 'Client ID',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave pública para acceder a los servicios de sipago',
            'helper'        => 'Solicitá estas claves a tu asesor comercial',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'sipago_client_secret',
            'display_name'  => 'Client Secret',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave secreta para acceder a los servicios de sipago',
            'helper'        => 'Solicitá estas claves a tu asesor comercial',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'nave_client_id',
            'display_name'  => 'Client ID',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave pública para acceder a los servicios de nave',
            'helper'        => 'Recibiras estas claves de parte del equipo de navenegocios',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'nave_client_secret',
            'display_name'  => 'Client Secret',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave secreta para acceder a los servicios de nave',
            'helper'        => 'Recibiras estas claves de parte del equipo de navenegocios',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'nave_platform',
            'display_name'  => 'Platform',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'código de plataforma',
            'helper'        => 'Código de plataforma para tu integración',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'nave_store_id',
            'display_name'  => 'Store ID',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Código de comercio',
            'helper'        => 'Código de comercio para tu integración',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'cajero24_token',
            'display_name'  => 'Clave de acceso',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Clave de acceso',
            'helper'        => 'La encontrarás en tu panel dentro de la sección Integraciones > Punto de cobro > Ver clave de acceso',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'openpay_client_id',
            'display_name'  => 'Client ID',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Client ID generado en dashboard',
            'helper'        => 'Podes generar estas claves en la sección Comercios > Credenciales de tu dashboard',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'openpay_client_secret',
            'display_name'  => 'Client Secret',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Client secret generado en dashboard',
            'helper'        => 'Podes generar estas claves en la sección Comercios > Credenciales de tu dashboard',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'viumi_client_id',
            'display_name'  => 'Client ID',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Client ID generado por viüMi',
            'helper'        => 'Debes solicitar estas claves a viüMi para activar el botón de pago web',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'viumi_client_secret',
            'display_name'  => 'Client Secret',
            'topic'         =>  ConfigurationTopics::PaymentMethods,
            'description'   => 'Client Secret generado por viüMi',
            'helper'        => 'Debes solicitar estas claves a viüMi para activar el botón de pago web',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'envia_token',
            'display_name' => 'Token',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Tu token de acceso a la API de envía',
            'helper'       => 'Podras verlo o generarlo dentro de tu panel en la sección Desarrolladores > Acceso de API',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'zippin_account_id',
            'display_name' => 'ID de cuenta',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'ID de tu cuenta de Zippin',
            'helper'       => 'Lo encontraras dentro de tu panel en la sección Configuración > Integraciones > Gestionar Credenciales y Webhooks',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'zippin_key',
            'display_name' => 'Api Key',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Api Key de tu cuenta',
            'helper'       => 'Lo encontraras dentro de tu panel en la sección Configuración > Integraciones > Gestionar Credenciales y Webhooks',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'zippin_secret',
            'display_name' => 'Api Secret',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Api Secret de tu cuenta',
            'helper'       => 'Lo encontraras dentro de tu panel en la sección Configuración > Integraciones > Gestionar Credenciales y Webhooks',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'zippin_origin_id',
            'display_name' => 'ID de origen',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'ID de tu dirección de origen',
            'helper'       => 'Es la dirección de origen que usaras para calcular las tarifas e indicar al servicio de correo dónde pasara a recolectar los paquetes que envíes, copialo desde tu panel en la sección Configuración > Orígenes > ID',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'enviopack_api_key',
            'display_name' => 'Api Key',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Api Key de tu cuenta',
            'helper'       => 'Lo encontraras en tu panel haciendo click en los 3 puntos debajo a la izquierda y luego Configuración > Integraciones > Ver claves',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'enviopack_secret_key',
            'display_name' => 'Secret Key',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Secret Key de tu cuenta',
            'helper'       => 'Lo encontraras en tu panel haciendo click en los 3 puntos debajo a la izquierda y luego Configuración > Integraciones > Ver claves',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'           => 'shipnow_api_token',
            'display_name'  => 'Api Token',
            'topic'         => ConfigurationTopics::DeliveryMethods,
            'description'   => 'Api Token para utilizar la API de shipnow',
            'helper'        => 'Deberas solicitar este token por email a developer@shipnow.com.ar indicando que deseas integrar shipnow a tu tienda online via API',
            'required'      => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'rapiboy_api_token',
            'display_name' => 'Api Token',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Api Token asociado a tu cuenta',
            'helper'       => 'Lo encontraras en la sección "Mi Perfil" en tu panel de rapiboy',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'epick_phone',
            'display_name' => 'Celular',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Celular que usas para iniciar sesión en E-pick',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'epick_password',
            'display_name' => 'Contraseña',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Tu contraseña de E-pick',
            'input_type'   => InputType::Password,
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'mocis_api_client',
            'display_name' => 'API Client',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Api Client de tu cuenta',
            'helper'       => "Lo encontraras en la sección 'Integraciones' en tu panel de moci's",
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'mocis_api_secret',
            'display_name' => 'API Secret',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Api Secret de tu cuenta',
            'helper'       => "Lo encontraras en la sección 'Integraciones' en tu panel de moci's",
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'saires_client_id',
            'display_name' => 'ID de cliente',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'ID de cliente asociado a cuenta',
            'helper'       => 'Debes solicitar este dato por correo a saires indicando el email con el que te hayas registrado en su plataforma',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'saires_email',
            'display_name' => 'Email',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Email de tu cuenta',
            'helper'       => 'Email que usas para iniciar sesión en la plataforma de saires',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'enviamelo_token',
            'display_name' => 'Token',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Tu token de acceso a la API de Envíamelo',
            'helper'       => 'Podras encontrarlo o generarlo en tu panel de enviamelo yendo a tu perfil y luego en la solapa API',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'andreani_user',
            'display_name' => 'Usuario API',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Tu usuario para acceder a la API de Andreani',
            'helper'       => 'Recibiras estas credenciales por parte de tu ejecutivo comercial',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'andreani_password',
            'display_name' => 'Contraseña API',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Tu contraseña para acceder a la API de Andreani',
            'helper'       => 'Recibiras estas credenciales por parte de tu ejecutivo comercial',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'andreani_nro_cliente',
            'display_name' => 'Número de Cliente',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Tu número de cliente en Andreani',
            'helper'       => 'Recibiras estas credenciales por parte de tu ejecutivo comercial',
            'required'     => true
        ]);

        Configuration::firstOrCreate([
            'key'          => 'andreani_contrato_domicilio',
            'display_name' => 'Nro Contrato a Domicilio',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Número de contrato para entregas a domicilio',
            'helper'       => 'Completá el número de contrato para esta modalidad sólo si corresponde según lo pactado con tu ejecutivo comercial',
            'required'     => false
        ]);

        Configuration::firstOrCreate([
            'key'          => 'andreani_contrato_sucursal',
            'display_name' => 'Nro Contrato a Sucursal',
            'topic'        => ConfigurationTopics::DeliveryMethods,
            'description'  => 'Número de contrato para entregas a sucursal',
            'helper'       => 'Completá el número de contrato para esta modalidad sólo si corresponde según lo pactado con tu ejecutivo comercial',
            'required'     => false
        ]);
    }
}
