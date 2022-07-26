<?php

namespace App\Http\Controllers\AdministrationClient\ClientRecipient;

use App\Http\Controllers\Controller;
use App\Models\Administration\Countries\Country;
use App\Models\AdministrationClient\ClientRecipient;
use Illuminate\Http\Request;

class ClientRecipientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
      
        $client_recipients = ClientRecipient::orderBy('id','desc')->get();
       
        return view('clients.client_recipients.index',compact('client_recipients'));
    
    }

    public function create()
    {
        if(isset($id)){
            $client_recipient = ClientRecipient::findOrFail($id);
        }else{
            $client_recipient = null;
        }

        $countries = Country::all();

        return view('clients.client_recipients.create',compact('client_recipient','countries'));
    
    }

    public function store(Request $request)
    {
        $user       =   auth()->user();
        $client_recipient = new ClientRecipient();

        $client_recipient->id_client = $user->id_client;
        $client_recipient->id_country = $request->id_country;
        $client_recipient->name = $request->name;
        $client_recipient->identification_card = $request->identification_card;
        $client_recipient->direction1 = $request->direction;
        $client_recipient->direction2 = $request->direction2;
        $client_recipient->phone = $request->phone;
        $client_recipient->email = $request->email;
        $client_recipient->observation = $request->observation;

        $client_recipient->status = 'Activo';
      
        $client_recipient->save();

        return redirect('/client_recipients/index')->withSuccess('Se ha registrado exitosamente!');
       
    }

    public function edit($id)
    {
        if(isset($id)){
            $client_recipient = ClientRecipient::findOrFail($id);
        }else{
            $client_recipient = null;
        }

        $countries = Country::all();

        return view('clients.client_recipients.edit',compact('client_recipient','countries'));
    
    }


    public function update(Request $request, $id)
    {
        
        $client_recipient = ClientRecipient::findOrFail($id);

        $client_recipient->id_country = $request->id_country;
        $client_recipient->name = $request->name;
        $client_recipient->identification_card = $request->identification_card;
        $client_recipient->direction1 = $request->direction;
        $client_recipient->direction2 = $request->direction2;
        $client_recipient->phone = $request->phone;
        $client_recipient->email = $request->email;
        $client_recipient->observation = $request->observation;


        $client_recipient->save();

        return redirect('/client_recipients/index')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
        $client_recipient = ClientRecipient::find($request->id_client_recipient_modal); 

        if(isset($client_recipient)){
            
            $client_recipient->delete();
    
            return redirect('/client_recipients/index')->withSuccess('Se ha Eliminado Correctamente!!');
        }
    }
}
