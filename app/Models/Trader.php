<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;
use App\Models\TraderCluster;

class Trader extends Model
{
    protected $table = 'trader';

    /** RELATIONSHIPS **/
    public function traderCluster(){
        return $this->hasMany('App\Models\TraderCluster', 'slug', 'trader_slug');
    }
}
