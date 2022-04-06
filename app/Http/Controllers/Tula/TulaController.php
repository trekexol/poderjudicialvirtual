<?php

namespace App\Http\Controllers\Tula;

use App\Http\Controllers\Controller;
use App\Models\Administration\Agency;
use App\Models\Administration\Agent;
use App\Models\Administration\Countries\State;
use App\Models\Tula\Tula;
use Illuminate\Http\Request;

class TulaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
      
        $tulas = Tula::orderBy('id','desc')->get();
       
        return view('admin.tulas.index',compact('tulas'));
    
    }

    public function create($id = null)
    {
        if(isset($id)){
            $tula = Tula::findOrFail($id);
        }else{
            $tula = null;
        }
      
        $agencies = Agency::orderBy('id','desc')->get();

        $agents = Agent::orderBy('id','desc')->get();

        $states = State::orderBy('id','desc')->get();
       
        return view('admin.tulas.create',compact('tula','agencies','agents','states'));
    
    }

    public function store(Request $request)
    {
       
        $tula = new Tula();

        $tula->id_office_agency = $request->id_office_agency;
        $tula->id_agent = $request->id_agent;
        $tula->id_destination_state = $request->id_destination_state;
        $tula->cubic_foot = str_replace(',', '.', str_replace('.', '', $request->cubic_foot));
        $tula->dimension_width = str_replace(',', '.', str_replace('.', '', $request->dimension_width));
        $tula->dimension_length = str_replace(',', '.', str_replace('.', '', $request->dimension_length));
        $tula->dimension_high = str_replace(',', '.', str_replace('.', '', $request->dimension_high));
        $tula->volume = str_replace(',', '.', str_replace('.', '', $request->volume));
        $tula->weight = str_replace(',', '.', str_replace('.', '', $request->weight));
        $tula->loadable_weight = str_replace(',', '.', str_replace('.', '', $request->loadable_weight));
        $tula->volume = str_replace(',', '.', str_replace('.', '', $request->volume));
        $tula->type_of_service = $request->type_of_service;
        $tula->class = $request->class;
        $tula->loose_packages = $request->loose_packages;
        $tula->reference = $request->reference;
        $tula->record = $request->record;
        $tula->number_of_packages = str_replace(',', '.', str_replace('.', '', $request->number_of_packages));
        
        $tula->save();

        return redirect('/tulas/create/'.$tula->id.'')->withSuccess('Se ha registrado exitosamente!');
       
    }
    public function update(Request $request, $id)
    {
        
        $tula = Tula::findOrFail($id);

       
        $tula->id_office_agency = $request->id_office_agency;
        $tula->id_agent = $request->id_agent;
        $tula->id_destination_state = $request->id_destination_state;
        $tula->cubic_foot = str_replace(',', '.', str_replace('.', '', $request->cubic_foot));
        $tula->dimension_width = str_replace(',', '.', str_replace('.', '', $request->dimension_width));
        $tula->dimension_length = str_replace(',', '.', str_replace('.', '', $request->dimension_length));
        $tula->dimension_high = str_replace(',', '.', str_replace('.', '', $request->dimension_high));
        $tula->volume = str_replace(',', '.', str_replace('.', '', $request->volume));
        $tula->weight = str_replace(',', '.', str_replace('.', '', $request->weight));
        $tula->loadable_weight = str_replace(',', '.', str_replace('.', '', $request->loadable_weight));
        $tula->volume = str_replace(',', '.', str_replace('.', '', $request->volume));
        $tula->type_of_service = $request->type_of_service;
        $tula->class = $request->class;
        $tula->loose_packages = $request->loose_packages;
        $tula->reference = $request->reference;
        $tula->record = $request->record;
        $tula->number_of_packages = str_replace(',', '.', str_replace('.', '', $request->number_of_packages));
        

        $tula->save();

        return redirect('/tulas/create/'.$tula->id.'')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
        $tula = Tula::find($request->id_tula_modal); 

        if(isset($tula)){
            
            $tula->delete();
    
            return redirect('/tulas')->withSuccess('Se ha Eliminado Correctamente!!');
        }
    }

}
