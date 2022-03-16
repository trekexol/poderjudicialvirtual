<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    public function states(){
        return $this->belongsTo('App\Models\Administration\Countries\State','id_state');
    }
}
