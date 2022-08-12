<?php

namespace App\Http\Controllers\AdministrationClient\Profile;

use App\Http\Controllers\Controller;
use App\Models\Administration\Agency;
use App\Models\Administration\Client;
use App\Models\Administration\Countries\Country;
use App\Models\Administration\Countries\MakingCode;
use App\Models\Administration\Countries\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user       =   auth()->user();

        $profile = Client::where('id',$user->id_client)->first();

        $countries = Country::orderBy('name','asc')->get();

        $agencies = Agency::orderBy('id','desc')->get();

        $making_codes = MakingCode::where('id_country',$profile->id_country)->orderBy('id','desc')->get();

        $states = State::where('id_country',$profile->states->countries['id'])->orderBy('id','desc')->get();
       
        return view('clients.profiles.index',compact('profile','countries','agencies','making_codes','states'));
    
    }


    public function store(Request $request)
    {
       
        $data = request()->validate([
            'email'                 =>'required|max:40',
            'type_cedula'           =>'required',
            'cedula'                =>'required',
           
            'firstname'             =>'required|max:30',
            'firstlastname'         =>'required|max:30',
           

            'id_country'            =>'required',
            'direction'             =>'required|max:50',
           
            'City'                  =>'required',
            'street_received'       =>'required',
            'urbanization_received' =>'required',

           
           
            
    
           
        ]);

        
        $user       =   auth()->user();

        $client = Client::findOrFail($user->id_client);

        
        $client->type_cedula            = $request->type_cedula;         
        $client->cedula                 = $request->cedula;
        
        $client->firstname              = $request->firstname;    
        $client->firstlastname          = $request->firstlastname;     
        $client->secondname             = $request->secondname;    
        $client->secondlastname         = $request->secondlastname;     

        $client->id_country             = $request->id_country;       
        $client->direction              = $request->direction;       
       
        $client->id_state_received      = $request->City;         
        $client->street_received        = $request->street_received;  
        $client->urbanization_received  = $request->urbanization_received;
    
    
        $client->type_direction_received= $request->type_direction_received;

        $client->id_agency              = $request->id_agency;  

        $client->id_code_room           = $request->id_code_room;  
        $client->id_code_work           = $request->id_code_work;  
        $client->id_code_mobile         = $request->id_code_mobile;  
        $client->id_code_fax            = $request->id_code_fax;  

       
        $client->phone_room             = $request->phone_room;  
        $client->phone_work             = $request->phone_work;  
        $client->phone_mobile           = $request->phone_mobile;  
        $client->phone_fax              = $request->phone_fax;  

        $client->company                = $request->company;  
        $client->rif                    = $request->rif;  
    
        $client->save();

        $user = User::findOrFail($user->id);

        $user->name = $request->firstname;
        $user->email = $request->email;
        if($request->password != ""){
            $user->password =  Hash::make(request('password'));
        }

        $user->save();

        
       
        return redirect('/profiles/index')->withSuccess('Se ha registrado exitosamente!');
       
    }
}
