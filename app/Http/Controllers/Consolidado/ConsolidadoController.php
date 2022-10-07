<?php

namespace App\Http\Controllers\Consolidado;

use App\Http\Controllers\Controller;
use App\Models\Consolidado\Consolidado;
use App\Models\Package\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsolidadoController extends Controller
{
    public function index()
    {
      
        $consolidados = /*Consolidado::join('packages','packages.id','consolidados.id_package')
                                ->join('clients','clients.id','packages.id_client')
                                ->join('agencies','agencies.id','clients.id_agency')
                                ->join('agents','agents.id','clients.id_agency')
                                ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                                'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                                'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','agencies.name as agency_name','agents.name as agent_name','instruction')
                                ->groupBy('consolidados.id_package','packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                                'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                                'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','id_client','agencies.name','agents.name','instruction')
                                ->get();*/
                                Consolidado::orderBy('consolidados.number_consolidado', 'desc')->groupBy('consolidados.number_consolidado','id','id_package','amount_total','status','created_at','updated_at')->get();

        dd($consolidados);
      
        return view('admin.consolidados.index',compact('consolidados'));
    
    }

    public function aerial(Request $request)
    {
       
         //Recorre el request y almacena los valores despues del segundo valor que le llegue, asi guarda los id de las facturas a procesar
         $array = $request->all();
         $count = 0;

         $last_consolidado = Consolidado::orderBy('number_consolidado','desc')->first();

         $last_number_consolidado = $last_consolidado->number_consolidado ?? 1;
 
         foreach ($array as $key => $id_package) 
         {
            if($count >= 3){
               
                if($this->validateExist($id_package)){
                    return redirect('/clients/consult/'.$request->id_client.'')->withDanger('El paquete ya fue Consolidado!');
                }

                $consolidado = new Consolidado();

                $consolidado->id_package = $id_package;
                $consolidado->number_consolidado = $last_number_consolidado;
                $consolidado->amount_total = 0;
                $consolidado->status = 'Activo';
                $consolidado->save();

                $package = Package::findOrFail($id_package);
                $package->status = "Consolidado";
                $package->save();
                
            }else{
                $count ++;
            }

         }

         return redirect('/clients/consult/'.$request->id_client.'')->withSuccess('Se ha consolidado correctamente!');
    }

    public function maritime(Request $request)
    {
       
         //Recorre el request y almacena los valores despues del segundo valor que le llegue, asi guarda los id de las facturas a procesar
         $array = $request->all();
         $count = 0;

         $last_consolidado = Consolidado::orderBy('number_consolidado','desc')->first();

         $last_number_consolidado = $last_consolidado->number_consolidado ?? 1;
 
         foreach ($array as $key => $id_package) 
         {
            if($count >= 3){
               
                if($this->validateExist($id_package)){
                    return redirect('/clients/consult/'.$request->id_client.'')->withDanger('El paquete ya fue Consolidado!');
                }

                $consolidado = new Consolidado();

                $consolidado->id_package = $id_package;
                $consolidado->number_consolidado = $last_number_consolidado;
                $consolidado->amount_total = 0;
                $consolidado->status = 'Activo';
                $consolidado->save();

                $package = Package::findOrFail($id_package);
                $package->status = "Consolidado";
                $package->save();
                
            }else{
                $count ++;
            }

         }

         return redirect('/clients/consult/'.$request->id_client.'')->withSuccess('Se ha consolidado correctamente!');
    }

    public function validateExist($id_package){

        $exist_consolidado = Consolidado::where('id_package',$id_package)->first();

        if(isset($exist_consolidado)){
            return true;
        }
        return false;
    }
    
}
