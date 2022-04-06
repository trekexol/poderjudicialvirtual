<?php

namespace App\Http\Controllers\Administration\Agent;

use App\Http\Controllers\Controller;
use App\Models\Administration\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $agents = Agent::all();

        return view('admin.administrations.agents.index',compact('agents'));
    }

    public function create(){
       
        return view('admin.administrations.agents.create');
    }

    public function store(Request $request)
    {
        $agent = new Agent();

        $agent->code = $request->code;
        $agent->name = $request->name;
        $agent->type = $request->type;
        $agent->direction = $request->direction;
        $agent->phone = $request->phone;
        $agent->email = $request->email;
        $agent->contact_person = $request->contact_person;
      
        $agent->save();

        return redirect('/agents/create')->withSuccess('Se ha registrado exitosamente!');
       
    }
 
    public function edit($id)
    {
        $agent = Agent::find($id);
 
        return view('admin.administrations.agents.edit',compact('agent'));
    }

    public function update(Request $request, $id)
    {
  
        $agent = Agent::findOrFail($id);

        $agent->code = $request->code;
        $agent->name = $request->name;
        $agent->type = $request->type;
        $agent->direction = $request->direction;
        $agent->phone = $request->phone;
        $agent->email = $request->email;
        $agent->contact_person = $request->contact_person;

        $agent->save();

        return redirect('/agents')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
         $agent = Agent::find($request->id_agent_modal); 
 
         if(isset($agent)){
             
             $agent->delete();
     
             return redirect('/agents')->withSuccess('Se ha Eliminado Correctamente!!');
         }
    }

}

