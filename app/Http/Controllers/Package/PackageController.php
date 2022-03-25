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
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        $agents = Agent::orderBy('name','asc')->get();

        $countries = Country::orderBy('name','asc')->get();

        $wharehouses = Wharehouse::orderBy('name','asc')->get();

        $delivery_companies = DeliveryCompany::orderBy('description','asc')->get();

        $type_of_goods = TypeOfGood::orderBy('description','asc')->get();

        $type_of_packagings = TypeOfPackaging::orderBy('description','asc')->get();

        $client = Client::find(1);

        return view('admin.packages.index',compact('client','agents','countries','wharehouses','delivery_companies','type_of_goods','type_of_packagings'));
    
    }

    public function store(Request $request)
    {
        dd($request);

        $package = new Package();

        $package->code = $request->code;
        $package->name = $request->name;
        $package->type = $request->type;
        $package->save();

        return redirect('/packages/create')->withSuccess('Se ha registrado exitosamente!');
       
     }
 
}
