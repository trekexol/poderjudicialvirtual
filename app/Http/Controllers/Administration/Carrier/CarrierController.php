<?php

namespace App\Http\Controllers\Administration\Carrier;

use App\Http\Controllers\Controller;
use App\Models\Administration\Carrier;
use Illuminate\Http\Request;

class CarrierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $carriers = Carrier::all();

        return view('admin.administrations.carriers.index',compact('carriers'));
    }

    public function create(){
       
        return view('admin.administrations.carriers.create');
    }

    public function store(Request $request)
    {
        $carrier = new Carrier();

        $carrier->code = $request->code;
        $carrier->name = $request->name;
        $carrier->type = $request->type;
        $carrier->save();

        return redirect('/carriers/create')->withSuccess('Se ha registrado exitosamente!');
       
     }
 
    public function edit($id)
    {
        $carrier = Carrier::find($id);
 
        return view('admin.administrations.carriers.edit',compact('carrier'));
    }

    public function update(Request $request, $id)
    {
  
        $carrier = Carrier::findOrFail($id);

        $carrier->code = $request->code;
        $carrier->name = $request->name;
        $carrier->type = $request->type;
        $carrier->save();

        return redirect('/carriers')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
         $carrier = Carrier::find($request->id_carrier_modal); 
 
         if(isset($carrier)){
             
             $carrier->delete();
     
             return redirect('/carriers')->withSuccess('Se ha Eliminado Correctamente!!');
         }
    }

}

