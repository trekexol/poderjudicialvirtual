<?php

namespace App\Http\Controllers\Administracion\Facturas;

use App\Http\Controllers\Controller;
use App\Models\Facturas\Factura;
use App\Models\Productos\Producto;
use Illuminate\Http\Request;

class CalcularFacturaController extends Controller
{
    public function calcularTotales($compra){

        $factura = Factura::findOrFail($compra->id_factura);
        $producto = Producto::find($compra->id_producto);

        $factura->total_precio += $producto->precio * $compra->cantidad;
        $factura->total_impuesto += $producto->impuesto * $compra->cantidad;

        $factura->save();
    }
}
