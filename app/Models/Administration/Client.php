<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function countries(){
        return $this->belongsTo('App\Models\Administration\Countries\Country','id_country');
    }
}
