<?php
namespace App\Exports\Package;

use App\Models\Package\Package;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class ManifiestoExport implements FromView
{
    public function view(): View
    {
        $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
        ->leftJoin('type_of_packagings','type_of_packagings.id','package_lumps.id_type_of_packaging')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
        ->leftJoin('agencies as ag','ag.id','packages.id_agency_destination')
        ->leftJoin('agents','agents.id','packages.id_agent_vendor')
        ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
        ->leftJoin('client_recipients','client_recipients.id','packages.id_client_recipient')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->select('packages.id as numero_paquete','agents.name as agent_name','agencies.name','ag.name as ag_name','packages.instruction',
        'packages.arrival_date','client_recipients.name as client_name','packages.description','packages.total_usd',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'),'type_of_packagings.description as description_type','package_lumps.bulk_weight'
        ,'package_lumps.length_weight','package_lumps.width_weight','package_lumps.high_weight','client_recipients.direction1 as client_direction','client_recipients.phone as client_phone'
        ,'agent_shipper.name as name_shipper','packages.tracking as tracking',)
        ->groupBy('packages.id','agents.name','agencies.name','ag.name','packages.instruction',
        'packages.arrival_date','client_recipients.name','packages.description','packages.total_usd','type_of_packagings.description','package_lumps.bulk_weight'
        ,'package_lumps.length_weight','package_lumps.width_weight','package_lumps.high_weight','client_recipients.direction1','client_recipients.phone'
        ,'agent_shipper.name','packages.tracking')
        ->orderBy('packages.id','desc')
        ->get();

        return view('export_excel.manifiesto', [
            'packages' => $packages
        ]);
    }
}