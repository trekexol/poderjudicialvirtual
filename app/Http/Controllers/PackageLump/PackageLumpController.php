<?php

namespace App\Http\Controllers\PackageLump;

use App\Http\Controllers\Controller;
use App\Models\Administration\TypeOfPackaging;
use App\Models\Package\Package;
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

                $package_lump = new PackageLump();

                $package_lump->id_package = $request->id_package_lump;
                $package_lump->id_type_of_packaging = $request->type_of_packaging[$count];
                $package_lump->amount = $request->amount_lump[$count];
                $package_lump->bulk_weight = $request->bulk_weight_lump[$count];
                $package_lump->length_weight = $request->length_lump[$count];
                $package_lump->width_weight = $request->width_lump[$count];
                $package_lump->high_weight = $request->high_lump[$count];
                $package_lump->description = $request->description_lump[$count];
        
                $package_lump->save();

                $this->updatePackage($package_lump);
            }
            
        }else{
            return redirect('/packages')->withDanger('Debe Registrar el Paquete Primero !!');
        }

        return redirect('/packages/create/'.$request->id_package_lump.'')->withSuccess('Se ha registrado exitosamente!');
       
    }

    public function updatePackage($package_lump){
        
        
        $package = Package::findOrFail($package_lump->id_package);

        $lenght = $package_lump->length_weight;
      
        $width = $package_lump->width_weight;
             
        $high = $package_lump->high_weight;

        if(($high != "" && $high != 0) && ($width != "" && $width != 0) && ($lenght != "" && $lenght != 0)){

            $volume = ceil(($high * $width * $lenght) / 166);
            
            $cubic_foot = ceil(($high * $width * $lenght) / 1728);

            $package->volume += $volume;
            $package->cubic_foot += $cubic_foot;

            $package->starting_weight += $package_lump->bulk_weight;

            $package->save();
        }
    

       
           
    }

    public function findAllPackageLumpByPackage($package){

        $package_lump = PackageLump::where('id_package',$package->id)->orderBy('id','asc')->get();

        return $package_lump;
    }

    public function edit($id){

        $package_lump = PackageLump::find($id);

        $type_of_packagings = TypeOfPackaging::orderBy('description','asc')->get();


        return view('admin.packages.packages_lumps.edit',compact('type_of_packagings','package_lump'));
    }

    public function update(Request $request, $id)
    {
        
        $package_lump = PackageLump::findOrFail($id);

        $package_lump->id_type_of_packaging = $request->id_type_of_packaging;
        $package_lump->amount = $request->amount;
        $package_lump->bulk_weight = $request->bulk_weight;
        $package_lump->length_weight = $request->length_weight;
        $package_lump->width_weight = $request->width_weight;
        $package_lump->high_weight = $request->high_weight;
        $package_lump->description = $request->description;
        $package_lump->save();

        return redirect('/packages/create/'.$package_lump->id_package_lump.'')->withSuccess('Se ha actualizado el tipo de paquete exitosamente!');

    }

    public function destroy(Request $request)
    {
       
        $package_lump = PackageLump::find($request->id_packages_lump_modal); 

        if(isset($package_lump)){
            
            $package_lump->delete();
    
            return redirect('/packages/create/'.$request->id_package_modal.'')->withSuccess('Se ha Eliminado Correctamente!!');
        }else{

        }
    }
}
