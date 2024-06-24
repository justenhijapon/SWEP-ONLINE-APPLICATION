<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mill extends Model
{
    protected $table = 'mill';

    /** RELATIONSHIPS **/
    public function millUtilization() {
        return $this->hasMany('App\Models\MillUtilization','slug','slug');
    }
}
