<?php

namespace App\Http\Controllers\Administration\Country;

use App\Http\Controllers\Controller;
use App\Models\Administration\Countries\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $countries = Country::all();

        return view('admin.administrations.countries.index',compact('countries'));
    }

    public function create(){

        $countries = Country::all();

        return view('admin.administrations.countries.create',compact('countries'));
    }

    public function store(Request $request){

       
        $country = new Country();

        $country->abbreviation = $request->abbreviation;
        $country->code_phone = $request->code_phone;
        $country->name = $request->name;
        $country->save();

        return redirect('/countries/create')->withSuccess('Se ha registrado exitosamente!');
       
     }
 
     public function edit($id){
 
        $country = Country::find($id);
 
        return view('admin.administrations.countries.edit',compact('country'));
     }


     public function listCodePhone(Request $request, $id_country){
        //validar si la peticion es asincrona
        if($request->ajax()){
            try{
                $country = Country::/*on(Auth::user()->database_name)->*/select('id','name','code_phone')->where('id',$id_country)->orderBy('name','asc')->get();
                return response()->json($country,200);
            }catch(Throwable $th){
                return response()->json(false,500);
            }
        }
        
    }

    public function listMakingCodes(Request $request, $id_country){
        //validar si la peticion es asincrona
        if($request->ajax()){
            try{
                $codes = MakingCode::/*on(Auth::user()->database_name)->*/select('id','code')->where('id_country',$id_country)->orderBy('code','asc')->get();
                return response()->json($codes,200);
            }catch(Throwable $th){
                return response()->json(false,500);
            }
        }
        
    }

}
