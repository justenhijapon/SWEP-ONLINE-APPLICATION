<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Projects extends Model
{
    protected $table = 'projects';
    protected $dates = ['created_at','updated_at'];
    public $timestamps = true;

    public static function boot(){
        parent::boot();

        static::creating(function($model){
            $model->user_created = Auth::user()->user_id;
        });

        static::updating(function($model){
            $model->user_updated = Auth::user()->user_id;
        });
    }

    public function creator(){
        return $this->hasOne('App\Models\User', 'user_id', 'user_created');
    }

    public function updater(){
        return $this->hasOne('App\Models\User', 'user_id', 'user_updated');
    }

    public function seminars(){
        return $this->hasMany('App\Models\Seminar','project_code','project_code');
    }

    public function otherActivities(){
        return $this->hasMany('App\Models\OtherActivities','project_code','project_code');
    }

    public function getTableColumns(){
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}