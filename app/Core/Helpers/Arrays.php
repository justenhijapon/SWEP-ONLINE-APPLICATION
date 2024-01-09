<?php

namespace App\Core\Helpers;

use App\Models\BlockFarm;

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
}