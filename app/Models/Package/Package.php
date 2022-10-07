<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['id_agent_shipper','id_agent_vendor','id_client',
    'id_agency_office_location','id_agency_destination','id_wharehouse','id_origin_country','id_destination_country','id_delivery_company',
    'id_client_recipient','id_tula','id_paddle','tracking',
    'arrival_date','content','value','number_transport_guide','service_type',
    'instruction','instruction_type','description','high_value',
    'dangerous_goods','sed','document','fragile','status',
    'created_at','updated_at'];
    

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
        return $this->belongsTo('App\Models\Administration\Agency','id_agency_office_location');
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

    public function client_recipients(){
        return $this->belongsTo('App\Models\AdministrationClient\ClientRecipient','id_client_recipient');
    }
}
