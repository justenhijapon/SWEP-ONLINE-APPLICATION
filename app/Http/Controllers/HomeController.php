<?php

namespace App\Http\Controllers;


use App\Core\Services\HomeService;
use App\Models\Consignee;
use App\Models\OfficialReciepts;
use App\Models\ShippingPermit;
use App\Models\User;


class HomeController extends Controller{




	protected $home;




    public function __construct(HomeService $home){

        $this->home = $home;

    }


    public function index(){
        $users = User::all();
        $sp = ShippingPermit::all();

        $spAmount = array_slice(ShippingPermit::where('sp_status', 'SHIPPED')->pluck('sp_amount')->toArray(), -10);
        $spAmountP = array_slice(ShippingPermit::where('sp_status', 'PENDING')->pluck('sp_amount')->toArray(), -10);
        $spAmountC = array_slice(ShippingPermit::where('sp_status', 'CANCELLED')->pluck('sp_amount')->toArray(), -10);
        $spDates = array_slice(ShippingPermit::where('sp_status', 'SHIPPED')->pluck('sp_date')->toArray(), -10);

        $totalspcancelled = $sp->where('sp_status', 'CANCELLED')->all();
        $pendingsp = $sp->where('sp_status', 'PENDING')->all();
        $or = OfficialReciepts::all();
        $totalor = $or->count();


        return view('dashboard.home.index')->with([
            'users' => $users,
            'sp' => $sp,
            'spDates' => $spDates,
            'spAmount' => $spAmount,
            'spAmountP' => $spAmountP,
            'spAmountC' => $spAmountC,
            'pendingsp' => $pendingsp,
            'totalspcancelled' => $totalspcancelled,
            'totalor' => $totalor,
        ]);

    }

    





}
