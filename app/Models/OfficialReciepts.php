<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;

class OfficialReciepts extends Model
{
    protected $table = 'official_reciept';

    public static function boot()
    {
        parent::boot();
        static::updating(function($a){
            $a->user_updated = Auth::user()->user_id;
            $a->ip_updated = request()->ip();
            $a->updated_at = Carbon::now();
        });

        static::creating(function ($a){
            $a->user_created = Auth::user()->user_id;
            $a->ip_created = request()->ip();
            $a->created_at = Carbon::now();
        });
    }
    use Sortable;

    protected $dates = ['created_at', 'updated_at'];

    public $timestamps = false;

    /** RELATIONSHIPS **/
    public function orUtilization() {
        return $this->hasMany('App\Models\OfficialRecieptUtilization','or_slug','slug');
    }

    public function orShippingPermit() {
        return $this->hasMany('App\Models\ShippingPermit','sp_or_no','or_no');
    }

    public function orMIll_Origin(){
        return $this->belongsTo(Mill::class,'or_mill' ,'mill_code');

    }
}
