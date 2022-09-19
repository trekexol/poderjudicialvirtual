<?php

namespace App\Imports;

use App\Account;
use App\Models\Administration\Agency;
use App\Models\Administration\Agent;
use App\Models\Administration\Client;
use App\Models\Administration\Countries\Country;
use App\Models\Administration\Wharehouse;
use App\Models\Package\Package;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class PackageImport implements ToCollection,WithHeadingRow, SkipsOnError
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if(isset($row['contenido'])){
                
            $user       =   auth()->user();

            $date = Carbon::now();
    
            $package_exist = Package::where('tracking',$row['tracking_origen'])->first();
            
            $client = Client::where('casillero',$row['cliente'])->first();
    
            $agency_ubicacion_oficina = Agency::where('code',$row['ubicacion_oficina'])->first();
    
            $agency_oficina_recibe = Agency::where('code',$row['oficina_recibe'])->first();
    
            $agent_empresa_entrega = Agent::where('code',$row['empresa_entrega'])->first();
    
            $wharehouse_ubicacion_almacen = Wharehouse::where('code',$row['ubicacion_almacen'])->first();
    
            $country_origen = Country::where('abbreviation',$row['origen'])->first();
    
            $country_destino = Country::where('abbreviation',$row['destino'])->first();

           // dd($agency_ubicacion_oficina->id);
    
           //dd($rows);
            if(empty($package_exist)){
               // dd($client->id);
              
                $package = new Package();
                
                 $package->id_client                    = $client->id;
                 $package->content                      = $row['contenido'] ?? 'No Tiene';
                 $package->status                       = $row['estado'];
                 $package->value                        = $row['valor'] ?? 'No Tiene';
                 $package->id_agency_office_location    = 1;
                  
                 $package->service_type                 = $row['tipo_servicio'] ?? 'No Tiene';;
                 $package->id_wharehouse                = 1;
                 $package->id_agency_destination        = 1;
                 $package->id_origin_country            = 1;
                 $package->id_destination_country       = 1;
                 $package->tracking                     = $row['tracking_origen'] ?? 'No Tiene';;
                 $package->id_agent_shipper             = 1;
                 $package->instruction                  = $row['instrucciones1'] ?? 'No Tiene';; 
                 $package->instruction_type             = 'Directo'; 
                 $package->description                  = $row['comentarios'] ?? 'No Tiene';; 
                 $package->created_at                   = $date;
                 $package->updated_at                   = $date;
                

                $package->save();

                        /*for($i = 1 ; $i <= $row['num_bultos']; $i ++){
                    
                    $package_lump = DB::table('package_lumps')->insert([
                        
                        'id_package'                => $package->id ?? $package_exist->id, 
                        'id_type_of_packaging'      => $row['tipo_bulto'], 
                        'amount'                    => $row['unid'], 
                        'bulk_weight'               => $row['peso'], 
                        'length_weight'             => $row['largo'], 
                        'width_weight'              => $row['ancho'],  
                        'high_weight'               => $row['alto'],   
                        'description'               => $row['comentarios'],  
                        'status'                    => 'Activo',  
                        'created_at'                => $date,
                        'updated_at'                => $date,
                    ]);
                }
            */
                
            }
            }
           
        }

        
    }

    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}