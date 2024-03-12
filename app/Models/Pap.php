<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pap extends Model
{
    protected $table = 'pap';

    public function items(){
        return $this->hasMany(PapItems::class,'pap_code','pap_code');
    }
}