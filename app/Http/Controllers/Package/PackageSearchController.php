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
        $shipping_type =null;
        $status = null;
        $agency_search = null;
        $wharehouse_search = null;

        if(isset($request->checks)){
            $shipping_type = $request->checks;
        }

        if(isset($request->status)){
            $status = $request->status;
        }
      
        $packages = $this->validation($request);
   

        if(isset($packages)){
            $agencyController = new AgencyController();
            foreach($packages as $package){
                $package->agency = $agencyController->returnAgencyById($package->id_agency);
            }
        }

        if(isset($request->id_agency)){
            $agency_search = Agency::find($request->id_agency);
        }

        if(isset($request->id_wharehouse)){
            $wharehouse_search = Wharehouse::find($request->id_wharehouse);
        }

        

       $agencies = Agency::orderBy('name','asc')->get();

       $wharehouses = Wharehouse::orderBy('name','asc')->get();
      
       return view('admin.packages.index',compact('packages','agencies','wharehouses','agency_search','wharehouse_search','shipping_type','status'));
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
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
            ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
            ->where('id_tula',null)
            ->where('id_paddle',null)
            ->where('id_agency_office_location',$request->id_agency)
            ->where('id_wharehouse',$request->id_wharehouse)
            ->where('instruction',$shipping_type)
            ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
            'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
            'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
            DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
            ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                    'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                    'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                    ,'wharehouses.name','agents.name')
            ->get();
        }else if(isset($request->id_agency)  && $shipping_type != "Todos"){
            $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
            ->leftJoin('clients','clients.id','packages.id_client')
            ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
            ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
            ->where('id_tula',null)
            ->where('id_paddle',null)
            ->where('id_agency_office_location',$request->id_agency)
            ->where('instruction',$shipping_type)
            ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
            'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
            'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
            DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
            ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                    'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                    'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                    ,'wharehouses.name','agents.name')
            ->get();
        }else if(isset($request->id_wharehouse)  && $shipping_type != "Todos"){
            $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
            ->leftJoin('clients','clients.id','packages.id_client')
            ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
            ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
            ->where('id_tula',null)
            ->where('id_paddle',null)
            ->where('id_wharehouse',$request->id_wharehouse)
            ->where('instruction',$shipping_type)
            ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
            'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
            'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
            DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
            ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                    'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                    'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                    ,'wharehouses.name','agents.name')
            ->get();
        }else if($shipping_type != "Todos"){
            $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
            ->leftJoin('clients','clients.id','packages.id_client')
            ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
            ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
            ->where('id_tula',null)
            ->where('id_paddle',null)
            ->where('instruction',$shipping_type)
            ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
            'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
            'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
            DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
            ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                    'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                    'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                    ,'wharehouses.name','agents.name')
            ->get();
        }else{
            $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
            ->leftJoin('clients','clients.id','packages.id_client')
            ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
            ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
            ->where('id_tula',null)
            ->where('id_paddle',null)
            ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
            'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
            'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
            DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
            ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                    'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                    'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                    ,'wharehouses.name','agents.name')
            ->get();
        }

        if(isset($request->id_agency) && isset($request->id_wharehouse)){
            $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
            ->leftJoin('clients','clients.id','packages.id_client')
            ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
            ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
            ->where('id_tula',null)
            ->where('id_paddle',null)
            ->where('id_agency_office_location',$request->id_agency)
            ->where('id_wharehouse',$request->id_wharehouse)
            ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
            'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
            'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
            DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
            ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                    'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                    'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                    ,'wharehouses.name','agents.name')
            ->get();
        }else{

            if(isset($request->id_agency)){
                
                $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
                ->leftJoin('clients','clients.id','packages.id_client')
                ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
                ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
                ->where('id_tula',null)
                ->where('id_paddle',null)
                ->where('id_agency_office_location',$request->id_agency)
                ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
                DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
                ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                        'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                        'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                        ,'wharehouses.name','agents.name')
                ->get();
               // dd($request->id_agency);
            }else if(isset($request->id_wharehouse)){
                $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
                ->leftJoin('clients','clients.id','packages.id_client')
                ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
                ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
                ->where('id_tula',null)
                ->where('id_paddle',null)
                ->where('id_wharehouse',$request->id_wharehouse)
                ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
                DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
                ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                        'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                        'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                        ,'wharehouses.name','agents.name')
                ->get();
            }else if(isset($request->client) && ($request->client != "")){
               
                $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
                ->leftJoin('clients','clients.id','packages.id_client')
                ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
                ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
                ->where('id_tula',null)
                ->where('id_paddle',null)
                ->where('clients.firstname','LIKE','%'.$request->client.'%')
                ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
                DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
                ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                        'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                        'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                        ,'wharehouses.name','agents.name')
                ->get();
            }

            

        if(isset($request->id_agency) && isset($request->id_wharehouse) 
        && $shipping_type != "Todos" && isset($status)){
        $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
        ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->where('id_agency_office_location',$request->id_agency)
        ->where('id_wharehouse',$request->id_wharehouse)
        ->where('instruction',$shipping_type)
        ->where('packages.status',$status)
        ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
        'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
        'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
        ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                ,'wharehouses.name','agents.name')
        ->get();
    }else if(isset($request->id_agency)  && $shipping_type != "Todos" && isset($status)){
        $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
        ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->where('id_agency_office_location',$request->id_agency)
        ->where('instruction',$shipping_type)
        ->where('packages.status',$status)
        ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
        'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
        'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
        ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                ,'wharehouses.name','agents.name')
        ->get();
    }else if(isset($request->id_wharehouse)  && $shipping_type != "Todos" && isset($status)){
        $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
        ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->where('id_wharehouse',$request->id_wharehouse)
        ->where('instruction',$shipping_type)
        ->where('packages.status',$status)
        ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
        'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
        'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
        ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                ,'wharehouses.name','agents.name')
        ->get();
    }else if(isset($request->id_agency) && isset($status)){
        
        $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
        ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->where('id_agency_office_location',$request->id_agency)
        ->where('packages.status',$status)
        ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
        'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
        'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
        ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                ,'wharehouses.name','agents.name')
        ->get();
        
    }else if($shipping_type != "Todos" && isset($status)){
        $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
        ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->where('instruction',$shipping_type)
        ->where('packages.status',$status)
        ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
        'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
        'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
        ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                ,'wharehouses.name','agents.name')
        ->get();
    }else if(isset($status)){
        $packages = Package::leftJoin('package_lumps','package_lumps.id_package','packages.id')
        ->leftJoin('clients','clients.id','packages.id_client')
        ->leftJoin('agencies','agencies.id','packages.id_agency_office_location')
                ->leftJoin('agents','agents.id','packages.id_agent_vendor')
                ->leftJoin('agents as agent_shipper','agent_shipper.id','packages.id_agent_shipper')
        ->leftJoin('wharehouses','wharehouses.id','packages.id_wharehouse')
        ->where('id_tula',null)
        ->where('id_paddle',null)
        ->where('packages.status','LIKE',"%".$status."%")
        ->select('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
        'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
        'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code as wharehouse_code','wharehouses.name as wharehouse_name','agents.name as agent_name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name as agency_name',
        DB::raw('COUNT(package_lumps.id_package) As count_package_lumps'))
        ->groupBy('packages.id','packages.id_agent_shipper','packages.id_agent_vendor','agent_shipper.name as agent_shipper_name',
                'packages.tracking','packages.status','clients.direction','clients.street_received','clients.urbanization_received','clients.casillero','clients.firstname','clients.firstlastname','clients.type_cedula','clients.id_agency','clients.cedula',
                'packages.description','packages.starting_weight','packages.final_weight','packages.arrival_date','wharehouses.code','wharehouses.name','packages.volume','packages.cubic_foot','packages.date_payment','packages.instruction','agencies.name'
                ,'wharehouses.name','agents.name')
        ->get(); 
    }
    }
    return $packages;
    }

}
