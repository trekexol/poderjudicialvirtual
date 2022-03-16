<?php

namespace App\Http\Controllers\Administration\Country;

use App\Http\Controllers\Controller;
use App\Models\Administration\Countries\State;
use App\Models\Administration\Countries\Country;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $cities = State::all();
       
        return view('admin.administrations.cities.index',compact('cities'));
    }

    public function create(){

        $countries = Country::all();

        return view('admin.administrations.cities.create',compact('countries'));
    }

    public function store(Request $request){
        $state = new State();

        $state->id_country = $request->id_country;
        $state->name = $request->name;
        $state->save();

        return redirect('/cities/create')->withSuccess('Se ha registrado exitosamente!');
    
    }

    public function list(Request $request, $id_country){
        //validar si la peticion es asincrona
        if($request->ajax()){
            try{
              
                $cities = State::select('id','name')->where('id_country',$id_country)->orderBy('name','asc')->get();
                return response()->json($cities,200);
            }catch(Throwable $th){
                return response()->json(false,500);
            }
        }
        
    }
}
