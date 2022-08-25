<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\General;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $general = General::first();

        return view('admin.generals.index',compact('general'));
    }
 
    public function store(Request $request)
    {
  
        $general = General::findOrFail(1);

        $general->name = $request->name;
        $general->legal_name = $request->legal_name;
        $general->direction = $request->direction;
        $general->direction2 = $request->direction2;
        $general->direction3 = $request->direction3;
        $general->phone = $request->phone;
        $general->email = $request->email;
        $general->contact = $request->contact;
        $general->currency = $request->currency;

        $general->save();

        return redirect('/generals/index')->withSuccess('Se ha actualizado exitosamente!');

    }
}
