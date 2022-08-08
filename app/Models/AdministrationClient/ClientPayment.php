<?php

namespace App\Models\AdministrationClient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPayment extends Model
{
    use HasFactory;
    public function banks(){
        return $this->belongsTo('App\Models\Administration\Bank','id_bank');
    }
}
