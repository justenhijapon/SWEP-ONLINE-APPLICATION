<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OfficeActivities extends Model
{
    protected $table = 'office_activities';
    public $timestamps = true;

    protected $attributes = [
        'has_participants' => 0,
        'utilized_fund' => 0.00,
    ];

    public static function boot(){
        parent::boot();

        static::creating(function($model){
            $model->user_created = Auth::user()->user_id;
            $model->ip_created = request()->ip();
        });

        static::updating(function($model){
            $model->user_updated = Auth::user()->user_id;
            $model->ip_updated = request()->ip();
        });
    }
}