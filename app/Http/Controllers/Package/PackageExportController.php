<?php

namespace App\Http\Controllers\Package;

use App\Exports\ArrayExport;
use App\Exports\Package\ManifiestoExport;
use App\Exports\Reports\PackageExportFromView;
use App\Http\Controllers\Controller;
use App\Models\Package\Package;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PackageExportController extends Controller
{
    public function exportPackageTemplate() 
    {
         
        
         $export = new ArrayExport([
             ['cliente','contenido','estado','valor',
             'num_bultos','tipo_bulto','unid','peso','largo','ancho'
             ,'alto','ubicacion_oficina','ubicacion_almacen'
             ,'oficina_recibe','origen','destino','tracking_origen','empresa_entrega','tipo_servicio','instrucciones1'
             ,'comentarios','correo_cliente_destinatario','nombre_cliente_destinatario'
             ,'cedula_cliente_destinatario','direccion_cliente_destinatario','direccion2_cliente_destinatario','observacion_cliente_destinatario'
             ,'telefono_cliente_destinatario','moneda']		
            
        ]);
        
        return Excel::download($export, 'plantilla_paquetes.xlsx');
    }

    public function exportPackageManifiesto() 
    {
        return Excel::download(new ManifiestoExport, 'Manifiesto.xlsx');
       
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
