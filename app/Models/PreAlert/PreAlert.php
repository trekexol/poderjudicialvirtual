<?php

namespace App\Models\PreAlert;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreAlert extends Model
{
    use HasFactory;

    public function clients(){
        return $this->belongsTo('App\Models\Administration\Client','id_client');
    }
}
