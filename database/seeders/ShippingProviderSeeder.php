<?php

namespace Database\Seeders;

use App\Enums\ShippingMethodType;
use App\Models\ShippingProvider;
use App\Services\ShippingProviders\Envia;
use App\Services\ShippingProviders\EnvioPack;
use App\Services\ShippingProviders\Epick;
use App\Services\ShippingProviders\Mocis;
use App\Services\ShippingProviders\Rapiboy;
use App\Services\ShippingProviders\Saires;
use App\Services\ShippingProviders\Shipnow;
use App\Services\ShippingProviders\Zippin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Envia.com
        ShippingProvider::create([
            'type'          => ShippingMethodType::MultiCarrier,
            'code'          => 'envia',
            'service_class' => Envia::class,
            'name'          => 'Envia.com',
            'page_url'      => 'https://envia.com',
            'support_url'   => 'https://help.envia.com',
            'description'   => 'Esta solución logística te permite trabajar con múltiples empresas de envíos (incluso con FedEx para realizar envíos internacionales) desde su plataforma y de forma automatizada.',
        ]);

        // Zippin
        ShippingProvider::create([
            'type'          => ShippingMethodType::MultiCarrier,
            'code'          => 'zippin',
            'service_class' => Zippin::class,
            'name'          => 'Zippin',
            'page_url'      => 'https://www.zippin.com.ar',
            'support_url'   => 'https://ayuda.zippin.app',
            'description'   => 'Zippin te permite ofrecer envíos con múltiples operadores logísticos desde una misma plataforma, optimizando la mejor opción para tu cliente.',
        ]);

        // EnvioPack
        ShippingProvider::create([
            'type'          => ShippingMethodType::MultiCarrier,
            'code'          => 'enviopack',
            'service_class' => EnvioPack::class,
            'name'          => 'EnvioPack',
            'page_url'      => 'https://www.enviopack.com.ar',
            'support_url'   => 'https://ayuda.enviopack.com/hc/es-419/sections/30700205086228-Contact-center',
            'description'   => 'Con Envíopack podés usar diferentes empresas de logística, sin tener que integrar cada una por separado y mostrando la opción más conveniente de forma automática.',
        ]);

        // Shipnow
        ShippingProvider::create([
            'type'          => ShippingMethodType::MultiCarrier,
            'code'          => 'shipnow',
            'service_class' => Shipnow::class,
            'name'          => 'Shipnow',
            'page_url'      => 'https://shipnow.com.ar',
            'support_url'   => 'https://shipnow.com.ar/ayuda',
            'description'   => 'Shipnow es un ecosistema de soluciones logísticas que ayuda a impulsar el crecimiento de tu negocio y transofrmar la experiencia de compra de tus clientes con envíos a todo el país con una solución integral de logística y distribución. Ofrece múltiples soluciones según tus necesidades y fulfillment entre otros.'
        ]);

        // Rapiboy
        ShippingProvider::create([
            'type'          => ShippingMethodType::Carrier,
            'code'          => 'rapiboy',
            'service_class' => Rapiboy::class,
            'name'          => 'Rapiboy',
            'page_url'      => 'https://rapiboy.com',
            'support_url'   => 'https://rapiboy.com/Ayuda',
            'description'   => 'Rapiboy ofrece una solución para entregas de última milla con envíos rápidos y logística inversa incorporada para resolver las entregas de tu ecommerce.',
        ]);

        // Epick
        ShippingProvider::create([
            'type'          => ShippingMethodType::Carrier,
            'code'          => 'epick',
            'service_class' => Epick::class,
            'name'          => 'E-pick',
            'page_url'      => 'https://e-pick.com.ar/home',
            'support_url'   => 'https://jade-slice-6d1.notion.site/Preguntas-Frecuentes-E-Pick-12e5c905f0c680efbca8e300590076dd',
            'description'   => 'E-Pick es una plataforma de logística especializada en envíos para e-commerce, ofreciendo un servicio puerta a puerta con seguimiento en tiempo real, colecta sin mínimo de paquetes, y entregas en rangos horarios específicos para optimizar la experiencia del cliente.',
        ]);

        // Mocis
        ShippingProvider::create([
            'type'          => ShippingMethodType::Carrier,
            'code'          => 'mocis',
            'service_class' => Mocis::class,
            'name'          => "Moci's",
            'page_url'      => 'https://mocis.com.ar',
            'description'   => "Moci's es un equipo de emprendedores dedicados a las soluciones logísticas de Ecommerce, usando tecnología y experiencia para maximizar los resultados de tu negocio online a través de envíos rápidos, eficientes y confiables.",
        ]);

        // Saires
        ShippingProvider::create([
            'type'          => ShippingMethodType::Carrier,
            'code'          => 'saires',
            'service_class' => Saires::class,
            'name'          => 'Saires',
            'page_url'      => 'https://www.sairesenvios.com.ar/lastmile',
            'description'   => 'Saires propone ser tu socio logístico ideal para las entregas de tus pedidos, combinando competitividad, eficiencia y tecnología para la efectividad de cada entrega. Sus servicios incluyen modalidades tales como next day, same day, logística inversa y cambios simultáneos entre otros.'
        ]);
    }
}
