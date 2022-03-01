<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherActivitiesParticipants extends Model
{
    protected $table = 'other_activities_participants';
    public $timestamps = true;



    public static function boot(){
        parent::boot();

        static::creating(function($model){
            $model->user_created = Auth::user()->user_id;
            $model->user_updated = '';
            $model->ip_updated = '';
        });

        static::updating(function($model){
            $model->user_updated = Auth::user()->user_id;
        });
    }
}