<?php

namespace App\Http\Controllers\Package;

use App\Exports\ArrayExport;
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
         
        $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
        'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
        'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot'
        ,'packages.date_payment','packages.instruction','agencies.name',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
        ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot'
                ,'packages.date_payment','packages.instruction','agencies.name')
        ->orderBy('packages.id','desc')
        ->get();

         $export = new ArrayExport([
             ['PAQUETE','AGENTE','OFICINA','ORIGEN',
             'OFICINA','RECIBE','ENVIO','FECHA','DESTINATARIO','DESCRIPCIÓN'
             ,'USD','PZS.','UNID.'
             ,'PESO.','PC','M3','DIRECCIÓN','TELEF','SHIPPER','PO'
             ,'INV','PAGAR','TRACKING'],		
            $packages
        ]);
        		 	 																	

        
        return Excel::download($export, 'Manifiesto.xlsx');
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
