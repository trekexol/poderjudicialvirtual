<?php

namespace App\Models\Tula;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tula extends Model
{
    use HasFactory;

    public function wharehouse_origin(){
        return $this->belongsTo('App\Models\Administration\Wharehouse','id_wharehouse_origin');
    }
    public function wharehouse_destiny(){
        return $this->belongsTo('App\Models\Administration\Wharehouse','id_wharehouse_destiny');
    }
    public function destination_states(){
        return $this->belongsTo('App\Models\Administration\Countries\State','id_destination_state');
    }
}
