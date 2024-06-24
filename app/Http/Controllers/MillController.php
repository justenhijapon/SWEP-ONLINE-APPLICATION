<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\mill\MillFormRequest;
use App\Models\Mill;
use App\Models\MillUtilization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MillController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $mill = Mill::query();
            return datatables()->of($mill)
                ->addColumn('action', function($data){
                    return view('dashboard.mill.dtAction')->with([
                        'data' => $data,
                    ]);
                })

                ->rawColumns(['action'])
                ->setRowId('slug')
                ->make();
        }

        return view('dashboard.mill.index');
    }

    public function store(MillFormRequest $request){


        $mill = new Mill();
        $mill->slug = Str::random(16);
        $mill->mill_code = $request->mill_code;
        $mill->mill_name = $request->mill_name;
        $mill->mill_address = $request->mill_address;

        $utilizationArray = [];
        foreach ((array) $request->items as $item){
            array_push($utilizationArray,[
                'slug' => $mill->slug,
                'mu_mill_code' => $mill->mill_code,
                'mu_marking_code' => $item['mu_marking_code'],
                'mu_description' => $item['mu_description'],
            ]);
        }


        if($mill->save()){
            MillUtilization::insert($utilizationArray);
            return $mill->only('slug');
        }
    }

    public function destroy($slug){

        $mill = Mill::query()
            ->where('slug', $slug)
            ->first();
            $mill ?? abort(404,'Shipping Permit not found.');
        if($mill->delete()){
            $mill->millUtilization()->delete();
            return 1;
        }
    }

    public function edit($slug){

        $mill = Mill::query()
            ->where('slug', $slug)
            ->first();
            $mill ?? abort(404,'Seminar not found.');
        return view('dashboard.mill.edit')->with([
            'mill'=>$mill,
        ]);
    }

    public function update(MillFormRequest $request, $slug){


        $mill = Mill::query()
            ->where('slug', $slug)
            ->first();
            $mill ?? abort(404,'Seminar not found.');
        $mill->mill_code = $request->mill_code;
        $mill->mill_name = $request->mill_name;
        $mill->mill_address = $request->mill_address;

        $utilizationArray = [];
        foreach ((array) $request->items as $item){
            array_push($utilizationArray,[
                'slug' => $mill->slug,
                'mu_mill_code' => $mill->mill_code,
                'mu_marking_code' => $item['mu_marking_code'],
                'mu_description' => $item['mu_description'],
            ]);
        }
        if($mill->update()){
            $mill->millUtilization()->delete();
            MillUtilization::insert($utilizationArray);
            return $mill->only('slug');
        }

    }
}
