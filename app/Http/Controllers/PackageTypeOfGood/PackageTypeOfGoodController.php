<?php

namespace App\Http\Controllers\PackageTypeOfGood;

use App\Http\Controllers\Controller;
use App\Models\Administration\TypeOfGood;
use App\Models\Package\PackageTypeOfGood;
use Illuminate\Http\Request;

class PackageTypeOfGoodController extends Controller
{
    public function store(Request $request)
    {
        //dd($request);
        if(isset($request->id_package_type_of_good)){

            for($count = 0;$count < count($request->id_type_of_good); $count ++){

                $package = new PackageTypeOfGood();

                $package->id_package = $request->id_package_type_of_good;
                $package->id_type_of_good = $request->id_type_of_good[$count];
                $package->unit = $request->unit_type_of_good[$count];
                $package->description = $request->description_type_of_good[$count];
                $package->value = $request->value_type_of_good[$count];
                $package->tariff = $request->tariff_type_of_good[$count];
                $package->charge = $request->charge_type_of_good[$count];
              
                $package->save();
            }

        }else{
            return redirect('/packages')->withDanger('Debe Registrar el Paquete Primero !!');
        }

        return redirect('/packages/'.$request->id_package_type_of_good.'')->withSuccess('Se ha registrado exitosamente!');
       
    }

    public function edit($id){

        $package_type_of_good = PackageTypeOfGood::find($id);

        $type_of_goods = TypeOfGood::orderBy('description','asc')->get();


        return view('admin.packages.packages_type_of_goods.edit',compact('type_of_goods','package_type_of_good'));
    }

    public function update(Request $request, $id)
    {
        
        $package_type_of_good = PackageTypeOfGood::findOrFail($id);

        $package_type_of_good->id_type_of_good = $request->id_type_of_good;
        $package_type_of_good->unit = $request->unit;
        $package_type_of_good->description = $request->description;
        $package_type_of_good->value = $request->value;
        $package_type_of_good->tariff = $request->tariff;
        $package_type_of_good->charge = $request->charge;
        $package_type_of_good->save();

        return redirect('/packages/'.$package_type_of_good->id_package.'')->withSuccess('Se ha actualizado el tipo de paquete exitosamente!');

    }

    public function destroy(Request $request)
    {
        
        $package_type_of_good = PackageTypeOfGood::find($request->id_packages_type_of_good_modal); 

        if(isset($package_type_of_good)){
            
            $package_type_of_good->delete();
    
            return redirect('/packages/'.$request->id_packages_type_of_good_modal.'')->withSuccess('Se ha Eliminado Correctamente!!');
        }
    }
}
