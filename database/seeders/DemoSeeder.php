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
        DB::/*connection('logins')->*/table('agents')->insert([
            'code' => '1',
            'name' => 'Carlos Cargo',
            'type' => 'Cargo',
            'direction' => 'Ejemplo',
            'phone' => '0424-1514152',
            'email' => 'cefreitas.16@gmail.com',
            'contact_person' => 'Ejemplo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('agents')->insert([
            'code' => '1',
            'name' => 'Carlos Emisor',
            'type' => 'Emisor',
            'direction' => 'Ejemplo',
            'phone' => '0424-1514152',
            'email' => 'cefreitas.16@gmail.com',
            'contact_person' => 'Ejemplo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('agents')->insert([
            'code' => '1',
            'name' => 'Carlos Consignatario',
            'type' => 'Consignatario',
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
        DB::/*connection('logins')->*/table('delivery_companies')->insert([
            'code' => '1',
            'description' => 'Ejemplo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('delivery_companies')->insert([
            'code' => '1',
            'description' => 'Ejemplo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('states')->insert([
            'id_country' => '1',
            'name' => 'Caracas',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('type_of_goods')->insert([
            'code' => '1',
            'description' => 'Ejemplo',
            'tariff_rate' => 10,
            'tax_percentage' => 10,
            'additional_charge' => 10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('type_of_packagings')->insert([
            'code' => '1',
            'description' => 'Ejemplo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('agencies')->insert([
            'id_state' => 1,
            'code' => '1',
            'name' => 'Ejemplo',
            'type' => 'Comercial',
            'direction' => 'Ejemplo',
            'phone' => '0424-1514152',
            'contact_person' => 'Ejemplo',
            'rate' => 10,
            'virtual_payment' => 'yes',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('wharehouses')->insert([
            'id_agency' => 1,
            'code' => '1',
            'name' => 'Ejemplo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('making_codes')->insert([
            'id_country' => 1,
            'code' => '0424',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('making_codes')->insert([
            'id_country' => 1,
            'code' => '0414',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::/*connection('logins')->*/table('clients')->insert([
            'id_country' => 1,
            'id_state_received' => 1,
            'id_agency' => 1,
            'id_code_room' => 1,
            'id_code_work' => 1,
            'id_code_mobile' => 1,
            'id_code_fax' => 1,
            'type_cedula' => 'V-',
            'cedula' => '27.661.899',
            'firstname' => 'Ejemplo',
            'firstlastname' => 'Ejemplo',
            'secondname' => 'Ejemplo',
            'secondlastname' => 'Ejemplo',
            'direction' => 'Ejemplo',
            'street_received' => 'Ejemplo',
            'urbanization_received' => 'Ejemplo',
            'type_direction_received' => 'Ejemplo',
            'phone_room' => '0424-1514152',
            'phone_work' => '0424-1514152',
            'phone_mobile' => '0424-1514152',
            'phone_fax' => '0424-1514152',
            'company' => 'Ejemplo',
            'rif' => 'Ejemplo',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
