<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\vessel\VesselFormRequest;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VesselController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $vessel = Vessel::query();
            return datatables()->of($vessel)
                ->addColumn('action', function($data){
                    return view('dashboard.vessel.dtAction')->with([
                        'data' => $data,
                    ]);
                })

                ->rawColumns(['action'])
                ->setRowId('slug')
                ->make();
        }

        return view('dashboard.vessel.index');
    }

    public function store(VesselFormRequest $request){


        $vessel = new Vessel();
        $vessel->slug = Str::random(16);
        $vessel->vessel_description = $request->vessel_description;
        $vessel->vessel_ship_operator = $request->vessel_ship_operator;


        if($vessel->save()){
            return $vessel->only('slug');
        }
    }

    public function destroy($slug){

        $vessel = vessel::query()
            ->where('slug', $slug)
            ->first();
            $vessel ?? abort(404,'Vessel not found.');
        if($vessel->delete()){
            return 1;
        }
    }

    public function edit($slug){

        $vessel = vessel::query()
            ->where('slug', $slug)
            ->first();
            $vessel ?? abort(404,'Seminar not found.');
        return view('dashboard.vessel.edit')->with([
            'vessel'=>$vessel,
        ]);
    }

    public function update(VesselFormRequest $request, $slug){


        $vessel = Vessel::query()
            ->where('slug', $slug)
            ->first();
            $vessel ?? abort(404,'Seminar not found.');
        $vessel->vessel_description = $request->vessel_description;
        $vessel->vessel_ship_operator = $request->vessel_ship_operator;

        if($vessel->update()){
            return $vessel->only('slug');
        }

    }
}
