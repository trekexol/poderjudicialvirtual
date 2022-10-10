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
        ->leftJoin('type_of_packagings','type_of_packagings.id','package_lumps.id_type_of_packaging')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
        ->leftJoin('agencies as ag','ag.id','packages.id_agency_destination')
        ->leftJoin('agents','agents.id','packages.id_agent_shipper')
        ->leftJoin('client_recipients','client_recipients.id','packages.id_client_recipient')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->select('packages.id','agents.name as agent_name','agencies.name','ag.name as ag_name','packages.instruction',
        'packages.arrival_date','client_recipients.name','packages.description','packages.total_usd',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'),'type_of_packagings.description')
        ->groupBy('packages.id','agents.name','agencies.name','ag.name','packages.instruction',
        'packages.arrival_date','client_recipients.name','packages.description','packages.total_usd','type_of_packagings.description')
        ->orderBy('packages.id','desc')
        ->get();

         $export = new ArrayExport([
             ['PAQUETE','AGENTE','OFICINA_ORIGEN',
             'OFICINA_RECIBE','ENVIO','FECHA','DESTINATARIO','DESCRIPCIÓN'
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
