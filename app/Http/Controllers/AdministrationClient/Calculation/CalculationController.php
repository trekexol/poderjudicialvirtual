<?php

namespace App\Http\Controllers\AdministrationClient\Calculation;

use App\Http\Controllers\Controller;
use App\Models\Administration\Client;
use App\Models\Administration\Countries\Country;
use App\Models\Administration\TypeOfGood;
use App\Models\Administration\TypeOfPackaging;
use Illuminate\Http\Request;

class CalculationController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name','asc')->get();

        $type_of_goods = TypeOfGood::orderBy('description','asc')->get();

        $clients = Client::orderBy('firstname','asc')->get();
      
        return view('clients.calculations.index',compact('countries','type_of_goods','clients'));
    
    }

    public function store(Request $request)
    {
        
    }
}
