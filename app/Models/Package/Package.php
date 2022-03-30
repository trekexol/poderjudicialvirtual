<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function shippers(){
        return $this->belongsTo('App\Models\Administration\Agent','id_agent_shipper');
    }
    public function vendors(){
        return $this->belongsTo('App\Models\Administration\Agent','id_agent_vendor');
    }
    public function clients(){
        return $this->belongsTo('App\Models\Administration\Client','id_client');
    }
    public function office_locations(){
        return $this->belongsTo('App\Models\Administration\Agent','id_agent_office_location');
    }
    public function wharehouses(){
        return $this->belongsTo('App\Models\Administration\Wharehouse','id_wharehouse');
    }
    public function origin_countries(){
        return $this->belongsTo('App\Models\Administration\Countries\Country','id_origin_country');
    }
    public function destination_countries(){
        return $this->belongsTo('App\Models\Administration\Countries\Country','id_destination_country');
    }
    public function delivery_companies(){
        return $this->belongsTo('App\Models\Administration\DeliveryCompany','id_delivery_company');
    }
}
