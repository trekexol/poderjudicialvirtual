<?php

namespace App\Http\Controllers\Package;

use App\Exports\ArrayExport;
use App\Exports\Reports\PackageExportFromView;
use App\Http\Controllers\Controller;
use App\Models\Package\Package;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class PackageExportController extends Controller
{
    public function exportPackageTemplate() 
    {
         
        
         $export = new ArrayExport([
             ['cliente','contenido','estado','valor',
             'num_bultos','tipo_bulto','unid','peso','largo','ancho'
             ,'alto','ubicacion_oficina','ubicacion_almacen'
             ,'oficina_recibe','origen','destino','tracking_origen','empresa_entrega','tipo_servicio','instrucciones1'
             ,'comentarios','direccion_cliente1','direccion_cliente2'
             ,'ci_cliente2','direccion_cliente3','direccion_cliente4','direccion_destino1'
             ,'direccion_destino2','direccion_destino3','direccion_destino4','moneda']		
            
        ]);
        
        return Excel::download($export, 'plantilla_paquetes.xlsx');
    }

    public function exportExcel(Request $request) 
    {
        $export = new PackageExportFromView($request);

        $export->setter($request);

        $export->view();       
        
        return Excel::download($export, 'paquetes.xlsx');
    }

    function packageExport()
    {
        
        $pdf = App::make('dompdf.wrapper');
        $packages = null;
        
        $date = Carbon::now();
        $datenow = $date->format('d-m-Y'); 

        $date = Carbon::now();
        $datenow = $date->format('d-m-Y'); 

       
        $packages = Package::get();
       
        
        return view('export_excel.packages',compact('coin','packages','datenow','date_end','typeperson'));
                 
    }

}
