<?php

namespace App\Http\Controllers\MasterGuide;

use App\Http\Controllers\Controller;
use App\Models\Administration\Agency;
use App\Models\Administration\Airline\Airline;
use App\Models\MasterGuide\MasterGuide;
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
      
        $agencies = Agency::orderBy('id','desc')->get();

        $airlines = Airline::orderBy('id','desc')->get();

        return view('admin.master_guides.create',compact('master_guide','agencies','airlines'));
    
    }

    public function store(Request $request)
    {
       
        $master_guide = new MasterGuide();

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
