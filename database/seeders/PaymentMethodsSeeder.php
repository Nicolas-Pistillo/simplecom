<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\Services\BankTransfer;
use App\Services\PaymentProviders\Getnet;
use App\Services\PaymentProviders\GOcuotas;
use App\Services\PaymentProviders\MercadoPago;
use App\Services\PaymentProviders\Mobbex;
use App\Services\PaymentProviders\Modo;
use App\Services\PaymentProviders\Nave;
use App\Services\PaymentProviders\Sipago;
use App\Services\PaymentProviders\Stripe;
use App\Services\PaymentProviders\Ualabis;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bank Transfer
        PaymentMethod::create([
            'code'          => 'transfer',
            'service_class' => BankTransfer::class,
            'display_name'  => 'Transferencia',
            'checkout_name' => 'Transferencia',
            'description'   => 'Vinculá los datos de tu cuenta bancaria para recibir transferencias de tus compradores, se les pedirá enviar el comprobante de transferencia para validar el pago luego de una compra.'
        ]);

        // Mercado Pago
        PaymentMethod::create([
            'code'          => 'mercadopago',
            'service_class' => MercadoPago::class,
            'display_name'  => 'Mercado Pago',
            'checkout_name' => 'Mercado Pago',
            'page_url'      => 'https://www.mercadopago.com.ar/developers/es',
            'description'   => 'El Checkout Pro de Mercado Pago es una solución que permite a tus clientes realizar compras a través de las páginas de pago de Mercado Pago de forma segura, rápida y con la posibilidad de pagar con los principales medios de pago disponibles actualmente.',
            'support_url'   => 'https://www.mercadopago.com.ar/developers/es/support/center'
        ]);

        // MODO
        PaymentMethod::create([
            'code'          => 'modo',
            'service_class' => Modo::class,
            'display_name'  => 'MODO',
            'checkout_name' => 'MODO - Pagar con QR',
            'description'   => 'MODO es una plataforma de pagos que integra más de 35 bancos, ofreciendo una experiencia de pago ágil para el usuario final. Con MODO, tus clientes pueden pagar sus compras en línea de manera rápida y segura, utilizando las tarjetas asociadas a su billetera digital.',
            'page_url'      => 'https://www.modo.com.ar',
            'support_url'   => 'https://merchants.modo.com.ar/docs/soporte',
            'support_email' => 'comercios@modo.com.ar'
        ]);

        // Ualabis
        PaymentMethod::create([
            'code'          => 'ualabis',
            'service_class' => Ualabis::class,
            'display_name'  => 'Uala bis',
            'checkout_name' => 'Uala bis - Tarjetas de crédito, débito y prepagas',
            'description'   => 'El checkout de Ualá Bis está optimizado para aumentar la conversión, desalentando el abandono, dando confianza y seguridad al usuario. Apuesta a la mejora constante de la experiencia del usuario, por lo que es posible completar el pago de manera más rápida y con menos esfuerzo.',
            'page_url'      => 'https://www.ualabis.com.ar',
            'support_url'   => 'https://www.ualabis.com.ar/contacto',
            'support_email' => 'hola@ualabis.com.ar'
        ]);

        // GO Cuotas
        PaymentMethod::create([
            'code'          => 'gocuotas',
            'service_class' => GOcuotas::class,
            'display_name'  => 'GO Cuotas',
            'checkout_name' => 'GO Cuotas - Cuotas con débito',
            'description'   => 'Con GOcuotas, abrís las puertas a clientes que no tienen tarjeta de crédito, dando la opción de pagar en cuotas con tarjeta de débito, sin complicaciones, rápido y fácil. Tu cliente hace la compra y paga la primera cuota en el momento. Las siguientes cuotas las paga en los meses siguientes, de acuerdo a la cantidad de cuotas que haya elegido',
            'page_url'      => 'https://www.gocuotas.com',
            'support_url'   => 'https://www.gocuotas.com/consultas'
        ]);

        // Mobbex
        PaymentMethod::create([
            'code'          => 'mobbex',
            'service_class' => Mobbex::class,
            'display_name'  => 'Mobbex',
            'checkout_name' => 'Mobbex - Tarjetas de crédito, débito y prepagas',
            'description'   => 'Mobbex es un gateway de pagos que te ofrece autonomía y flexibilidad para configurar tus propias condiciones de pago. Podrás monitorear todas tus ventas en tiempo real ademas de ofrecerte la posibildiad de generar ordenes de pagos y links de venta para vender por redes sociales, whatsapp y e-mail',
            'page_url'      => 'https://www.mobbex.com',
            'support_url'   => 'https://www.mobbex.com/contacto'
        ]);

        // Getnet
        PaymentMethod::create([
            'code'          => 'getnet',
            'service_class' => Getnet::class,
            'display_name'  => 'Getnet',
            'checkout_name' => 'Getnet - Tarjetas de crédito, débito y prepagas',
            'description'   => 'Getnet es una solución de cobros y servicios que brinda a comerciantes, emprendedores y profesionales una alternativa más fácil, rápida y segura de cobrar. Con Getnet podés realizar el cobro de tus ventas de forma presencial y a distancia, a través de diferentes medios de pago como tarjetas de crédito, tarjetas de débito, tarjetas prepagas y links de pago, en un solo pago o en cuotas.',
            'page_url'      => 'https://www.getnet.com.ar/cobra-online/get-checkout',
            'support_url'   => 'https://www.getnet.com.ar/ventas'
        ]);

        // Stripe
        PaymentMethod::create([
            'code'          => 'stripe',
            'service_class' => Stripe::class,
            'display_name'  => 'Stripe',
            'checkout_name' => 'Stripe - Tarjetas de crédito y débito',
            'description'   => 'El formulario de pago prediseñado de Stripe ofrece una experiencia de proceso de compra optimizado para tus clientes. Reduce la fricción, admite decenas de métodos de pago internacionales y se adapta al idioma y dispositivo de tus clientes.',
            'page_url'      => 'https://stripe.com/es-us/use-cases/ecommerce',
            'support_url'   => 'https://support.stripe.com'
        ]);

        // Sipago
        PaymentMethod::create([
            'code'          => 'sipago',
            'service_class' => Sipago::class,
            'display_name'  => 'Sipago',
            'checkout_name' => 'Sipago - Tarjetas de crédito y débito',
            'description'   => 'Sipago es la plataforma que facilita las ventas de tu comercio. Te permite cobrar con las principales tarjetas de crédito y débito del mercado, y administrar todas tus liquidaciones de ventas en un mismo lugar.',
            'page_url'      => 'https://www.sipago.coop/tiendas',
            'support_url'   => 'https://www.sipago.coop/contact'
        ]);

        // Nave
        PaymentMethod::create([
            'code'          => 'nave',
            'service_class' => Nave::class,
            'display_name'  => 'Nave',
            'checkout_name' => 'Nave - Tarjetas de crédito, débito o QR',
            'description'   => 'Nave simplifica tu día a día para que cobres con seguridad. Tendrás confirmación de los cobros en tiempo real, detalles de todas las ventas y resúmenes personalizados. Vendés más con promociones exclusivas, cuotas sin tarjeta y cuotas fijas.',
            'page_url'      => 'https://navenegocios.ar/home/cobrar-con-tienda-online',
            'support_url'   => 'https://www.galicia.ar/personas/contactanos'
        ]);
    }
}
