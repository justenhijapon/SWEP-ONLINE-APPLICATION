<?php

namespace App\Core\Helpers;

class Helpers
{
    public static function sanitizeAutonum($num){
        $num = str_replace('₱','',$num);
        $num = str_replace(',','',$num);
        if ($num == ''){
            return null;
        }
        if ($num == 0){
            return null;
        }
        return $num;
    }

}