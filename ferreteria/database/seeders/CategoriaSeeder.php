<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('ALTER TABLE categorias AUTO_INCREMENT = 1'); 

        DB::table('categorias')->insert([
            ['nombre' => 'Herramientas manuales', 'descripcion' => 'Martillos, destornilladores, llaves, alicates y otras herramientas de uso manual.'],
            ['nombre' => 'Herramientas eléctricas', 'descripcion' => 'Taladros, sierras, pulidoras y demás equipos eléctricos para trabajo pesado.'],
            ['nombre' => 'Materiales de construcción', 'descripcion' => 'Cemento, arena, gravilla, ladrillos y productos de obra civil.'],
            ['nombre' => 'Pinturas y acabados', 'descripcion' => 'Pinturas, selladores, brochas, rodillos y artículos para decoración.'],
            ['nombre' => 'Fontanería', 'descripcion' => 'Tubos, conexiones PVC, llaves de paso y artículos para plomería.'],
            ['nombre' => 'Electricidad', 'descripcion' => 'Cables, bombillos, interruptores y accesorios eléctricos.'],
            ['nombre' => 'Seguridad industrial', 'descripcion' => 'Guantes, gafas, cascos, botas y otros elementos de protección personal.'],
            ['nombre' => 'Ferretería general', 'descripcion' => 'Tornillos, clavos, tuercas, arandelas y otros artículos básicos.'],
            ['nombre' => 'Pegantes y selladores', 'descripcion' => 'Silicona, cemento de contacto, pegante epóxico y selladores industriales.'],
            ['nombre' => 'Jardinería', 'descripcion' => 'Herramientas y accesorios para el mantenimiento de jardines y exteriores.'],
        ]);
    }
}
