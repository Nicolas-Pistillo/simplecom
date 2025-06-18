<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sector;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sector::firstOrCreate(['name' => 'Indumentaria y accesorios']);
        Sector::firstOrCreate(['name' => 'Venta de calzado']);
        Sector::firstOrCreate(['name' => 'Artículos deportivos']);
        Sector::firstOrCreate(['name' => 'Relojería y joyería']);
        Sector::firstOrCreate(['name' => 'Almacénes']);
        Sector::firstOrCreate(['name' => 'Artículos de perfumería y tocador']);
        Sector::firstOrCreate(['name' => 'Materialeles de construcción']);
        Sector::firstOrCreate(['name' => 'Artículos de decoración y objetos de arte']);
        Sector::firstOrCreate(['name' => 'Artículos para el hogar']);
        Sector::firstOrCreate(['name' => 'Bazares']);
        Sector::firstOrCreate(['name' => 'Electrodomésticos']);
        Sector::firstOrCreate(['name' => 'Ventas y servicio técnico de Celulares e Informática']);
        Sector::firstOrCreate(['name' => 'Ópticas y casas de artículos de fotografía']);
        Sector::firstOrCreate(['name' => 'Artículos de ferreteria']);
        Sector::firstOrCreate(['name' => 'Pinturerías']);
        Sector::firstOrCreate(['name' => 'Blanquerías']);
        Sector::firstOrCreate(['name' => 'Artículos y accesorios escolares']);
        Sector::firstOrCreate(['name' => 'Gastronomía']);
        Sector::firstOrCreate(['name' => 'Alimentos y bebidas']);
        Sector::firstOrCreate(['name' => 'Comidas rápidas']);
        Sector::firstOrCreate(['name' => 'Ventilación y Refrigeración']);
        Sector::firstOrCreate(['name' => 'Regalerías']);
        Sector::firstOrCreate(['name' => 'Polirubros']);
        Sector::firstOrCreate(['name' => 'Carnicerías']);
        Sector::firstOrCreate(['name' => 'Distribuidoras de bebidas']);
        Sector::firstOrCreate(['name' => 'Pet Shop']);
        Sector::firstOrCreate(['name' => 'Tecnología']);
        Sector::firstOrCreate(['name' => 'Industria agrícola']);
        Sector::firstOrCreate(['name' => 'Jardinería']);
        Sector::firstOrCreate(['name' => 'Ventas de repuestos y autopartes']);
        Sector::firstOrCreate(['name' => 'Veterinarias']);
        Sector::firstOrCreate(['name' => 'Antigüedades']);
        Sector::firstOrCreate(['name' => 'Industria química']);
        Sector::firstOrCreate(['name' => 'Librerías']);
        Sector::firstOrCreate(['name' => 'Servicios profesionales']);
        Sector::firstOrCreate(['name' => 'Artículos de limpieza']);
        Sector::firstOrCreate(['name' => 'Medicina']);
        Sector::firstOrCreate(['name' => 'Mueblerías']);
        Sector::firstOrCreate(['name' => 'Salones de estética']);
        Sector::firstOrCreate(['name' => 'Otros']);
    }
}
