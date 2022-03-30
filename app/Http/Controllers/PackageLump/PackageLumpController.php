<?php

namespace App\Http\Controllers\PackageLump;

use App\Http\Controllers\Controller;
use App\Models\Package\PackageLump;
use Illuminate\Http\Request;

class PackageLumpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
       
        if(isset($request->id_package_lump)){

            for($count = 0;$count < count($request->type_of_packaging); $count ++){

                $package = new PackageLump();

                $package->id_package = $request->id_package_lump;
                $package->id_type_of_packaging = $request->type_of_packaging[$count];
                $package->amount = $request->amount_lump[$count];
                $package->bulk_weight = $request->bulk_weight_lump[$count];
                $package->length_weight = $request->length_lump[$count];
                $package->width_weight = $request->width_lump[$count];
                $package->high_weight = $request->high_lump[$count];
                $package->description = $request->description_lump[$count];
        
                $package->save();
            }

        }else{
            return redirect('/packages')->withDanger('Debe Registrar el Paquete Primero !!');
        }

        return redirect('/packages/'.$request->id_package_lump.'')->withSuccess('Se ha registrado exitosamente!');
       
    }

    public function findAllPackageLumpByPackage($package){

        $package_lump = PackageLump::where('id_package',$package->id)->orderBy('id','asc')->get();

        return $package_lump;
    }
}
