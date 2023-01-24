<?php

namespace App\Http\Controllers\Administracion\Productos;

use App\Http\Controllers\Controller;
use App\Models\Productos\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $productos = Producto::orderBy('nombre','asc')->get();

        return view('admin.productos.index',compact('productos'));
    
    }

}
