<?php

namespace App\Core\Helpers;

use App\Models\BlockFarm;
use App\Models\Consignee;
use App\Models\Mill;
use App\Models\MillDistrict;
use App\Models\MillUtilization;
use App\Models\OfficialReciepts;
use App\Models\OfficialRecieptUtilization;
use App\Models\Origin;
use App\Models\Pap;
use App\Models\PapItems;
use App\Models\Port;
use App\Models\PPU\Options;
use App\Models\Projects;
use App\Models\Trader;
use App\Models\User;
use App\Models\Vessel;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Arrays
{
//    public static function portofOrigin(){
//        $po = Port::query()
//            ->with('portoforigin')
//            ->get();
//
//        $array = [];
//        foreach ($po as $port){
//            $array[$port->category][$port->slug] = $port->port_name;
//        }
//        return $array;
//    }

//    public static function portofdestination(){
//        $pd = Port::query()
//            ->with('portofdestination')
//            ->get();
//
//        $array = [];
//        foreach ($pd as $port){
//            $array[$port->category][$port->slug] = $port->port_name;
//        }
//        return $array;
//    }

    public static function portarray(){
        $port = Port::query()->get();

        return $port->mapWithKeys(function ($data){
            return [
                $data->port_name => $data->port_name,
            ];
        })->toArray();
    }

    public static function millarray(){
        $mill = Mill::query()->get();

        $array = [];
        foreach ($mill as $mills){
            $array[$mills->slug] = $mills->mill_code;
        }
        return $array;
    }

    public static function millutilarray(){
        $mill = MillUtilization::query()->get();

        $array = [];
        foreach ($mill as $mills){
            $array[$mills->mu_mill_code][$mills->mu_description] = $mills->mu_description;
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
        $spv = Vessel::query()->get();

        return $spv->mapWithKeys(function ($data){
            return [
                $data->vessel_description => $data->vessel_description,
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

    public static function spconsignee(){
        $spc = Consignee::query()->get();

        return $spc->mapWithKeys(function ($data){
            return [
                $data->consignee_name => $data->consignee_name,
            ];
        })->toArray();
    }

    public static function sptrader(){
        $spt = Trader::query()->get();

        return $spt->mapWithKeys(function ($data){
            return [
                $data->trader_name => $data->trader_name,
            ];
        })->toArray();
    }

    public static function spCollectingOfficer() {
        $users = User::query()->get();

        return $users->mapWithKeys(function ($user) {
            // Extract the first character of the middlename
            $middleInitial = $user->middlename ? substr($user->middlename, 0, 1) . '.' : '';
            $fullName = $user->lastname . ', ' . $user->firstname . ' ' . $middleInitial;
            return [
                $user->user_id => $fullName, // Use the user ID as the key and the full name as the value
            ];
        })->toArray();
    }



    public static function spOR(){
        $spor = OfficialReciepts::query()->orderBy('created_at', 'desc')->get();

        return $spor->mapWithKeys(function ($data){
            return [
                $data->or_no => $data->or_no,
            ];
        })->toArray();
    }

    public static function spStatus(){
        return [
            '114370' => '114370',
            '125093' => '125093',
            'CANCELLATION' => 'CANCELLATION',
            'CANCELLED' => 'CANCELLED',
            'CANCELLED ERROR IN PRINT' => 'CANCELLED ERROR IN PRINT',
            'ISSUED' => 'ISSUED',
            'RETURN SHIPMENT' => 'RETURN SHIPMENT',
            'SHUT-OUT' => 'SHUT-OUT',
            'TRANSHIPMENT' => 'TRANSHIPMENT',
            'W/ TRANSHIPMENT' => 'W/ TRANSHIPMENT',
        ];
    }

    public static function TXNType(){
        return [
                'CANCELLATION' => 'PENDING',
                'SHUTOUT' => 'SHIPPED',
                'TRANSHIPMENT' => 'CANCELLED',
                 'SHIPPING PERMIT' => 'CANCELLED',
        ];
    }

    public static function SugarClass(){
        return [
            'A' => 'A',
            'B' => 'B',
            'BD' => 'BD',
            'C' => 'C',
            'D' => 'D',
            'E' => 'E',
            'F' => 'F',
            'MUSCOVADO' => 'MUSCOVADO',
            'REFINED' => 'REFINED',
        ];
    }

    public static function orPayor(){
        $orp = Consignee::query()->get();

        return $orp->mapWithKeys(function ($data){
            return [
                $data->consignee_name => $data->consignee_name,
            ];
        })->toArray();
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