<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ventas')->insert([
            ['producto_id' => 1, 'user_id' => 1, 'cantidad' => 2, 'total' => 70000, 'created_at' => now(), 'updated_at' => now()],
            ['producto_id' => 2, 'user_id' => 1, 'cantidad' => 1, 'total' => 12000, 'created_at' => now(), 'updated_at' => now()],
            ['producto_id' => 3, 'user_id' => 2, 'cantidad' => 3, 'total' => 174000, 'created_at' => now(), 'updated_at' => now()],
            ['producto_id' => 4, 'user_id' => 2, 'cantidad' => 5, 'total' => 160000, 'created_at' => now(), 'updated_at' => now()],
            ['producto_id' => 5, 'user_id' => 1, 'cantidad' => 4, 'total' => 100000, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
