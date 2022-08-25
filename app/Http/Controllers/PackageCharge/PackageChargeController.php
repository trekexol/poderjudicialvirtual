<?php

namespace App\Http\Controllers\PackageCharge;

use App\Http\Controllers\Controller;
use App\Models\Package\Package;
use App\Models\Package\PackageCharge;
use Illuminate\Http\Request;

class PackageChargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id_package){

        $package_charges = PackageCharge::where('id_package',$id_package)->get();
        $package = Package::find($id_package);

        $package_charge = null;

        return view('admin.packages.packages_charges.index',compact('package_charge','package_charges','package'));
    }

    public function create(){
       
        return view('admin.packages.packages_charges.create');
    }

    public function store(Request $request)
    {
        $package_charge = new PackageCharge();

        $package_charge->id_package = $request->id_package;
        $package_charge->concept = $request->concept;
        $package_charge->amount = str_replace(',', '.', str_replace('.', '',$request->amount));
        $package_charge->save();

        return redirect('/package_charges/index/'.$request->id_package.'')->withSuccess('Se ha registrado exitosamente!');
       
    }
 
    public function edit($id,$id_package)
    {
        $package_charges = PackageCharge::where('id_package',$id_package)->get();
        $package = Package::find($id_package);

        $package_charge = PackageCharge::find($id);

        return view('admin.packages.packages_charges.index',compact('package_charge','package_charges','package'));
    }

    public function update(Request $request, $id)
    {
  
        $package_charge = PackageCharge::findOrFail($id);

        $package_charge->concept = $request->concept;
        $package_charge->amount = str_replace(',', '.', str_replace('.', '',$request->amount));
        $package_charge->save();

        $package_charge->save();

        return redirect('/package_charges/index/'.$request->id_package.'')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
         $package_charge = PackageCharge::find($request->id_package_charge_modal); 
         $id_package = $package_charge->id_package;
 
         if(isset($package_charge)){
             
             $package_charge->delete();
     
             return redirect('/package_charges/index/'.$id_package.'')->withSuccess('Se ha Eliminado Correctamente!!');
         }
    }
}
