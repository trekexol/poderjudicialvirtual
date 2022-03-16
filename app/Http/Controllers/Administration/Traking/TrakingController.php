<?php

namespace App\Http\Controllers\Administration\Traking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrakingController extends Controller
{
    public function index()
    {
        
        return view('admin.administrations.trakings.index');
    
    }
}
