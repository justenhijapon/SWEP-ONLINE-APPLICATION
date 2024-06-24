<?php

namespace App\Http\Controllers;

use App\Models\Consignee;
use App\Models\Mill;
use App\Models\MillUtilization;
use App\Models\OfficialReciepts;
use App\Models\Trader;
use App\Models\User;
use App\Models\Vessel;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function get($for, Request $request){
        return $this->$for($request);
    }


//    private function getMillFromOR(Request $request){
//        $or = OfficialReciepts::query()
//            ->where('or_no','=',$request->or_no)
//            ->first();
//        $or ?? abort(503,'OR not found');
//        return [
//            'or_date' => $or->or_date,
//            'or_payor' => $or->or_payor,
//            'sample' => $or->or_crop_year - $or->or_crop_year-1,
//        ];
//    }
    private function getMillUtilization(Request $request) {
        // Retrieve all mill objects based on the mill_code from the request
        $mills = MillUtilization::query()
            ->where('slug', '=', $request->mill_code)
            ->get();

        // Check if any mill objects are found; if not, abort with a 503 status
        if ($mills->isEmpty()) {
            abort(503, 'Mill not found');
        }

        // Initialize an array to store the mill data
        $millData = [];

        // Use a foreach loop to iterate over the mills and add their data to the millData array
        foreach ($mills as $mill) {
            $millData[] = $mill->toArray();
        }

        // Return the mill data as JSON response
        return response()->json(['millData' => $millData]);
    }


    private function getOfficerPosition(Request $request){
        $user = User::query()
            ->where('user_id','=',$request->user_id)
            ->first();
            $user ?? abort(503,'Consignee not found');
        return [
            'position' => $user->position,
        ];
    }
    private function getShipOperator(Request $request){
        $vessel = Vessel::query()
            ->where('vessel_description','=',$request->vessel_description)
            ->first();
            $vessel ?? abort(503,'Consignee not found');
        return [
            'vessel_ship_operator' => $vessel->vessel_ship_operator,
        ];
    }
    private function getTraderTinConsignee(Request $request){
        $trdr = Trader::query()
            ->where('trader_name','=',$request->trader_name)
            ->first();
            $trdr ?? abort(503,'Trader not found');
        return [
            'trader_address' => $trdr->trader_address,
            'trader_tin' => $trdr->trader_tin,

        ];
    }
    private function getAddressTinConsignee(Request $request){
        $con = Consignee::query()
            ->where('consignee_name','=',$request->consignee_name)
            ->first();
            $con ?? abort(503,'Consignee not found');
        return [
            'consignee_address' => $con->consignee_address,
            'consignee_tin' => $con->consignee_tin,

        ];
    }

}