<?php

namespace App\Http\Controllers\MasterGuide;

use App\Http\Controllers\Controller;
use App\Models\Administration\Agency;
use App\Models\Administration\Agent;
use App\Models\Administration\Airline\Airline;
use App\Models\MasterGuide\MasterGuide;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MasterGuideController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
      
        $master_guides = MasterGuide::orderBy('id','desc')->get();
       
        return view('admin.master_guides.index',compact('master_guides'));
    
    }

    public function create($id = null)
    {
        if(isset($id)){
            $master_guide = MasterGuide::findOrFail($id);
        }else{
            $master_guide = null;
        }

        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');   

        $agencies = Agency::orderBy('id','desc')->get();

        $airlines = Airline::orderBy('id','desc')->get();

        $carrier_agents = Agent::where('type','Transportista')->orderBy('name','desc')->get();

        $consignee_agents = Agent::where('type','Consignatario')->orderBy('name','desc')->get();

        $transmitter_agents = Agent::where('type','Emisor')->orderBy('name','desc')->get();

        $position_agents = Agent::where('type','Cargo')->orderBy('name','desc')->get();

        return view('admin.master_guides.create',compact('datenow','master_guide','agencies','airlines','carrier_agents','consignee_agents','transmitter_agents','position_agents'));
    
    }

    public function store(Request $request)
    {
       
        $master_guide = new MasterGuide();

        $master_guide->id_office_agency = $request->id_office_agency;
        $master_guide->reference = $request->reference;
        $master_guide->id_airline = $request->id_airline;
        $master_guide->id_carrier_agent = $request->id_carrier_agent;
        $master_guide->knowledge_number = $request->knowledge_number;
        $master_guide->id_consignee_agent = $request->id_consignee_agent;
        $master_guide->amount = str_replace(',', '.', str_replace('.', '', $request->amount));
        $master_guide->id_transmitter_agent = $request->id_transmitter_agent;
        $master_guide->weight_unit = $request->weight_unit;
        $master_guide->id_position_agent = $request->id_position_agent;
        $master_guide->net_weight = $request->net_weight;
        $master_guide->loadable_weight =str_replace(',', '.', str_replace('.', '',$request->loadable_weight));
        
        if($request->contains_dangerous_goods == 'Yes'){
            $master_guide->contains_dangerous_goods = true;
        }else{
            $master_guide->contains_dangerous_goods = false;
        }
        
        $master_guide->destination_airport = $request->destination_airport;
        $master_guide->flight = $request->flight;
        $master_guide->flight_date = $request->flight_date;
        $master_guide->handing_information = $request->handing_information;
        $master_guide->nature_and_quanty_of_goods = $request->nature_and_quanty_of_goods;
        $master_guide->extra_information = $request->extra_information;
        $master_guide->extra_information2 = $request->extra_information2;

        $master_guide->status = 'Activo';
        $master_guide->save();

        return redirect('/master_guides/create/'.$master_guide->id.'')->withSuccess('Se ha registrado exitosamente!');
       
    }
    public function update(Request $request, $id)
    {
        
        $master_guide = MasterGuide::findOrFail($id);

       
        $master_guide->id_office_agency = $request->id_office_agency;
        $master_guide->id_agent = $request->id_agent;
        $master_guide->id_destination_state = $request->id_destination_state;
        $master_guide->cubic_foot = str_replace(',', '.', str_replace('.', '', $request->cubic_foot));
        $master_guide->dimension_width = str_replace(',', '.', str_replace('.', '', $request->dimension_width));
        $master_guide->dimension_length = str_replace(',', '.', str_replace('.', '', $request->dimension_length));
        $master_guide->dimension_high = str_replace(',', '.', str_replace('.', '', $request->dimension_high));
        $master_guide->volume = str_replace(',', '.', str_replace('.', '', $request->volume));
        $master_guide->weight = str_replace(',', '.', str_replace('.', '', $request->weight));
        $master_guide->loadable_weight = str_replace(',', '.', str_replace('.', '', $request->loadable_weight));
        $master_guide->volume = str_replace(',', '.', str_replace('.', '', $request->volume));
        $master_guide->type_of_service = $request->type_of_service;
        $master_guide->class = $request->class;
        $master_guide->loose_packages = $request->loose_packages;
        $master_guide->reference = $request->reference;
        $master_guide->record = $request->record;
        $master_guide->number_of_packages = str_replace(',', '.', str_replace('.', '', $request->number_of_packages));
        

        $master_guide->save();

        return redirect('/master_guides/create/'.$master_guide->id.'')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
        $master_guide = MasterGuide::find($request->id_master_guide_modal); 

        if(isset($master_guide)){
            
            $master_guide->delete();
    
            return redirect('/master_guides')->withSuccess('Se ha Eliminado Correctamente!!');
        }
    }
}
