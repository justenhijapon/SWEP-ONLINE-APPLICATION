<?php

namespace App\Http\Controllers\Guest;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Core\ViewHelpers\__html;
use illuminate\Support\Str;

class GuestController extends Controller {

    public function importedCommodities(Request $request){
        return view('landingPage.online-application.imported-commodities');

    }

}
