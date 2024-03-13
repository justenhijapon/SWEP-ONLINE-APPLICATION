<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;

class Attributions extends Model
{
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


    protected $table = 'attribution';

    public $timestamps = false;

    public $sortable = ['activity', 'date', 'venue', 'project_code', 'item', 'utilized_fund', 'details'];




    protected $attributes = [
        'slug' => '',
        'activity' => '',
        'date' => null,
        'project_code' => '',
        'item' => '',

        'utilized_fund' => 0.00,
        'venue' => '',
        'details' => '',
        'has_participants' => 0,

        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',
    ];
}
