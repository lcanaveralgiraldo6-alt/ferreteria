<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Ejecutar los seeders en orden
        $this->call([
            RoleSeeder::class,
            CategoriaSeeder::class,
            ProductoSeeder::class,
            UserSeeder::class,
            VentaSeeder::class,
        ]);
    }
}
