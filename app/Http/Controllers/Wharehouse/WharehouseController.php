<?php

namespace App\Http\Controllers\Wharehouse;

use App\Http\Controllers\Controller;
use App\Models\Administration\Wharehouse;
use App\Models\Agency;
use Illuminate\Http\Request;

class WharehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $wharehouses = Wharehouse::all();

        return view('admin.wharehouses.index',compact('wharehouses'));
    }

    public function create(){

        $agencies = Agency::orderBy('name','asc')->get();

        return view('admin.wharehouses.create',compact('agencies'));
    }

    public function store(Request $request){

         $wharehouse = new Wharehouse();
 
         $wharehouse->id_agency = $request->id_agency;
         $wharehouse->code = $request->code;
         $wharehouse->name = $request->name;
       
         $wharehouse->save();
 
         return redirect('/wharehouses/create')->withSuccess('Se ha registrado exitosamente!');
       
     }
 
     public function edit($id){
 
         $wharehouse = Wharehouse::find($id);
 
         return view('admin.agencies.edit',compact('wharehouse'));
     }
 
}
