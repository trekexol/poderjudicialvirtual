<?php

namespace App\Http\Controllers\Client;

use App\Models\Client;
use App\Models\Countries\Country;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function register()
    {
        $countries = Country::orderBy('name','asc')->get();

        $agencies = Agency::orderBy('id','desc')->get();

        return view('clients.register.client_register',compact('countries','agencies'));
    
    }

    public function store(Request $request)
    {
        dd($request);
        $data = request()->validate([
            'email'                 =>'required|max:40',
            'type_cedula'           =>'required',
            'cedula'                =>'required',
            'password'              =>'required|min:6|max:20',
            'confirm_password'      =>'required|min:6|max:20',
            'firstname'             =>'required|max:30',
            'firstlastname'         =>'required|max:30',
           

            'id_country'            =>'required',
            'direction'             =>'required|max:50',
           
            'City'                  =>'required',
            'street_received'       =>'required',
            'urbanization_received' =>'required',
           
            
    
           
        ]);

        $client = new Client();

       
        $client->type_cedula            = $request->type_cedula;         
        $client->cedula                 = $request->cedula;
        
        $client->firstname              = $request->firstname;    
        $client->firstlastname          = $request->firstlastname;     
        $client->secondname             = $request->secondname;    
        $client->secondlastname         = $request->secondlastname;     

        $client->id_country             = $request->id_country;       
        $client->direction              = $request->direction;       
       
        $client->id_city_received       = $request->City;         
        $client->street_received        = $request->street_received;  
        $client->urbanization_received  = $request->urbanization_received;
    
        if(isset($request->this_direction)){
            $type = "this Direction";
        }elseif(isset($request->agency_direction)){
            $type = "Agency Direction";
        }
        $client->type_direction_received= $type;

        $client->id_agency              = $request->id_agency;  

        $client->id_code_room           = $request->id_code_room;  
        $client->id_code_work           = $request->id_code_work;  
        $client->id_code_mobile         = $request->id_code_mobile;  
        $client->id_code_fax            = $request->id_code_fax;  

        $client->phone_room           = $request->phone_room;  
        $client->phone_work           = $request->phone_work;  
        $client->phone_mobile         = $request->phone_mobile;  
        $client->phone_fax            = $request->phone_fax;  
    
        $client->save();
    
    }
}
