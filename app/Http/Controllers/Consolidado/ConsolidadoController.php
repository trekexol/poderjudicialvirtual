<?php

namespace App\Http\Controllers\Consolidado;

use App\Http\Controllers\Controller;
use App\Models\Consolidado\Consolidado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsolidadoController extends Controller
{
    public function index()
    {
      
        $consolidados = Consolidado::join('packages','packages.id','consolidados.id_package')
                                ->join('clients','clients.id','packages.id_client')
                                ->orderBy('packages.id','desc')
                                ->groupBy('id_client','instruction')
                                ->select('instruction',DB::raw('SUM(id) As amount_packages'))
                                ->get();

       
        return view('admin.consolidados.index',compact('consolidados'));
    
    }

    public function aerial(Request $request){

        dd($request);
    }
    
}
