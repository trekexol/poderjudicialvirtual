<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package\Package;
use Illuminate\Http\Request;

class BackendController extends Controller
{
   public function index()
    {
        $package_trakings = Package::groupBy('tracking','id')->select('tracking','id')->get();

        return view('admin.trakings.index',compact('package_trakings'));
    
    }
}
