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
      
        $consolidados = Consolidado::join('packages','packages.id','consolidados.id_package')
                                ->join('clients','clients.id','packages.id_client')
                                ->orderBy('packages.id','desc')
                                ->groupBy('id_client','instruction')
                                ->select('instruction',DB::raw('SUM(packages.id) As amount_packages'))
                                ->get();

       
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
