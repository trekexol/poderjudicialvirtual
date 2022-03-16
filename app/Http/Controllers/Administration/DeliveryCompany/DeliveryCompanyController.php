<?php

namespace App\Http\Controllers\Administration\DeliveryCompany;

use App\Http\Controllers\Controller;
use App\Models\Administration\DeliveryCompany;
use Illuminate\Http\Request;

class DeliveryCompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $delivery_companies = DeliveryCompany::all();

        return view('admin.administrations.delivery_companies.index',compact('delivery_companies'));
    }

    public function create(){
       
        return view('admin.administrations.delivery_companies.create');
    }

    public function store(Request $request)
    {
        $delivery_company = new DeliveryCompany();

        $delivery_company->code = $request->code;
        $delivery_company->description = $request->description;
        $delivery_company->save();

        return redirect('/delivery_companies/create')->withSuccess('Se ha registrado exitosamente!');
       
     }
 
    public function edit($id)
    {
        $delivery_company = DeliveryCompany::find($id);
 
        return view('admin.administrations.delivery_companies.edit',compact('delivery_company'));
    }

    public function update(Request $request, $id)
    {
  
        $delivery_company = DeliveryCompany::findOrFail($id);

        $delivery_company->code = $request->code;
        $delivery_company->description = $request->description;
        $delivery_company->save();

        return redirect('/delivery_companies')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
         $delivery_company = DeliveryCompany::find($request->id_delivery_company_modal); 
 
         if(isset($delivery_company)){
             
             $delivery_company->delete();
     
             return redirect('/delivery_companies')->withSuccess('Se ha Eliminado Correctamente!!');
         }
    }

}

