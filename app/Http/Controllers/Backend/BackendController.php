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
            $package_trackings = Package::where('id_client',$user->id_client)->get();

            return view('clients.home.index',compact('package_trackings'));
        }
        
        $package_trackings = Package::all();

        return view('admin.trackings.index',compact('package_trackings'));
    
    }
}
