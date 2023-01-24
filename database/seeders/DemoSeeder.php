<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name' => 'Carlos',
            'email' => 'cefreitas.18@gmail.com',
            'password' => Hash::make('car123los'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::table('clientes')->insert([
            'primer_nombre' => 'Carlos',
            'segundo_nombre' => 'Eduardo',
            'primer_apellido' => 'Freitas',
            'segundo_apellido' => 'Vicente',
            'tipo_documento' => 'E-',
            'documento_identidad' => '84.407.489',
            'direccion' => 'Plaza',
            'estado' => 'Activo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Carlos Cliente',
            'email' => 'cefreitas.18@gmail.com',
            'id_client' => 1,
            'password' => Hash::make('car123los'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('productos')->insert([
            'nombre' => 'Producto 1',
            'precio' => 123.45,
            'impuesto' => 5,
            'estado' => 'Activo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('productos')->insert([
            'nombre' => 'Producto 2',
            'precio' => 45.65,
            'impuesto' => 15,
            'estado' => 'Activo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('productos')->insert([
            'nombre' => 'Producto 3',
            'precio' => 39.73,
            'impuesto' => 12,
            'estado' => 'Activo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('productos')->insert([
            'nombre' => 'Producto 4',
            'precio' => 250.00,
            'impuesto' => 8,
            'estado' => 'Activo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('productos')->insert([
            'nombre' => 'Producto 5',
            'precio' => 59.35,
            'impuesto' => 10,
            'estado' => 'Activo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
      
    }
}
