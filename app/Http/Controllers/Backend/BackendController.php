<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package\Package;
use Illuminate\Http\Request;

class BackendController extends Controller
{
   public function index()
    {
        $user       =   auth()->user();

        if(isset($user->id_client)){
            $package_trakings = Package::where('id_client',$user->id_client)->groupBy('tracking','id')->select('tracking','id')->get();

            return view('clients.home.index',compact('package_trakings'));
        }
        
        $package_trakings = Package::groupBy('tracking','id')->select('tracking','id')->get();

        return view('admin.trakings.index',compact('package_trakings'));
    
    }
}
