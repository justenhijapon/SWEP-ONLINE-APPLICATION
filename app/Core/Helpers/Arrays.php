<?php

namespace App\Core\Helpers;

use App\Models\BlockFarm;
use App\Models\MillDistrict;
use App\Models\Pap;
use App\Models\PapItems;
use App\Models\Port;
use App\Models\PPU\Options;
use App\Models\Projects;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Arrays
{
    public static function blockFarms(){
        $bfs = BlockFarm::query()->get();

        return $bfs->mapWithKeys(function ($data){
            return [
                $data->block_farm_name => $data->block_farm_name,
            ];
        })->sort();
    }

    public static function blockFarmsName(){
        $bfs = BlockFarm::query()->get();

        return $bfs->mapWithKeys(function ($data){
            return [
                $data->block_farm_name => $data->block_farm_name,
            ];
        })->toArray();
    }

    public static function millDistricts(){
        $mds = MillDistrict::query()->get();
        return $mds->mapWithKeys(function ($data){
            return [
                $data->mill_district => $data->mill_district,
            ];
        })->toArray();
    }

    public static function projectCodes(){
        $projects = Projects::query()->get();
        return $projects->mapWithKeys(function ($data){
            return [
                $data->project_code => $data->project_code.' - '. $data->activity,
            ];
        })->toArray();
    }

    public static function unitsOfMeasurement(){
        $arr = [];
        $ops = Options::query()->where('for','=','unitsOfMeasurement')->get();
        if(!empty($ops)){
            foreach ($ops as $op){
                $arr[$op->value] = $op->display;
            }
        }
        ksort($arr);
        return $arr;
    }
    public static function modesOfProcurement(){
        $arr = [];
        $ops = Options::query()->where('for','=','modesOfProcurement')->get();
        if(!empty($ops)){
            foreach ($ops as $op){
                $arr[$op->value] = $op->display;
            }
        }
        ksort($arr);
        return $arr;
    }

    public static function projectCodesGrouped(){
        $paps = Pap::query()
            ->with(['items'])
            ->get();
        $array = [];
        foreach ($paps as $pap){
            $array[$pap->pap_code] = [];
            foreach ($pap->items as $item){
                $array[$pap->pap_code][$item->slug] = $item->item;
            }
        }
        return $array;
    }

    public static function papItems(){
        $papItems = PapItems::query()->get();

        return $papItems->mapWithKeys(function ($data){
            return [
                $data->slug => $data->pap_code,
            ];
        });
    }

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

}