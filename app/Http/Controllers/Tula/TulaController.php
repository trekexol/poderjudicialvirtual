<?php

namespace App\Http\Controllers\Tula;

use App\Http\Controllers\Controller;
use App\Models\Tula\Tula;
use Illuminate\Http\Request;

class TulaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
      
        $tulas = Tula::orderBy('id','desc')->get();
       
        return view('admin.tulas.index',compact('tulas'));
    
    }
}
