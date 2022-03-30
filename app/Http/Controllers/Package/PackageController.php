<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Controller;
use App\Models\Administration\Agent;
use App\Models\Administration\Client;
use App\Models\Administration\Countries\Country;
use App\Models\Administration\DeliveryCompany;
use App\Models\Administration\TypeOfGood;
use App\Models\Administration\TypeOfPackaging;
use App\Models\Administration\Wharehouse;
use App\Models\Package\Package;
use App\Models\Package\PackageLump;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id_package = null)
    {
        if(isset($id_package)){
            $package = Package::find($id_package);

            $package_lumps = PackageLump::where('id_package',$package->id)->orderBy('id','asc')->get();

        }else{
            $package = null;
        }
        
        $agents = Agent::orderBy('name','asc')->get();

        $countries = Country::orderBy('name','asc')->get();

        $wharehouses = Wharehouse::orderBy('name','asc')->get();

        $delivery_companies = DeliveryCompany::orderBy('description','asc')->get();

        $type_of_goods = TypeOfGood::orderBy('description','asc')->get();

        $type_of_packagings = TypeOfPackaging::orderBy('description','asc')->get();

        $client = Client::find(1);


        return view('admin.packages.index',compact('package_lumps','package','client','agents','countries','wharehouses','delivery_companies','type_of_goods','type_of_packagings'));
    
    }

    public function store(Request $request)
    {
       
        $package = new Package();

        $package->id_client = $request->id_client;
        $package->tracking = $request->tracking;
        $package->id_agent_shipper = $request->id_agent_shipper;
        $package->id_agent_vendor = $request->id_agent_vendor;
        $package->arrival_date = $request->arrival_date;//+" "+$request->check_in;
        $package->id_agent_office_location = $request->id_agent_office_location;
        $package->id_wharehouse = $request->id_wharehouse;
        $package->content = $request->content;
        $package->value = $request->value;
        $package->id_origin_country = $request->id_origin_country;
        $package->id_destination_country = $request->id_destination_country;
        $package->id_delivery_company = $request->id_delivery_company;
        $package->number_transport_guide = $request->number_transport_guide;
        $package->service_type = $request->service_type;
        $package->instruction = $request->instruction;
        $package->instruction_type = $request->instruction_type;
        $package->description = $request->description;

       
        if(isset($request->checks)){
            foreach($request->checks as $check){
                if($check == "high_value"){
                    $package->high_value = true;
                }
                if($check == "dangerous_goods"){
                    $package->dangerous_goods = true;
                }
                if($check == "sed"){
                    $package->sed = true;
                }
                if($check == "document"){
                    $package->document = true;
                }
                if($check == "fragile"){
                    $package->fragile = true;
                }
            }
        }
       
        $package->save();
       

        return redirect('/packages/'.$package->id.'')->withSuccess('Se ha registrado exitosamente!');
       
    }
 
}
