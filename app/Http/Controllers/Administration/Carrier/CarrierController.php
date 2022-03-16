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

        $delivery_companies = Carrier::all();

        return view('admin.administrations.delivery_companies.index',compact('delivery_companies'));
    }

    public function create(){
       
        return view('admin.administrations.delivery_companies.create');
    }

    public function store(Request $request)
    {
        $delivery_company = new Carrier();

        $delivery_company->code = $request->code;
        $delivery_company->description = $request->description;
        $delivery_company->save();

        return redirect('/delivery_companies/create')->withSuccess('Se ha registrado exitosamente!');
       
     }
 
    public function edit($id)
    {
        $delivery_company = Carrier::find($id);
 
        return view('admin.administrations.delivery_companies.edit',compact('delivery_company'));
    }

    public function update(Request $request, $id)
    {
  
        $delivery_company = Carrier::findOrFail($id);

        $delivery_company->code = $request->code;
        $delivery_company->description = $request->description;
        $delivery_company->save();

        return redirect('/delivery_companies')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
         $delivery_company = Carrier::find($request->id_delivery_company_modal); 
 
         if(isset($delivery_company)){
             
             $delivery_company->delete();
     
             return redirect('/delivery_companies')->withSuccess('Se ha Eliminado Correctamente!!');
         }
    }

}

