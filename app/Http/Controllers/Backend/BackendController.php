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
      
        //$package_trackings = Package::groupBy('tracking','id')->select('tracking','id')->get();

        
    return view('admin.index',/*compact('package_trackings')*/);
    
    }
}
