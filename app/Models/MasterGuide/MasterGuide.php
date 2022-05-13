<?php

namespace App\Models\MasterGuide;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGuide extends Model
{
    use HasFactory;

    public function office_agencies(){
        return $this->belongsTo('App\Models\Administration\Agency','id_office_agency');
    }
    public function airlines(){
        return $this->belongsTo('App\Models\Administration\Airline\Airline','id_airline');
    }
    public function carrier_agents(){
        return $this->belongsTo('App\Models\Administration\Agent','id_carrier_agent');
    }
    public function consignee_agents(){
        return $this->belongsTo('App\Models\Administration\Agent','id_consignee_agent');
    }
    public function transmitter_agents(){
        return $this->belongsTo('App\Models\Administration\Agent','id_transmitter_agent');
    }
    public function position_agents(){
        return $this->belongsTo('App\Models\Administration\Agent','id_position_agent');
    }
}
