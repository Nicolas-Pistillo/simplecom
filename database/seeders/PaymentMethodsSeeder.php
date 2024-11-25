<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\Services\BankTransfer;
use App\Services\Getnet;
use App\Services\GOcuotas;
use App\Services\MercadoPago;
use App\Services\Mobbex;
use App\Services\Modo;
use App\Services\Ualabis;
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
            'display_name'  => 'UALA bis',
            'checkout_name' => 'UALA bis - Tarjetas de crédito, débito y prepagas',
            'description'   => 'El checkout de Ualá Bis está optimizado para aumentar la conversión, desalentando el abandono, dando confianza y seguridad al usuario. Apuesta a la mejora constante de la experiencia del usuario, por lo que es posible completar el pago de manera más rápida y con menos esfuerzo.',
            'page_url'      => 'https://www.ualabis.com.ar',
            'support_url'   => 'https://www.ualabis.com.ar/contacto',
            'support_email' => 'hola@ualabis.com.ar'
        ]);

        // GO Cuotas
        PaymentMethod::create([
            'code'          => 'gocuotas',
            'service_class' => GOcuotas::class,
            'display_name'  => 'GO Cuotas - Redirect',
            'checkout_name' => 'GOcuotas - Cuotas con débito',
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
            'page_url'      => 'https://www.getnet.com.ar/',
            'support_url'   => 'https://www.getnet.com.ar/ventas'
        ]);
    }
}
