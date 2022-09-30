<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Controller;
use App\Models\Package\Package;
use Illuminate\Http\Request;

use App;
use App\Models\General\General;
use App\Models\Package\PackageLump;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PackagePrintController extends Controller
{
    function print($id_package)
    {
      

        $pdf = App::make('dompdf.wrapper');

        
        $package = null;
        $general = null;
        $package_lumps = null;
            
        if(isset($id_package)){
            $package = Package::find($id_package);
        
                                
        }else{
            return redirect('/packages/index')->withDanger('No se encontro el Paquete');
        } 

        if(isset($package)){

            $general = General::find(1);

            $package_lumps = PackageLump::where('id_package',$id_package)->get();
        
            $date = Carbon::now();
            $datenow = $date->format('d-m-Y'); 

           

            $pdf = $pdf->loadView('admin.packages.prints.ticket',compact('general','package','package_lumps','datenow'));
            return $pdf->stream();
    
        }else{
            return redirect('/packages/index')->withDanger('El paquete no existe!!');
        } 
        
    }
}
