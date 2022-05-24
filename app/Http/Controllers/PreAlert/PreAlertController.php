<?php

namespace App\Http\Controllers\PreAlert;

use App\Http\Controllers\Controller;
use App\Models\Administration\Client;
use App\Models\PreAlert\PreAlert;
use Illuminate\Http\Request;

class PreAlertController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
      
        $pre_alerts = PreAlert::orderBy('id','desc')->get();
       
        return view('admin.pre_alerts.index',compact('pre_alerts'));
    
    }

    public function create($id = null)
    {
        if(isset($id)){
            $pre_alert = PreAlert::findOrFail($id);
        }else{
            $pre_alert = null;
        }
      
        $clients = Client::orderBy('firstname','desc')->get();

       
        return view('admin.pre_alerts.create',compact('pre_alert','clients'));
    
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

        return redirect('/pre_alerts/index')->withSuccess('Se ha registrado exitosamente!');
       
    }
    public function update(Request $request, $id)
    {
        
        $pre_alert = PreAlert::findOrFail($id);

       
        $pre_alert->id_office_agency = $request->id_office_agency;
        $pre_alert->id_agent = $request->id_agent;
        $pre_alert->id_destination_state = $request->id_destination_state;
        $pre_alert->cubic_foot = str_replace(',', '.', str_replace('.', '', $request->cubic_foot));
        $pre_alert->dimension_width = str_replace(',', '.', str_replace('.', '', $request->dimension_width));
        $pre_alert->dimension_length = str_replace(',', '.', str_replace('.', '', $request->dimension_length));
        $pre_alert->dimension_high = str_replace(',', '.', str_replace('.', '', $request->dimension_high));
        $pre_alert->volume = str_replace(',', '.', str_replace('.', '', $request->volume));
        $pre_alert->weight = str_replace(',', '.', str_replace('.', '', $request->weight));
        $pre_alert->loadable_weight = str_replace(',', '.', str_replace('.', '', $request->loadable_weight));
        $pre_alert->volume = str_replace(',', '.', str_replace('.', '', $request->volume));
        $pre_alert->type_of_service = $request->type_of_service;
        $pre_alert->class = $request->class;
        $pre_alert->loose_packages = $request->loose_packages;
        $pre_alert->reference = $request->reference;
        $pre_alert->record = $request->record;
        $pre_alert->number_of_packages = str_replace(',', '.', str_replace('.', '', $request->number_of_packages));
        

        $pre_alert->save();

        return redirect('/pre_alerts/create/'.$pre_alert->id.'')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
        $pre_alert = PreAlert::find($request->id_pre_alert_modal); 

        if(isset($pre_alert)){
            
            $pre_alert->delete();
    
            return redirect('/pre_alerts')->withSuccess('Se ha Eliminado Correctamente!!');
        }
    }
}
