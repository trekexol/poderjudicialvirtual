<?php

namespace App\Http\Controllers\Administration\Rate;

use App\Http\Controllers\Controller;
use App\Models\Administration\Client;
use App\Models\Administration\Countries\State;
use App\Models\Administration\Rate\InternationalRate;
use App\Models\Administration\Wharehouse;
use Illuminate\Http\Request;

class InternationalRateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $international_rates = InternationalRate::all();

        return view('admin.administrations.international_rates.index',compact('international_rates'));
    }

    public function create(){

        $wharehouses = Wharehouse::all();
        $clients = Client::all();
        $states = State::all();

        return view('admin.administrations.international_rates.create',compact('wharehouses','clients','states'));
    }

    public function store(Request $request){

        $international_rate = new InternationalRate();

        $international_rate->id_wharehouse_origin = $request->id_wharehouse_origin;
        $international_rate->id_wharehouse_destination = $request->id_wharehouse_destination;
        $international_rate->weight_type = $request->weight_type;
        $international_rate->shipping_type = $request->shipping_type;
        $international_rate->minimum_weight = $request->minimum_weight;
        $international_rate->maximum_weight = $request->maximum_weight;
        $international_rate->price = $request->price;
        $international_rate->rate = $request->rate;

        $international_rate->save();

        return redirect('/international_rates/create')->withSuccess('Se ha registrado exitosamente!');
      
    }

    public function edit($id){

        $international_rate = InternationalRate::find($id);

        return view('admin.administrations.international_rates.edit',compact('international_rate'));
    }

    public function list(Request $request, $weight){
        //validar si la peticion es asincrona
        if($request->ajax()){
            try{
                /*$country = Country::select('id','name','code_phone')->where('id',$weight)->get();

                return response()->json($country,200);*/
                
            }catch(Throwable $th){
                return response()->json(false,500);
            }
        }
        
    }
}
