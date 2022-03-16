<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Wharehouse extends Model
{
    public function agencies(){
        return $this->belongsTo('App\Models\Administration\Agency','id_agency');
    }
}
