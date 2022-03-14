<?php

namespace App\Http\Controllers\Traking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrakingController extends Controller
{
    public function index()
    {
        
        return view('admin.trakings.index');
    
    }
}
