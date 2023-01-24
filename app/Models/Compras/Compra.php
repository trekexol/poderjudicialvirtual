<?php

namespace App\Models\Compras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    public function facturas(){
        return $this->belongsTo('App\Models\Facturas\Factura','id_factura');
    }
    public function productos(){
        return $this->belongsTo('App\Models\Productos\Producto','id_producto');
    }
}
