<?php

namespace App\Http\Controllers\Administration\Country;

use App\Http\Controllers\Controller;
use App\Models\Administration\Countries\Country;
use App\Models\Administration\Countries\MakingCode;
use App\Models\Administration\Countries\State;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function listCodePhone(Request $request, $id_country){
        //validar si la peticion es asincrona
        if($request->ajax()){
            try{
                $country = Country::select('id','name','code_phone')->where('id',$id_country)->get();

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
                $codes = MakingCode::select('id','code')->where('id_country',$id_country)->get();
                return response()->json($codes,200);
            }catch(Throwable $th){
                return response()->json(false,500);
            }
        }
        
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
