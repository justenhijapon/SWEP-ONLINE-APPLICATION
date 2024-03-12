<?php

namespace App\Core\Helpers;

use App\Models\BlockFarm;
use App\Models\MillDistrict;
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
}