<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('productos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('productos')->insert([
            [
                'nombre' => 'Martillo de acero',
                'descripcion' => 'Martillo con mango de goma',
                'precio' => 25000,
                'stock' => 20,
                'categoria_id' => 1,
                'proveedor_id' => 1,
            ],
            [
                'nombre' => 'Taladro Bosch GSB 550',
                'descripcion' => 'Taladro electrico de 550W',
                'precio' => 350000,
                'stock' => 10,
                'categoria_id' => 2,
                'proveedor_id' => 2,
            ],
            [
                'nombre' => 'Llave inglesa ajustable',
                'descripcion' => 'Llave de acero cromado',
                'precio' => 30000,
                'stock' => 15,
                'categoria_id' => 1,
                'proveedor_id' => 3,
            ],
            [
                'nombre' => 'Cemento gris Argos 50kg',
                'descripcion' => 'Saco de cemento gris',
                'precio' => 40000,
                'stock' => 50,
                'categoria_id' => 3,
                'proveedor_id' => 4,
            ],
            [
                'nombre' => 'Pintura blanca 1 galon',
                'descripcion' => 'Pintura blanca vinilica',
                'precio' => 65000,
                'stock' => 25,
                'categoria_id' => 4,
                'proveedor_id' => 5,
            ],
            [
                'nombre' => 'Tubo PVC media pulgada',
                'descripcion' => 'Tubo plastico para agua',
                'precio' => 8000,
                'stock' => 100,
                'categoria_id' => 5,
                'proveedor_id' => 6,
            ],
            [
                'nombre' => 'Cable electrico 12 AWG',
                'descripcion' => 'Cable de cobre aislado',
                'precio' => 4500,
                'stock' => 200,
                'categoria_id' => 6,
                'proveedor_id' => 7,
            ],
            [
                'nombre' => 'Tornillos acero 1 x 100u',
                'descripcion' => 'Paquete de tornillos',
                'precio' => 9000,
                'stock' => 75,
                'categoria_id' => 8,
                'proveedor_id' => 8,
            ],
            [
                'nombre' => 'Guantes industriales',
                'descripcion' => 'Guantes de trabajo',
                'precio' => 12000,
                'stock' => 40,
                'categoria_id' => 9,
                'proveedor_id' => 9,
            ],
            [
                'nombre' => 'Pegante epoxico',
                'descripcion' => 'Adhesivo fuerte',
                'precio' => 18000,
                'stock' => 60,
                'categoria_id' => 10,
                'proveedor_id' => 10,
            ],
        ]);
    }
}
