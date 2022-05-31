<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function countries(){
        return $this->belongsTo('App\Models\Administration\Countries\Country','id_country');
    }

    public function states(){
        return $this->belongsTo('App\Models\Administration\Countries\State','id_state_received');
    }

    public function agencies(){
        return $this->belongsTo('App\Models\Administration\Agency','id_agency');
    }

    public function agents(){
        return $this->belongsTo('App\Models\Administration\Agent','id_agent');
    }
}
