<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;

class DefaultAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Attributes
        $size      = Attribute::create(['name' => 'Talle']);
        $footwear  = Attribute::create(['name' => 'Calzado']);
        $colors    = Attribute::create(['name' => 'Color']);
        $material  = Attribute::create(['name' => 'Material']);

        // Attach values to attributes
        $size->values()->createMany([
            [
                'name' => 'XS'
            ],
            [
                'name' => 'S'
            ],
            [
                'name' => 'M'
            ],
            [
                'name' => 'L'
            ],
            [
                'name' => 'XL'
            ],
            [
                'name' => 'XXL'
            ],
            [
                'name' => 'XXXL'
            ],
            [
                'name' => '30'
            ],
            [
                'name' => '32'
            ],
            [
                'name' => '34'
            ],
            [
                'name' => '36'
            ],
            [
                'name' => '38'
            ],
            [
                'name' => '40'
            ]
        ]);

        $footwear->values()->createMany([
            [
                'name' => '33'
            ],
            [
                'name' => '34'
            ],
            [
                'name' => '35'
            ],
            [
                'name' => '36'
            ],
            [
                'name' => '37'
            ],
            [
                'name' => '38'
            ],
            [
                'name' => '39'
            ],
            [
                'name' => '40'
            ],
            [
                'name' => '41'
            ],
            [
                'name' => '42'
            ],
            [
                'name' => '43'
            ],
            [
                'name' => '44'
            ],
            [
                'name' => '45'
            ],
        ]);

        $colors->values()->createMany([
            [
                'name' => 'Negro',
                'meta' => ['hexa_value' => '#000000']
            ],
            [
                'name' => 'Gris',
                'meta' => ['hexa_value' => '#8f8f8f']
            ],
            [
                'name' => 'Blanco',
                'meta' => ['hexa_value' => '#ffffff']
            ],
            [
                'name' => 'Rojo',
                'meta' => ['hexa_value' => '#ff0000']
            ],
            [
                'name' => 'Azul',
                'meta' => ['hexa_value' => '#0011ff']
            ],
            [
                'name' => 'Celeste',
                'meta' => ['hexa_value' => '#00b3ff']
            ],
            [
                'name' => 'Verde',
                'meta' => ['hexa_value' => '#0be023']
            ],
            [
                'name' => 'Amarillo',
                'meta' => ['hexa_value' => '#ffea00']
            ],
            [
                'name' => 'Violeta',
                'meta' => ['hexa_value' => '#9900ff']
            ],
            [
                'name' => 'Rosa',
                'meta' => ['hexa_value' => '#ff00ea']
            ],
            [
                'name' => 'Naranja',
                'meta' => ['hexa_value' => '#ff8800']
            ],
            [
                'name' => 'Marrón',
                'meta' => ['hexa_value' => '#be6013']
            ]
        ]);

        $material->values()->createMany([
            [
                'name' => 'Madera'
            ],
            [
                'name' => 'Plástico'
            ],
            [
                'name' => 'Acero quirúrgico'
            ],
            [
                'name' => 'Bronce'
            ],
            [
                'name' => 'Plata'
            ],
            [
                'name' => 'Oro'
            ],
            [
                'name' => 'Porcelana'
            ],
            [
                'name' => 'Algodón'
            ],
            [
                'name' => 'Lana'
            ],
            [
                'name' => 'Cuero'
            ],
            [
                'name' => 'Nylon'
            ],
            [
                'name' => 'Poliéster'
            ]
        ]);
    }
}
