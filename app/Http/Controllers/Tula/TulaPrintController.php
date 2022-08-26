<?php

namespace App\Http\Controllers\Tula;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App;
use App\Models\Package\Package;
use App\Models\Tula\Tula;
use Carbon\Carbon;

class TulaPrintController extends Controller
{
    function printUtilidad($id_tula)
    {
      

        $pdf = App::make('dompdf.wrapper');

        
        $tula = null;
       
            
        if(isset($id_tula)){
            $tula = Tula::find($id_tula);
        
                                
        }else{
            return redirect('/packages/index')->withDanger('No se encontro el Paquete');
        } 

        if(isset($tula)){

            $packages_tula = Package::where('id_tula',$id_tula)->get();
            
            $date = Carbon::now();
            $datenow = $date->format('d-m-Y'); 

            $pdf = $pdf->loadView('admin.tulas.prints.utilidad',compact('tula','packages_tula','datenow'));
            return $pdf->stream();
    
        }else{
            return redirect('/tulas/index')->withDanger('La Tula no existe!!');
        } 
        
    }
}
