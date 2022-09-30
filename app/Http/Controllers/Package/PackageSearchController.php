<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Administration\Agency\AgencyController;
use App\Http\Controllers\Controller;
use App\Models\Administration\Agency;
use App\Models\Administration\Wharehouse;
use App\Models\Package\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageSearchController extends Controller
{
    public function index(Request $request)
    {
        $packages = null;

        if(isset($request->id_agency) && isset($request->id_wharehouse)){
            $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
            ->leftJoin('clients','clients.id','packages.id_client')
            ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
            ->where('id_tula',null)
            ->where('id_paddle',null)
            ->where('id_agency_office_location',$request->id_agency)
            ->where('id_wharehouse',$request->id_wharehouse)
            ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
            'packages.tracking','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
            'packages.description','packages.instruction','agencies.name',
            DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
            ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                    'packages.tracking','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                    'packages.description','packages.instruction','agencies.name')
            ->get();
        }else{

            if(isset($request->id_agency)){
                $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
                ->leftJoin('clients','clients.id','packages.id_client')
                ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->where('id_tula',null)
                ->where('id_paddle',null)
                ->where('id_agency_office_location',$request->id_agency)
                ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                'packages.tracking','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.instruction','agencies.name',
                DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
                ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                        'packages.tracking','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                        'packages.description','packages.instruction','agencies.name')
                ->get();
            }else if(isset($request->id_wharehouse)){
                $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
                ->leftJoin('clients','clients.id','packages.id_client')
                ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->where('id_tula',null)
                ->where('id_paddle',null)
                ->where('id_wharehouse',$request->id_wharehouse)
                ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                'packages.tracking','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.instruction','agencies.name',
                DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
                ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                        'packages.tracking','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                        'packages.description','packages.instruction','agencies.name')
                ->get();
            }else if(isset($request->client) && ($request->client != "")){
               
                $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
                ->leftJoin('clients','clients.id','packages.id_client')
                ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->where('id_tula',null)
                ->where('id_paddle',null)
                ->where('clients.firstname','LIKE','%'.$request->client.'%')
                ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                'packages.tracking','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.instruction','agencies.name',
                DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
                ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                        'packages.tracking','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                        'packages.description','packages.instruction','agencies.name')
                ->get();
            }
        }

        if(isset($packages)){
            $agencyController = new AgencyController();
            foreach($packages as $package){
                $package->agency = $agencyController->returnAgencyById($package->id_agency);
            }
        }


       $agencies = Agency::orderBy('name','asc')->get();

       $wharehouses = Wharehouse::orderBy('name','asc')->get();
      
       return view('admin.packages.index',compact('packages','agencies','wharehouses'));
    }



}
