<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        return view('admin.packages.index');
    
    }
}
