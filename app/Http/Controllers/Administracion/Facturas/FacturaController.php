<?php

namespace App\Http\Controllers\Administracion\Facturas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Facturas\CalcularFacturaController;
use App\Models\Clientes\Cliente;
use App\Models\Compras\Compra;
use App\Models\Facturas\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $facturas = Factura::all();

        return view('admin.facturas.index',compact('facturas'));
    
    }
    public function create(){
       
        $clientes = Cliente::all();
        return view('admin.facturas.create',compact('clientes'));
    }

    public function store(Request $request)
    {
        
        $factura = new Factura();

        $factura->id_cliente = $request->id_cliente;
        $factura->referencia = $request->referencia;
      
        $factura->save();

        return redirect('/facturas/create')->withSuccess('Se ha registrado exitosamente!');
       
    }
 
    public function show($id_factura){
       
        $factura = Factura::find($id_factura);
        $compras = Compra::where('id_factura',$id_factura)->get();

        return view('admin.facturas.show',compact('factura','compras'));
    }
   
}
