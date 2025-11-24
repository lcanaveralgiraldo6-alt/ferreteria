<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productos')->insert([
            ['nombre' => 'Martillo Stanley', 'descripcion' => 'Martillo de acero con mango de goma', 'precio' => 35000, 'stock' => 25, 'categoria_id' => 1],
            ['nombre' => 'Destornillador Philips', 'descripcion' => 'Destornillador punta cruz mediano', 'precio' => 12000, 'stock' => 50, 'categoria_id' => 1],
            ['nombre' => 'Pintura blanca Corona', 'descripcion' => 'Galón de pintura vinílica blanca', 'precio' => 58000, 'stock' => 15, 'categoria_id' => 2],
            ['nombre' => 'Cemento Argos 50kg', 'descripcion' => 'Saco de cemento gris de 50 kilogramos', 'precio' => 32000, 'stock' => 100, 'categoria_id' => 3],
            ['nombre' => 'Cable eléctrico 10m', 'descripcion' => 'Cable de cobre calibre 12', 'precio' => 28000, 'stock' => 40, 'categoria_id' => 4],
            ['nombre' => 'Llave de tubo', 'descripcion' => 'Llave ajustable para fontanería', 'precio' => 25000, 'stock' => 20, 'categoria_id' => 5],
        ]);
    }
}
