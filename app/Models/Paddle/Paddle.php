<?php

namespace App\Models\Paddle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paddle extends Model
{
    use HasFactory;

    public function office_agencies(){
        return $this->belongsTo('App\Models\Administration\Agency','id_office_agency');
    }

    public function agents(){
        return $this->belongsTo('App\Models\Administration\Agent','id_agent');
    }

    public function destination_states(){
        return $this->belongsTo('App\Models\Administration\Countries\State','id_destination_state');
    }
}
