<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;

class ShippingPermit extends Model
{
    protected $table = 'shipping_permits';

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

    /** Relationships */
//    public function portOfOrigin(){
//        return $this->belongsTo(Port::class,'sp_port_of_origin' ,'slug');
//    }
//
//    public function portOfDestination(){
//        return $this->belongsTo(Port::class,'sp_port_of_destination' ,'slug');
//    }

    public function spMIll_Origin(){
        return $this->belongsTo(Mill::class,'sp_mill' ,'mill_code');

    }

    public function spCollecting_Officer(){
        return $this->belongsTo(User::class,'sp_collecting_officer' ,'user_id');

    }

    /** RELATIONSHIPS **/
    public function spUtilization() {
        return $this->hasMany('App\Models\VolumeModel','sp_slug','slug');
    }

}
