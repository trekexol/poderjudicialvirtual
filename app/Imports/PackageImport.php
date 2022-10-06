<?php

namespace App\Imports;

use App\Account;
use App\Http\Controllers\PackageLump\PackageLumpController;
use App\Models\Administration\Agency;
use App\Models\Administration\Agent;
use App\Models\Administration\Client;
use App\Models\Administration\Countries\Country;
use App\Models\Administration\Wharehouse;
use App\Models\AdministrationClient\ClientRecipient;
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
        foreach ($rows as $row) 
        {

            if(isset($row['contenido']))
            {
                
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
            if(empty($package_exist))
            {
               // dd($client->id);
              
                $package = new Package();
                
                 $package->id_client                    = $client->id;
                 $package->content                      = $row['contenido'] ?? 'No Tiene';
                 $package->status                       = $row['estado'];
                 $package->value                        = $row['valor'] ?? 'No Tiene';
                 $package->id_agency_office_location    = $agency_ubicacion_oficina->id ?? null;
                  
                 $package->service_type                 = $row['tipo_servicio'] ?? 'No Tiene';;
                 $package->id_wharehouse                = $wharehouse_ubicacion_almacen->id ?? null;
                 $package->id_agency_destination        = $agency_oficina_recibe->id ?? null;
                 $package->id_origin_country            = $country_origen->id ?? null;
                 $package->id_destination_country       = $country_destino->id ?? null;
                 $package->tracking                     = $row['tracking_origen'] ?? 'No Tiene';;
                 $package->id_agent_shipper             = $agent_empresa_entrega->id ?? null;
                 $package->instruction                  = $row['instrucciones1'] ?? 'No Tiene';; 
                 $package->instruction_type             = 'Directo'; 
                 $package->description                  = $row['comentarios'] ?? 'No Tiene';; 
                 $package->created_at                   = $date;
                 $package->updated_at                   = $date;
                

                $package->save();
              

                //registro de los bultos
                for($i = 1 ; $i <= $row['num_bultos']; $i ++){
                    
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
                    
                    $this->updatePackage($row,$package);
                }

            }else{
                
                //Si el paquete ya esta registrado con el numero de tracking solo se registran los bultos
                for($i = 1 ; $i <= $row['num_bultos']; $i ++){
                    
                    $package_lump = DB::table('package_lumps')->insert([
                        
                        'id_package'                => $package_exist->id, 
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
                    $this->updatePackage($row,$package_exist);
                }
            }

            }

            $this->registerClientRecipient($package,$client,$row,$country_destino,$date);
            

        }

        
    }

    public function updatePackage($row,$package){
        
        
        $package = Package::findOrFail($package->id);
     
        $lenght = $row['largo'];
      
        $width = $row['ancho'];
             
        $high = $row['alto'];

        if(($high != "" && $high != 0) && ($width != "" && $width != 0) && ($lenght != "" && $lenght != 0)){

            $volume = ceil(($high * $width * $lenght) / 166);
            
            $cubic_foot = ceil(($high * $width * $lenght) / 1728);

            $package->volume += $volume;
            $package->cubic_foot += $cubic_foot;

            $package->starting_weight += $row['peso'];

            $package->save();
        }
    
           
    }

    public function registerClientRecipient($package,$client,$row,$country_destino,$date){

        if(isset($row['cedula_cliente_destinatario'])){

        $client_recipient = ClientRecipient::where('identification_card',$row['cedula_cliente_destinatario'])->first();

        $package_update_client_recipient = Package::findOrFail($package->id);

        if(empty($client_recipient)){
            
            $client_recipient = new ClientRecipient();
                
            $client_recipient->id_client                    = $client->id;
            $client_recipient->id_country                   = $country_destino->id;
            $client_recipient->email                        = $row['correo_cliente_destinatario'] ?? 'No Tiene';
            $client_recipient->name                         = $row['nombre_cliente_destinatario'] ?? 'No Tiene';
            $client_recipient->identification_card          = $row['cedula_cliente_destinatario'] ?? 'No Tiene';
            $client_recipient->direction1                   = $row['direccion_cliente_destinatario'] ?? 'No Tiene';
            $client_recipient->direction2                   = $row['direccion2_cliente_destinatario'] ?? 'No Tiene';
            $client_recipient->observation                  = $row['observacion_cliente_destinatario'] ?? 'No Tiene';
            $client_recipient->phone                        = $row['telefono_cliente_destinatario'] ?? 'No Tiene';
            
            $client_recipient->status                       = 'Activo';
            $client_recipient->created_at                   = $date;
            $client_recipient->updated_at                   = $date;
        

            $client_recipient->save();
       
            
        }
            
        //actualizar el cliente destino del paquete
        $package_update_client_recipient->id_client_recipient = $client_recipient->id;
        $package_update_client_recipient->save();

        }
           
    }

    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}