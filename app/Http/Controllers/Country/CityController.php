<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\Countries\City;
use App\Models\Countries\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $cities = City::all();
       
        return view('admin.cities.index',compact('cities'));
    }

    public function create(){

        $countries = Country::all();

        return view('admin.cities.create',compact('countries'));
    }

    public function store(Request $request){
        $city = new City();

        $city->id_country = $request->id_country;
        $city->name = $request->name;
        $city->save();

        return redirect('/cities/create')->withSuccess('Se ha registrado exitosamente!');
    
    }

    public function list(Request $request, $id_country){
        //validar si la peticion es asincrona
        if($request->ajax()){
            try{
              
                $cities = City::select('id','name')->where('id_country',$id_country)->orderBy('name','asc')->get();
                return response()->json($cities,200);
            }catch(Throwable $th){
                return response()->json(false,500);
            }
        }
        
    }
}
