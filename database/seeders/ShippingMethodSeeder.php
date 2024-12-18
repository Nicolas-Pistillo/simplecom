<?php

namespace Database\Seeders;

use App\Enums\ShippingMethodType;
use App\Models\ShippingMethod;
use App\Services\ShippingProviders\Envia;
use App\Services\ShippingProviders\EnvioPack;
use App\Services\ShippingProviders\Zippin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Envia.com
        ShippingMethod::create([
            'type'          => ShippingMethodType::MultiCarrier,
            'code'          => 'envia',
            'service_class' => Envia::class,
            'name'          => 'Envia.com',
            'page_url'      => 'https://envia.com',
            'support_url'   => 'https://help.envia.com',
            'description'   => 'Esta solución logística te permite trabajar con múltiples empresas de envíos (incluso con FedEx para realizar envíos internacionales) desde su plataforma y de forma automatizada.',
        ]);

        // Zippin
        ShippingMethod::create([
            'type'          => ShippingMethodType::MultiCarrier,
            'code'          => 'zippin',
            'service_class' => Zippin::class,
            'name'          => 'Zippin',
            'page_url'      => 'https://www.zippin.com.ar',
            'support_url'   => 'https://ayuda.zippin.app',
            'description'   => 'Zippin te permite ofrecer envíos con múltiples operadores logísticos desde una misma plataforma, optimizando la mejor opción para tu cliente.',
        ]);

        // EnvioPack
        ShippingMethod::create([
            'type'          => ShippingMethodType::MultiCarrier,
            'code'          => 'enviopack',
            'service_class' => EnvioPack::class,
            'name'          => 'EnvioPack',
            'page_url'      => 'https://www.enviopack.com.ar',
            'support_url'   => 'https://ayuda.enviopack.com/hc/es-419/sections/30700205086228-Contact-center',
            'description'   => 'Con Envíopack podés usar diferentes empresas de logística, sin tener que integrar cada una por separado y mostrando la opción más conveniente de forma automática.',
        ]);
    }
}
