<?php

namespace App\Http\Controllers\Rate;

use App\Http\Controllers\Controller;
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

        return view('admin.national_rates.index',compact('national_rates'));
    }

    public function create(){

        $wharehouses = Wharehouse::all();

        return view('admin.national_rates.create',compact('wharehouses'));
    }

    public function store(Request $request){

      
        $national_rate = new NationalRate();

        $national_rate->id_wharehouse_origin = $request->id_wharehouse_origin;
        $national_rate->id_wharehouse_destination = $request->id_wharehouse_destination;
        $national_rate->weight_type = $request->weight_type;
        $national_rate->weight = $request->weight;
        $national_rate->price = $request->price;
        $national_rate->rate = $request->rate;

        $national_rate->save();

        return redirect('/national_rates/create')->withSuccess('Se ha registrado exitosamente!');
      
    }

    public function edit($id){

        $national_rate = NationalRate::find($id);

        return view('admin.national_rates.edit',compact('national_rate'));
    }
}
