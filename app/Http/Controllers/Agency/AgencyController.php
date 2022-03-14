<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Countries\Country;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $agencies = Agency::all();

        return view('admin.agencies.index',compact('agencies'));
    }

    public function create(){

        $countries = Country::all();

        return view('admin.agencies.create',compact('countries'));
    }

    public function store(Request $request){

       // dd($request);
        $agency = new Agency();

        $agency->id_city = $request->id_city;
        $agency->code = $request->code;
        $agency->name = $request->name;
        $agency->type = $request->comercial;
        $agency->direction = $request->direction;
        $agency->phone = $request->phone;
        $agency->contact_person = $request->contact_person;
        $agency->rate = $request->amount;
        $agency->virtual_payment = $request->payment_virtual;

        $agency->save();

        return redirect('/agencies/create')->withSuccess('Se ha registrado exitosamente!');
      
    }

    public function edit($id){

        $agency = Agency::find($id);

        return view('admin.agencies.edit',compact('agency'));
    }

}
