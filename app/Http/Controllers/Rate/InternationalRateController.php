<?php

namespace App\Http\Controllers\Rate;

use App\Http\Controllers\Controller;
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

        return view('admin.international_rates.index',compact('international_rates'));
    }

    public function create(){

        $wharehouses = Wharehouse::all();

        return view('admin.international_rates.create',compact('wharehouses'));
    }

    public function store(Request $request){

        $international_rate = new InternationalRate();

        $international_rate->id_wharehouse_origin = $request->id_wharehouse_origin;
        $international_rate->id_wharehouse_destination = $request->id_wharehouse_destination;
        $international_rate->weight_type = $request->weight_type;
        $international_rate->weight = $request->weight;
        $international_rate->price = $request->price;
        $international_rate->rate = $request->rate;

        $international_rate->save();

        return redirect('/international_rates/create')->withSuccess('Se ha registrado exitosamente!');
      
    }

    public function edit($id){

        $international_rate = InternationalRate::find($id);

        return view('admin.international_rates.edit',compact('international_rate'));
    }
}
