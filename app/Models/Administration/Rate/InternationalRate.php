<?php

namespace App\Models\Administration\Rate;

use Illuminate\Database\Eloquent\Model;

class InternationalRate extends Model
{
    public function wharehouses_origin(){
        return $this->belongsTo('App\Models\Administration\Wharehouse','id_wharehouse_origin');
    }

    public function wharehouses_destiny(){
        return $this->belongsTo('App\Models\Administration\Wharehouse','id_wharehouse_destiny');
    }
}
