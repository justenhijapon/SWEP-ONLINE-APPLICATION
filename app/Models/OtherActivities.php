<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OtherActivities extends Model
{
    protected $table = 'other_activities';
    public $timestamps = true;

    protected $attributes = [
        'has_participants' => 0,
        'utilized_funds' => 0.00,
    ];

    public static function boot(){
        parent::boot();

        static::creating(function($model){
            $model->user_created = Auth::user()->user_id;
        });

        static::updating(function($model){
            $model->user_updated = Auth::user()->user_id;
        });
    }
}