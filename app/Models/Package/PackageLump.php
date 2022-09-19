<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageLump extends Model
{

    protected $fillable = ['id_package','id_type_of_packaging','amount',
    'bulk_weight','length_weight','width_weight','high_weight','description','status',
    'created_at','updated_at'];

    use HasFactory;

    public function packages(){
        return $this->belongsTo('App\Models\Package\Package','id_package');
    }

    public function type_of_packagings(){
        return $this->belongsTo('App\Models\Administration\TypeOfPackaging','id_type_of_packaging');
    }
}
