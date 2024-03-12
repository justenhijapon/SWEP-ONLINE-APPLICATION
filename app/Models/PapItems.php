<?php

namespace App\Models;

use App\Core\Helpers\Helpers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PapItems extends Model
{
    protected $table = 'pap_items';
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


    public function pap(){
        return $this->belongsTo(Pap::class,'pap_code','pap_code');
    }

    /** MUTATORS */
    protected function unitCost(): Attribute{
        return  Attribute::make(
            set: fn(string $value) => Helpers::sanitizeAutonum($value),
        );
    }
    protected function mooe(): Attribute{
        return  Attribute::make(
            set: fn(string $value) => Helpers::sanitizeAutonum($value),
        );
    }
    protected function totalBudget(): Attribute{
        return  Attribute::make(
            set: fn(string $value) => $this->unit_cost * $this->qty,
        );
    }
}