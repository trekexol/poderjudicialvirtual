<?php

namespace App\Models\Administration\Countries;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function countries(){
        return $this->belongsTo('App\Models\Administration\Countries\Country','id_country');
    }
}
