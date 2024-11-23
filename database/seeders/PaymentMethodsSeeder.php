<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'display_name'  => 'Transferencia',
            'checkout_name' => 'Transferencia',
            'description'   => 'Vinculá los datos de tu cuenta bancaria para recibir transferencias de tus compradores, se les pedirá enviar el comprobante de transferencia para validar el pago luego de una compra.'
        ]);

        // Mercado Pago
        PaymentMethod::create([
            'code'          => 'mercadopago',
            'display_name'  => 'Mercado Pago',
            'checkout_name' => 'Mercado Pago',
            'description'   => 'El Checkout Pro de Mercado Pago es una solución que permite a tus clientes realizar compras a través de las páginas de pago de Mercado Pago de forma segura, rápida y con la posibilidad de pagar con los principales medios de pago disponibles actualmente.',
            'support_url'   => 'https://www.mercadopago.com.ar/developers/es/support/center'
        ]);

        // MODO
        PaymentMethod::create([
            'code'          => 'modo',
            'display_name'  => 'MODO',
            'checkout_name' => 'MODO - Pagar con QR',
            'description'   => 'MODO es una plataforma de pagos que integra más de 35 bancos, ofreciendo una experiencia de pago ágil para el usuario final. Con MODO, tus clientes pueden pagar sus compras en línea de manera rápida y segura, utilizando las tarjetas asociadas a su billetera digital.',
            'support_url'   => 'https://merchants.modo.com.ar/docs/soporte',
            'support_email' => 'comercios@modo.com.ar'
        ]);

        // Ualabis
        PaymentMethod::create([
            'code'          => 'uala_bis',
            'display_name'  => 'UALA bis',
            'checkout_name' => 'UALA - Pagar con tarjeta de crédito o débito',
            'description'   => 'El checkout de Ualá Bis está optimizado para aumentar la conversión, desalentando el abandono, dando confianza y seguridad al usuario. Apuesta a la mejora constante de la experiencia del usuario, por lo que es posible completar el pago de manera más rápida y con menos esfuerzo.',
            'support_url'   => 'https://www.ualabis.com.ar/contacto',
            'support_email' => 'hola@ualabis.com.ar'
        ]);
    }
}
