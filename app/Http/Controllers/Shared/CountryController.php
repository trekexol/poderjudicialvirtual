<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\Countries\Country;
use App\Models\Countries\MakingCode;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    
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
