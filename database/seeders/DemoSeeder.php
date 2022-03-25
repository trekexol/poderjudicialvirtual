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
        DB::/*connection('logins')->*/table('users')->insert([
            'name' => 'Carlos',
            'email' => 'cefreitas.16@gmail.com',
            'password' => Hash::make('car123los'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('agents')->insert([
            'code' => '1',
            'name' => 'Carlos',
            'type' => 'Transportista',
            'direction' => 'Ejemplo',
            'phone' => '0424-1514152',
            'email' => 'cefreitas.16@gmail.com',
            'contact_person' => 'Ejemplo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('airlines')->insert([
            'code' => '1',
            'name' => 'Carlos',
            'type' => 'Peso Cargable',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('carriers')->insert([
            'code' => '1',
            'name' => 'Carlos',
            'type' => 'Peso Cargable',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('countries')->insert([
            'abbreviation' => 'VE',
            'name' => 'Venezuela',
            'code_phone' => '+58',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('states')->insert([
            'id_country' => '1',
            'name' => 'Caracas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
