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

      
        $packages = $this->validation($request);
   

        if(isset($packages)){
            $agencyController = new AgencyController();
            foreach($packages as $package){
                $package->agency = $agencyController->returnAgencyById($package->id_agency);
            }
        }


       $agencies = Agency::orderBy('name','asc')->get();

       $wharehouses = Wharehouse::orderBy('name','asc')->get();
      
       return view('admin.packages.index',compact('packages','agencies','wharehouses','shipping_type','status'));
    }


    public function validation($request){

        if(isset($request->checks)){
            $shipping_type = $request->checks;
        }

        if(isset($request->status)){
            $status = $request->status;
        }



        if(isset($request->id_agency) && isset($request->id_wharehouse) && $shipping_type != "Todos"){
            $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
            ->leftJoin('clients','clients.id','packages.id_client')
            ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
            ->where('id_tula',null)
            ->where('id_paddle',null)
            ->where('id_agency_office_location',$request->id_agency)
            ->where('id_wharehouse',$request->id_wharehouse)
            ->where('instruction',$shipping_type)
            ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
            'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
            'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
            DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
            ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                    'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                    'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
            ->get();
        }else if(isset($request->id_agency)  && $shipping_type != "Todos"){
            $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
            ->leftJoin('clients','clients.id','packages.id_client')
            ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
            ->where('id_tula',null)
            ->where('id_paddle',null)
            ->where('id_agency_office_location',$request->id_agency)
            ->where('instruction',$shipping_type)
            ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
            'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
            'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
            DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
            ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                    'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                    'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
            ->get();
        }else if(isset($request->id_wharehouse)  && $shipping_type != "Todos"){
            $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
            ->leftJoin('clients','clients.id','packages.id_client')
            ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
            ->where('id_tula',null)
            ->where('id_paddle',null)
            ->where('id_wharehouse',$request->id_wharehouse)
            ->where('instruction',$shipping_type)
            ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
            'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
            'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
            DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
            ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                    'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                    'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
            ->get();
        }else if($shipping_type != "Todos"){
            $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
            ->leftJoin('clients','clients.id','packages.id_client')
            ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
            ->where('id_tula',null)
            ->where('id_paddle',null)
            ->where('instruction',$shipping_type)
            ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
            'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
            'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
            DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
            ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                    'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                    'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
            ->get();
        }else{
            $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
            ->leftJoin('clients','clients.id','packages.id_client')
            ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
            ->where('id_tula',null)
            ->where('id_paddle',null)
            ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
            'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
            'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
            DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
            ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                    'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                    'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
            ->get();
        }

        if(isset($request->id_agency) && isset($request->id_wharehouse)){
            $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
            ->leftJoin('clients','clients.id','packages.id_client')
            ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
            ->where('id_tula',null)
            ->where('id_paddle',null)
            ->where('id_agency_office_location',$request->id_agency)
            ->where('id_wharehouse',$request->id_wharehouse)
            ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
            'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
            'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
            DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
            ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                    'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                    'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
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
                'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
                DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
                ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                        'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                        'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
                ->get();
            }else if(isset($request->id_wharehouse)){
                $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
                ->leftJoin('clients','clients.id','packages.id_client')
                ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->where('id_tula',null)
                ->where('id_paddle',null)
                ->where('id_wharehouse',$request->id_wharehouse)
                ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
                DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
                ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                        'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                        'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
                ->get();
            }else if(isset($request->client) && ($request->client != "")){
               
                $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
                ->leftJoin('clients','clients.id','packages.id_client')
                ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->where('id_tula',null)
                ->where('id_paddle',null)
                ->where('clients.firstname','LIKE','%'.$request->client.'%')
                ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
                DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
                ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                        'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                        'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
                ->get();
            }

            

        if(isset($request->id_agency) && isset($request->id_wharehouse) 
        && $shipping_type != "Todos" && isset($status)){
        $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->where('id_agency_office_location',$request->id_agency)
        ->where('id_wharehouse',$request->id_wharehouse)
        ->where('instruction',$shipping_type)
        ->where('packages.status',$status)
        ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
        'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
        'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
        ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
        ->get();
    }else if(isset($request->id_agency)  && $shipping_type != "Todos" && isset($status)){
        $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->where('id_agency_office_location',$request->id_agency)
        ->where('instruction',$shipping_type)
        ->where('packages.status',$status)
        ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
        'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
        'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
        ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
        ->get();
    }else if(isset($request->id_wharehouse)  && $shipping_type != "Todos"&& isset($status)){
        $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->where('id_wharehouse',$request->id_wharehouse)
        ->where('instruction',$shipping_type)
        ->where('packages.status',$status)
        ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
        'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
        'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
        ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
        ->get();
    }else if($shipping_type != "Todos"&& isset($status)){
        $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->where('instruction',$shipping_type)
        ->where('packages.status',$status)
        ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
        'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
        'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
        ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
        ->get();
    }else if(isset($status)){
        $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->where('packages.status','LIKE',"%".$status."%")
        ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
        'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
        'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
        ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor',
                'packages.tracking','packages.status','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name')
        ->get(); 
    }
    }
    return $packages;
    }

}
