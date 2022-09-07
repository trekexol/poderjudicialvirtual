<?php

namespace App\Imports;

use App\Models\Administration\Client;
use App\Models\Package\Package;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PackageImport implements ToModel,WithHeadingRow, SkipsOnError
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user       =   auth()->user();
        $date = Carbon::now();

        
        $client = Client::where('casillero',$row['cliente'])->first();

        
        $package = DB::table('packages')->insert([
            
            'id'                                => 2,
            'id_client'                         => $client->id, 
            'content'                           => $row['contenido'], 
            'status'                            => $row['estado'], 
            'value'                             => $row['valor'], 
            'id_agency_office_location'         => $row['ubicacion_oficina'], 
            'id_agent_vendor'                   => 1, 
            'id_delivery_company'               => 1, 
            'service_type'                      => 1, 
            'id_wharehouse'                     => $row['ubicacion_almacen'], 
            'id_agency_destination'             => $row['oficina_recibe'], 
            'id_origin_country'                 => $row['origen'],
            'id_destination_country'            => $row['destino'],
            'tracking'                          => $row['tracking_origen'], 
            'id_agent_shipper'                  => $row['empresa_entrega'], 
            'instruction'                       => $row['tipo_servicio'],  
            'instruction_type'                  => $row['instrucciones1'],  
            'description'                       => $row['comentarios'],  
            'created_at'                        => $date,
            'updated_at'                        => $date,
        ]);

       
        return ;

    }

    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}
