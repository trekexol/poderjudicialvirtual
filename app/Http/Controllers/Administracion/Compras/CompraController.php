<?php

namespace App\Http\Controllers\Administracion\Compras;

use App\Http\Controllers\Administracion\Facturas\CalcularFacturaController;
use App\Http\Controllers\Controller;
use App\Models\Compras\Compra;
use App\Models\Facturas\Factura;
use App\Models\Productos\Producto;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $compras = Compra::all();

        return view('admin.compras.index',compact('compras'));
    
    }
    public function create($id_factura){
       
        $factura = Factura::find($id_factura);

        $productos = Producto::all();

        return view('admin.compras.create',compact('factura','productos'));
    }

    public function store(Request $request)
    {
       
        $compra = new Compra();

        $compra->id_factura = $request->id_factura;
        $compra->id_producto = $request->id_producto;
        $compra->cantidad = $request->cantidad;
      
        $compra->save();

        $calcular_factura = new CalcularFacturaController();
        $calcular_factura->calcularTotales($compra);

        return redirect('/compras/register/'.$compra->id_factura)->withSuccess('Se ha registrado exitosamente!');
       
    }
 
   
}
