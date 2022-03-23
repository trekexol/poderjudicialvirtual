<?php

namespace App\Http\Controllers\Administration\TypeOfPackagings;

use App\Http\Controllers\Controller;
use App\Models\Administration\TypeOfPackaging;
use Illuminate\Http\Request;

class TypeOfPackagingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $type_of_packagings = TypeOfPackaging::all();

        return view('admin.administrations.type_of_packagings.index',compact('type_of_packagings'));
    }

    public function create(){
       
        return view('admin.administrations.type_of_packagings.create');
    }

    public function store(Request $request)
    {
        $type_of_packaging = new TypeOfPackaging();

        $type_of_packaging->code = $request->code;
        $type_of_packaging->description = $request->description;
      
        $type_of_packaging->save();

        return redirect('/type_of_packagings/create')->withSuccess('Se ha registrado exitosamente!');
       
     }
 
    public function edit($id)
    {
        $type_of_packaging = TypeOfPackaging::find($id);
 
        return view('admin.administrations.type_of_packagings.edit',compact('type_of_packaging'));
    }

    public function update(Request $request, $id)
    {
  
        $type_of_packaging = TypeOfPackaging::findOrFail($id);

        $type_of_packaging->code = $request->code;
        $type_of_packaging->description = $request->description;
       
        $type_of_packaging->save();

        return redirect('/type_of_packagings')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
         $type_of_packaging = TypeOfPackaging::find($request->id_type_of_packaging_modal); 
 
         if(isset($type_of_packaging)){
             
             $type_of_packaging->delete();
     
             return redirect('/type_of_packagings')->withSuccess('Se ha Eliminado Correctamente!!');
         }
    }

}

