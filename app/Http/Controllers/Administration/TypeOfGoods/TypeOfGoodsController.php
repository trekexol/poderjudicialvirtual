<?php

namespace App\Http\Controllers\Administration\TypeOfGoods;

use App\Http\Controllers\Controller;
use App\Models\Administration\TypeOfGood;
use Illuminate\Http\Request;

class TypeOfGoodsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $type_of_goods = TypeOfGood::all();

        return view('admin.administrations.type_of_goods.index',compact('type_of_goods'));
    }

    public function create(){
       
        return view('admin.administrations.type_of_goods.create');
    }

    public function store(Request $request)
    {
        $type_of_good = new TypeOfGood();

        $type_of_good->code = $request->code;
        $type_of_good->description = $request->description;
        $type_of_good->tariff_rate = $request->tariff_rate;
        $type_of_good->tax_percentage = $request->tax_percentage;
        $type_of_good->additional_charge = $request->additional_charge;
        $type_of_good->save();

        return redirect('/type_of_goods/create')->withSuccess('Se ha registrado exitosamente!');
       
     }
 
    public function edit($id)
    {
        $type_of_good = TypeOfGood::find($id);
 
        return view('admin.administrations.type_of_goods.edit',compact('type_of_good'));
    }

    public function update(Request $request, $id)
    {
  
        $type_of_good = TypeOfGood::findOrFail($id);

        $type_of_good->code = $request->code;
        $type_of_good->description = $request->description;
        $type_of_good->tariff_rate = $request->tariff_rate;
        $type_of_good->tax_percentage = $request->tax_percentage;
        $type_of_good->additional_charge = $request->additional_charge;
        $type_of_good->save();

        return redirect('/type_of_goods')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
         $type_of_good = TypeOfGood::find($request->id_type_of_good_modal); 
 
         if(isset($type_of_good)){
             
             $type_of_good->delete();
     
             return redirect('/type_of_goods')->withSuccess('Se ha Eliminado Correctamente!!');
         }
    }

}

