<?php

namespace App\Http\Controllers\AdministrationClient\PreAlert;

use App\Http\Controllers\Controller;
use App\Models\PreAlert\PreAlert;
use Illuminate\Http\Request;

class ClientPreAlertController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user       =   auth()->user();
        $client_pre_alerts = PreAlert::where('id_client',$user->id_client)->orderBy('id','desc')->get();
       
        return view('clients.pre_alerts.index',compact('client_pre_alerts'));
    
    }

    public function create($id = null)
    {
        if(isset($id)){
            $client_pre_alert = PreAlert::findOrFail($id);
        }else{
            $client_pre_alert = null;
        }
      
        return view('clients.pre_alerts.create',compact('client_pre_alert'));
    
    }

    public function store(Request $request)
    {
      
        $pre_alert = new PreAlert();

        $pre_alert->id_client = $request->id_client;
        $pre_alert->tracking = $request->tracking;
        $pre_alert->shipping_type = $request->shipping_type;
      
        $pre_alert->origin_web = $request->origin_web;
        $pre_alert->transport_company = $request->transport_company;
        $pre_alert->package_content = $request->package_content;
        $pre_alert->package_remarks = $request->package_remarks;

        $pre_alert->status = 'Activo';
      
        $pre_alert->save();

        dd("eo");

        return redirect('/client_pre_alerts/index')->withSuccess('Se ha registrado exitosamente!');
       
    }
    public function update(Request $request, $id)
    {
        
        $pre_alert = PreAlert::findOrFail($id);

       
        $pre_alert->id_client = $request->id_client;
        $pre_alert->tracking = $request->tracking;
        $pre_alert->shipping_type = $request->shipping_type;
      
        $pre_alert->origin_web = $request->origin_web;
        $pre_alert->transport_company = $request->transport_company;
        $pre_alert->package_content = $request->package_content;
        $pre_alert->package_remarks = $request->package_remarks;
        

        $pre_alert->save();
      
        
        return redirect('/client_pre_alert/create/'.$pre_alert->id.'')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
        $pre_alert = PreAlert::find($request->id_pre_alert_modal); 

        if(isset($pre_alert)){
            
            $pre_alert->delete();
    
            return redirect('/client_pre_alerts')->withSuccess('Se ha Eliminado Correctamente!!');
        }
    }
}
