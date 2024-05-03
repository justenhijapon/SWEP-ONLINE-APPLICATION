<?php

namespace App\Core\Helpers;

use App\Models\BlockFarm;
use App\Models\MillDistrict;
use App\Models\OfficialReciepts;
use App\Models\OfficialRecieptUtilization;
use App\Models\Origin;
use App\Models\Pap;
use App\Models\PapItems;
use App\Models\Port;
use App\Models\PPU\Options;
use App\Models\Projects;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Arrays
{
    public static function portofOrigin(){
        $po = Port::query()
            ->with('portoforigin')
            ->get();

        $array = [];
        foreach ($po as $port){
            $array[$port->category][$port->slug] = $port->port_name;
        }
        return $array;
    }

    public static function portofdestination(){
        $pd = Port::query()
            ->with('portofdestination')
            ->get();

        $array = [];
        foreach ($pd as $port){
            $array[$port->category][$port->slug] = $port->port_name;
        }
        return $array;
    }

    public static function originmill(){
        $om = Origin::query()
            ->with('originMill')
            ->get();

        $array = [];
        foreach ($om as $mill){
            $array[$mill->origin][$mill->slug] = $mill->name;
        }
        return $array;
}

    public static function spvessel(){
        $spv = Port::query()->get();

        return $spv->mapWithKeys(function ($data){
            return [
                $data->ship => $data->ship,
            ];
        })->toArray();
    }

    public static function spfreight(){
        $spf = Port::query()->get();

        return $spf->mapWithKeys(function ($data){
            return [
                $data->vessel => $data->vessel,
            ];
        })->toArray();
    }

    public static function spOR(){
        $spor = OfficialReciepts::query()->get();

        return $spor->mapWithKeys(function ($data){
            return [
                $data->or_no => $data->or_no,
            ];
        })->toArray();
    }

    public static function spStatus(){
        return [
                'PENDING' => 'PENDING',
                'SHIPPED' => 'SHIPPED',
                'CANCELLED' => 'CANCELLED'
        ];
    }



    public static function cropYear($end = 2000){

        $years = array_combine(range(date("Y"), $end), range(date("Y"), $end));

        $yearsArray = [];
        foreach ($years as $year){
            $pastyear = $year-1;
            $yearsArray[$pastyear.'-'.$year] = $pastyear.'-'.$year;
        }

        return $yearsArray;


    }

}