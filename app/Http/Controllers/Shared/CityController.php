<?php

namespace App\Http\Controllers\Shared;

use App\Models\Countries\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
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
