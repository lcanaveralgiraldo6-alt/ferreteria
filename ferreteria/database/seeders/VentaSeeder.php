<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar las restricciones para limpiar sin error
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('ventas')->truncate();
        DB::statement('ALTER TABLE ventas AUTO_INCREMENT = 1;');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ventas con producto_id entre 1 y 10
        $ventas = [
            [
                'cantidad' => 3,
                'nombre_cliente' => 'Carlos Ramírez',
                'producto_id' => 4,
                'total' => 120000,
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cantidad' => 1,
                'nombre_cliente' => 'Ana Gómez',
                'producto_id' => 2,
                'total' => 350000,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cantidad' => 2,
                'nombre_cliente' => 'José López',
                'producto_id' => 5,
                'total' => 130000,
                'user_id' => 1,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'cantidad' => 4,
                'nombre_cliente' => 'Sandra Pérez',
                'producto_id' => 8,
                'total' => 36000,
                'user_id' => 2,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'cantidad' => 2,
                'nombre_cliente' => 'Diego Torres',
                'producto_id' => 3,
                'total' => 60000,
                'user_id' => 1,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'cantidad' => 3,
                'nombre_cliente' => 'Laura Peña',
                'producto_id' => 10,
                'total' => 25500,
                'user_id' => 2,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
        ];

        DB::table('ventas')->insert($ventas);
    }
}
