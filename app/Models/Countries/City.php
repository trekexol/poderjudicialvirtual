<?php

namespace App\Models\Countries;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function countries(){
        return $this->belongsTo('App\Models\Countries\Country','id_country');
    }
}
