<?php

namespace App\Http\Controllers\Administration\Rate;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Global\BcvController;
use App\Models\Administration\Client;
use App\Models\Administration\Countries\State;
use App\Models\Administration\Rate\NationalRate;
use App\Models\Administration\Wharehouse;
use Illuminate\Http\Request;

class NationalRateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $national_rates = NationalRate::all();

        return view('admin.administrations.national_rates.index',compact('national_rates'));
    }

    public function create(){

        $wharehouses = Wharehouse::all();
        $clients = Client::all();
        $states = State::all();
        $bcv = 0;

        $bcvController = new BcvController();

        $bcv = $bcvController->search_bcv();

        return view('admin.administrations.national_rates.create',compact('wharehouses','clients','states','bcv'));
    }

    public function store(Request $request){

        
        $national_rate = new NationalRate();

        if(isset($request->id_wharehouse_origin)){
            $national_rate->id_wharehouse_origin = $request->id_wharehouse_origin;
        }
        if(isset($request->id_wharehouse_destination)){
            $national_rate->id_wharehouse_destination = $request->id_wharehouse_destination;
        }

        if(isset($request->id_state_origin)){
            $national_rate->id_state_origin = $request->id_state_origin;
        }
        if(isset($request->id_state_destination)){
            $national_rate->id_state_destination = $request->id_state_destination;
        }

        if(isset($request->id_client_origin)){
            $national_rate->id_client_origin = $request->id_client_origin;
        }
        if(isset($request->id_client_destination)){
            $national_rate->id_client_destination = $request->id_client_destination;
        }
        
        $national_rate->weight_type = $request->weight_type;
        $national_rate->minimum_weight = $request->minimum_weight;
        $national_rate->maximum_weight = $request->maximum_weight;

        $price = str_replace(',', '.', str_replace('.', '', $request->price));
        $rate = str_replace(',', '.', str_replace('.', '', $request->rate));

        if($request->coin == "Dolares"){
            $national_rate->price = $price * $rate;
        }else{
            $national_rate->price = $price;
        }
       
        $national_rate->rate = $rate;

        $national_rate->save();

        return redirect('/national_rates/create')->withSuccess('Se ha registrado exitosamente!');
      
    }

    public function edit($id){

        $national_rate = NationalRate::find($id);

        return view('admin.administrations.national_rates.edit',compact('national_rate'));
    }
}
