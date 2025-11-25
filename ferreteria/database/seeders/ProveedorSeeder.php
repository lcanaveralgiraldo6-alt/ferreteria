<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('ALTER TABLE proveedores AUTO_INCREMENT = 1');

        DB::table('proveedores')->insert([
            [
                'nombre' => 'Ferreproveedores S.A.',
                'telefono' => '3101234567',
                'direccion' => 'Cra 10 #20-30 Bogotá',
                'email' => 'contacto@ferreproveedores.com',
                'nit' => '900123456-1'
            ],
            [
                'nombre' => 'Materiales del Norte Ltda',
                'telefono' => '3156543210',
                'direccion' => 'Calle 45 #15-40 Bucaramanga',
                'email' => 'info@materialesnorte.com',
                'nit' => '900987654-2'
            ],
            [
                'nombre' => 'Distribuidora Industrial El Tornillo',
                'telefono' => '3123456789',
                'direccion' => 'Av. Ferrocarril #12 Medellín',
                'email' => 'ventas@eltornillo.com',
                'nit' => '901234567-3'
            ],
            [
                'nombre' => 'Pintuco Ltda',
                'telefono' => '3209876543',
                'direccion' => 'Autopista Norte #120 Bogotá',
                'email' => 'atencion@pintuco.com',
                'nit' => '900567890-4'
            ],
            [
                'nombre' => 'Suministros FontaPlus',
                'telefono' => '3131122334',
                'direccion' => 'Cra 50 #70-25 Cali',
                'email' => 'ventas@fontaplus.com',
                'nit' => '901111222-5'
            ],
            [
                'nombre' => 'ElectroFerre S.A.S.',
                'telefono' => '3162233445',
                'direccion' => 'Calle 100 #23-50 Bogotá',
                'email' => 'contacto@electroferre.com',
                'nit' => '901222333-6'
            ],
            [
                'nombre' => 'Construmateriales Bogotá',
                'telefono' => '3103344556',
                'direccion' => 'Av. Caracas #45-60 Bogotá',
                'email' => 'info@construmateriales.com',
                'nit' => '901333444-7'
            ],
            [
                'nombre' => 'TuboMaster S.A.',
                'telefono' => '3114455667',
                'direccion' => 'Zona Industrial Itagüí',
                'email' => 'ventas@tubomaster.com',
                'nit' => '901444555-8'
            ],
            [
                'nombre' => 'HerramiCenter Medellín',
                'telefono' => '3175566778',
                'direccion' => 'Calle 80 #30-45 Medellín',
                'email' => 'contacto@herramicenter.com',
                'nit' => '901555666-9'
            ],
            [
                'nombre' => 'Pegatex Industrial',
                'telefono' => '3186677889',
                'direccion' => 'Calle 26 #40-70 Bogotá',
                'email' => 'info@pegatex.com',
                'nit' => '901666777-0'
            ],
        ]);
    }
}
