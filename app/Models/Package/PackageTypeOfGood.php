<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageTypeOfGood extends Model
{
    use HasFactory;

    public function packages(){
        return $this->belongsTo('App\Models\Package\Package','id_package');
    }

    public function type_of_goods(){
        return $this->belongsTo('App\Models\Administration\TypeOfGood','id_type_of_good');
    }
}
