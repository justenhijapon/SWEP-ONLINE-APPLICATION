<?php

namespace App\Http\Controllers;

use App\Models\OfficialReciepts;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function get($for, Request $request){
        return $this->$for($request);
    }


    private function getMillFromOR(Request $request){
        $or = OfficialReciepts::query()
            ->where('or_no','=',$request->or_no)
            ->first();
        $or ?? abort(503,'OR not found');
        return [
            'or_date' => $or->or_date,
            'or_payor' => $or->or_payor,
            'sample' => $or->or_crop_year - $or->or_crop_year-1,
        ];
    }
}