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
        $user = User::all();
        $totaluser = $user->count();
        $sp = ShippingPermit::all();
        $totalsp = $sp->count();
        $totalspdone = $sp->where('sp_status', 'SHIPPED')->count();
        $totalspcancelled = $sp->where('sp_status', 'CANCELLED')->all();
        $pendingsp = $sp->where('sp_status', 'PENDING')->all();
        $or = OfficialReciepts::all();
        $totalor = $or->count();
        $shipped = $sp->where('sp_status', 'SHIPPED')->count();
        $pending = $sp->where('sp_status', 'PENDING')->count();
        $cancelled = $sp->where('sp_status', 'CANCELLED')->count();
        $users = User::all();


        return view('dashboard.home.index')->with([
            'totaluser' => $totaluser,
            'totalsp' => $totalsp,
            'totalor' => $totalor,
            'totalspdone' => $totalspdone,
            'sp' => $sp,
            'pendingsp' => $pendingsp,
            'totalspcancelled' => $totalspcancelled,
            'shipped' => $shipped,
            'pending' => $pending,
            'cancelled' => $cancelled,
            'users' => $users,
        ]);

    }

    





}
