<?php

namespace App\Models\AdministrationClient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRecipient extends Model
{
    use HasFactory;

    public function countries(){
        return $this->belongsTo('App\Models\Administration\Countries\Country','id_country');
    }
}
