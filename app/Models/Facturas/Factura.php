<?php

namespace App\Models\Facturas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    public function clientes(){
        return $this->belongsTo('App\Models\Clientes\Cliente','id_cliente');
    }

   
}
