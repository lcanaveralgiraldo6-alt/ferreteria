<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1'); 

        DB::table('users')->insert([
            [
                'name' => 'Administrador General',
                'email' => 'admin@picopala.com',
                'password' => Hash::make('Nala123*'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Administrador Secundario',
                'email' => 'admin2@picopala.com',
                'password' => Hash::make('Nala123*'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
