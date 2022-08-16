<?php

namespace App\Http\Controllers\ClientRecipientPackage;

use App\Http\Controllers\Controller;
use App\Models\Administration\Countries\Country;
use App\Models\AdministrationClient\ClientRecipient;
use App\Models\Package\Package;
use Illuminate\Http\Request;

class ClientRecipientPackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function register($id_package)
    {
      

        $package = Package::where('id_client',$id_package)->first();
        $client_recipients = null;

        if(isset($package)){
            $client_recipients = ClientRecipient::where('id_client',$package->id_client)->orderBy('id','desc')->get();
        }else{
            return redirect('/packages/index')->withDanger('No se encuentra el paquete !!');
        }

        $countries = Country::all();

        return view('admin.client_recipients.register_package',compact('client_recipients','package','countries'));
    
    }

    public function create($id_package)
    {
      
        $package = Package::where('id_client',$id_package)->first();
        $countries = Country::orderBy('name','asc')->get();

        return view('admin.client_recipients.create',compact('package','countries'));
    
    }

   

    public function store(Request $request)
    {

        $package = Package::findOrFail($request->id_package);

        $package->id_client_recipient = $request->id_client_recipient;
       
        $package->save();

        return redirect('/packages/create/'.$package->id.'')->withSuccess('Se ha Guardado el destino del paquete exitosamente!');
       
    }

    public function storeNew(Request $request)
    {
        
        $user       =   auth()->user();
        $client_recipient = new ClientRecipient();

        $package = Package::findOrFail($request->id_package);

        $client_recipient->id_client = $package->id_client;
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

        

        $package->id_client_recipient = $client_recipient->id;
       
        $package->save();

        return redirect('/packages/create/'.$request->id_package.'')->withSuccess('Se ha Guardado el destino del paquete exitosamente!');
       
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
