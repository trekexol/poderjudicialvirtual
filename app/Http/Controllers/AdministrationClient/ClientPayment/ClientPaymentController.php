<?php

namespace App\Http\Controllers\AdministrationClient\ClientPayment;

use App\Http\Controllers\Controller;
use App\Models\Administration\Bank;
use App\Models\Administration\Countries\Country;
use App\Models\AdministrationClient\ClientPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
      
        $client_payments = ClientPayment::orderBy('id','desc')->get();
       
        return view('clients.payments.index',compact('client_payments'));
    
    }

    public function create($id = null)
    {
        if(isset($id)){
            $client_payment = ClientPayment::findOrFail($id);
        }else{
            $client_payment = null;
        }

        $date = Carbon::now();
        $datenow = $date->format('Y-m-d'); 

        $countries = Country::all();

        $banks = Bank::all();

        return view('clients.payments.create',compact('client_payment','countries','datenow','banks'));
    
    }

    public function store(Request $request)
    {
        $user       =   auth()->user();
        $client_payment = new ClientPayment();

        $client_payment->id_client = $user->id_client;
        $client_payment->id_bank = $request->id_bank;
        $client_payment->date = $request->date;
        $client_payment->type = $request->type;
        $client_payment->transferred_from = $request->transferred_from;
        $client_payment->confirmation = $request->confirmation;
        $client_payment->amount = str_replace(',', '.', str_replace('.', '',$request->amount));
        $client_payment->observation = $request->observation;

        $client_payment->status = 'Activo';
      
        $client_payment->save();

        return redirect('/client_payments/index')->withSuccess('Se ha registrado exitosamente!');
       
    }

   

    public function update(Request $request, $id)
    {
        
        $client_payment = ClientPayment::findOrFail($id);

        $client_payment->id_bank = $request->id_bank;
        $client_payment->date = $request->date;
        $client_payment->type = $request->type;
        $client_payment->transferred_from = $request->transferred_from;
        $client_payment->confirmation = $request->confirmation;
        $client_payment->amount = str_replace(',', '.', str_replace('.', '',$request->amount));
        $client_payment->observation = $request->observation;


        $client_payment->save();

        return redirect('/client_payments/index')->withSuccess('Se ha actualizado exitosamente!');

    }

    public function destroy(Request $request)
    {
        
        $client_payment = ClientPayment::find($request->id_client_payment_modal); 

        if(isset($client_payment)){
            
            $client_payment->delete();
    
            return redirect('/client_payments/index')->withSuccess('Se ha Eliminado Correctamente!!');
        }
    }
}
