<?php

namespace App\Http\Controllers\Administration\Airline;

use App\Http\Controllers\Controller;
use App\Models\Administration\Airline\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $airlines = Airline::all();

        return view('admin.administrations.airlines.index',compact('airlines'));
    }

    public function create(){

        
        return view('admin.administrations.airlines.create');
    }

    public function store(Request $request){
      
        $airline = new Airline();

        $airline->code = $request->code;
        $airline->name = $request->name;
        $airline->type = $request->type;
       
        $airline->save();

        return redirect('/airlines/create')->withSuccess('Se ha registrado exitosamente!');
      
    }

    public function edit($id){

        $airline = Airline::find($id);

        return view('admin.administrations.airlines.edit',compact('airline'));
    }

    public function update(Request $request, $id)
    {
       
        $airline = Airline::findOrFail($id);

        $airline->code = $request->code;
        $airline->name = $request->name;
        $airline->type = $request->type;
        $airline->save();

        return redirect('/airlines')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
         $airline = Airline::find($request->id_airline_modal); 
 
         if(isset($airline)){
             
             $airline->delete();
     
             return redirect('/airlines')->withSuccess('Se ha Eliminado Correctamente!!');
         }
    }

}
