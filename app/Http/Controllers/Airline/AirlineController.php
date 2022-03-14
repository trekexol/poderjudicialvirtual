<?php

namespace App\Http\Controllers\Airline;

use App\Http\Controllers\Controller;
use App\Models\Airline\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $airlines = Airline::all();

        return view('admin.airlines.index',compact('airlines'));
    }

    public function create(){

       
        return view('admin.airlines.create');
    }

    public function store(Request $request){

        $airline = new Airline();

        $airline->code = $request->code;
        $airline->name = $request->name;
        $airline->type = $request->type;
       
        $airline->save();

        return redirect('/airlines/create')->withSuccess('Se ha registrado exitosamente!');
      
    }

    public function edit($id){

        $airline = Airline::find($id);

        return view('admin.airlines.edit',compact('airline'));
    }
}
