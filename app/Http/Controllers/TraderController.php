<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trader\TraderFormRequest;
use App\Models\Trader;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TraderController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $trader = Trader::query();
            return datatables()->of($trader)
                ->addColumn('action', function($data){
                    return view('dashboard.trader.dtAction')->with([
                        'data' => $data,
                    ]);
                })
                ->rawColumns(['action'])
                ->setRowId('slug')
                ->make();
        }

        return view('dashboard.trader.index');
    }

    public function store(TraderFormRequest $request){


        $trader = new Trader();
        $trader->slug = Str::random(16);
        $trader->trader_name = $request->trader_name;
        $trader->trader_address = $request->trader_address;
        $trader->trader_tin = $request->trader_tin;
        $trader->created_at = Carbon::now();
        $trader->updated_at = Carbon::now();
        $trader->ip_created = $request->ip();
        $trader->ip_updated = $request->ip();

        if($trader->save()){

            return $trader->only('slug');
        }
    }

    public function destroy($slug){

        $trader = Trader::query()
            ->where('slug', $slug)
            ->first();
            $trader ?? abort(404,'Trader not found.');
        if($trader->delete()){
            return 1;
        }
    }

    public function edit($slug){

        $trader = Trader::query()
            ->where('slug', $slug)
            ->first();
            $trader ?? abort(404,'Trader not found.');
        return view('dashboard.trader.edit')->with([
            'trader'=>$trader,
        ]);
    }

    public function update(TraderFormRequest $request, $slug){


        $trader = Trader::query()
            ->where('slug', $slug)
            ->first();
            $trader ?? abort(404,'attributions not found.');

        $trader->trader_name = $request->trader_name;
        $trader->trader_address = $request->trader_address;
        $trader->trader_tin = $request->trader_tin;
        $trader->created_at = Carbon::now();
        $trader->updated_at = Carbon::now();
        $trader->ip_created = $request->ip();
        $trader->ip_updated = $request->ip();
        if($trader->update()){
            return $trader->only('slug');
        }

    }
}
