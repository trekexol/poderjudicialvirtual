<?php

namespace App\Http\Controllers\Administration\PackageStatus;

use App\Http\Controllers\Controller;
use App\Models\Administration\PackageStatus;
use Illuminate\Http\Request;

class PackageStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $package_status = PackageStatus::all();

        return view('admin.administrations.package_status.index',compact('package_status'));
    }

    public function create(){
       
        return view('admin.administrations.package_status.create');
    }

    public function store(Request $request)
    {
        $package_statu = new PackageStatus();

        $package_statu->code = $request->code;
        $package_statu->description = $request->description;
        $package_statu->color = $request->color;
      
        $package_statu->save();

        return redirect('/package_status/create')->withSuccess('Se ha registrado exitosamente!');
       
     }
 
    public function edit($id)
    {
        $package_statu = PackageStatus::find($id);
 
        return view('admin.administrations.package_status.edit',compact('package_statu'));
    }

    public function update(Request $request, $id)
    {
  
        $package_statu = PackageStatus::findOrFail($id);

        $package_statu->code = $request->code;
        $package_statu->description = $request->description;
        $package_statu->color = $request->color;
       
        $package_statu->save();

        return redirect('/package_status')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
         $package_statu = PackageStatus::find($request->id_package_statu_modal); 
 
         if(isset($package_statu)){
             
             $package_statu->delete();
     
             return redirect('/package_status')->withSuccess('Se ha Eliminado Correctamente!!');
         }
    }

}

