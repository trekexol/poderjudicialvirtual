<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    public function cities(){
        return $this->belongsTo('App\Models\Countries\City','id_city');
    }
}
