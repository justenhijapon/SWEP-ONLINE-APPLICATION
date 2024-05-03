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

        $spAmount = array_slice(ShippingPermit::pluck('sp_amount')->toArray(), -4);
        $spDates = array_slice(ShippingPermit::pluck('sp_date')->toArray(), -4);
        $totalspcancelled = $sp->where('sp_status', 'CANCELLED')->all();
        $pendingsp = $sp->where('sp_status', 'PENDING')->all();
        $or = OfficialReciepts::all();
        $totalor = $or->count();
        $lsp = ShippingPermit::all();
        for ($i = 0; $i < 3; $i++) {
            $lsp->pop();
        }
        $lastSpDate = $lsp->last();


        return view('dashboard.home.index')->with([
            'users' => $users,
            'sp' => $sp,
            'lastSpDate' => $lastSpDate,
            'spDates' => $spDates,
            'spAmount' => $spAmount,
            'pendingsp' => $pendingsp,
            'totalspcancelled' => $totalspcancelled,
            'totalor' => $totalor,
        ]);

    }

    





}
