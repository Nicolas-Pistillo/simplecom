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
        Sector::updateOrCreate(['name' => 'Indumentaria y accesorios']);
        Sector::updateOrCreate(['name' => 'Venta de calzado']);
        Sector::updateOrCreate(['name' => 'Artículos deportivos']);
        Sector::updateOrCreate(['name' => 'Relojería y joyería']);
        Sector::updateOrCreate(['name' => 'Almacénes']);
        Sector::updateOrCreate(['name' => 'Artículos de perfumería y tocador']);
        Sector::updateOrCreate(['name' => 'Materialeles de construcción']);
        Sector::updateOrCreate(['name' => 'Artículos de decoración y objetos de arte']);
        Sector::updateOrCreate(['name' => 'Artículos para el hogar']);
        Sector::updateOrCreate(['name' => 'Bazares']);
        Sector::updateOrCreate(['name' => 'Electrodomésticos']);
        Sector::updateOrCreate(['name' => 'Ventas y servicio técnico de Celulares e Informática']);
        Sector::updateOrCreate(['name' => 'Ópticas y casas de artículos de fotografía']);
        Sector::updateOrCreate(['name' => 'Artículos de ferreteria']);
        Sector::updateOrCreate(['name' => 'Pinturerías']);
        Sector::updateOrCreate(['name' => 'Blanquerías']);
        Sector::updateOrCreate(['name' => 'Gastronomía']);
        Sector::updateOrCreate(['name' => 'Alimentos y bebidas']);
        Sector::updateOrCreate(['name' => 'Comidas rápidas']);
        Sector::updateOrCreate(['name' => 'Ventilación y Refrigeración']);
        Sector::updateOrCreate(['name' => 'Regalerías']);
        Sector::updateOrCreate(['name' => 'Polirubros']);
        Sector::updateOrCreate(['name' => 'Carnicerías']);
        Sector::updateOrCreate(['name' => 'Distribuidoras de bebidas']);
        Sector::updateOrCreate(['name' => 'Pet Shop']);
        Sector::updateOrCreate(['name' => 'Tecnología']);
        Sector::updateOrCreate(['name' => 'Industria agrícola']);
        Sector::updateOrCreate(['name' => 'Jardinería']);
        Sector::updateOrCreate(['name' => 'Veterinarias']);
        Sector::updateOrCreate(['name' => 'Antigüedades']);
        Sector::updateOrCreate(['name' => 'Industria química']);
        Sector::updateOrCreate(['name' => 'Librerías']);
        Sector::updateOrCreate(['name' => 'Servicios profesionales']);
        Sector::updateOrCreate(['name' => 'Artículos de limpieza']);
        Sector::updateOrCreate(['name' => 'Medicina']);
        Sector::updateOrCreate(['name' => 'Mueblerías']);
        Sector::updateOrCreate(['name' => 'Salones de estética']);
        Sector::updateOrCreate(['name' => 'Otros']);
    }
}
