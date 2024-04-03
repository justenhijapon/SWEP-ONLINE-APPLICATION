<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Origin\OriginFormRequest;
use App\Models\Origin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OriginController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $origin = Origin::query();
            return datatables()->of($origin)
                ->addColumn('action', function($data){
                    return view('dashboard.origin.dtAction')->with([
                        'data' => $data,
                    ]);
                })

                ->rawColumns(['action'])
                ->setRowId('slug')
                ->make();
        }

        return view('dashboard.origin.index');
    }

    public function store(OriginFormRequest $request){


        $origin = new Origin();
        $origin->slug = Str::random(16);
        $origin->origin = $request->origin;
        $origin->source = $request->source;
        $origin->name = $request->name;
        $origin->created_at = Carbon::now();
        $origin->updated_at = Carbon::now();
        $origin->ip_created = $request->ip();
        $origin->ip_updated = $request->ip();

        if($origin->save()){

            return $origin->only('slug');
        }
    }

    public function destroy($slug){

        $origin = Origin::query()
            ->where('slug', $slug)
            ->first();
            $origin ?? abort(404,'Origin not found.');
        if($origin->delete()){
            return 1;
        }
    }

    public function edit($slug){

        $origin = Origin::query()
            ->where('slug', $slug)
            ->first();
            $origin ?? abort(404,'Origin not found.');
        return view('dashboard.origin.edit')->with([
            'origin'=>$origin,
        ]);
    }

    public function update(OriginFormRequest $request, $slug){


        $origin = Origin::query()
            ->where('slug', $slug)
            ->first();
            $origin ?? abort(404,'attributions not found.');

        $origin->origin = $request->origin;
        $origin->source = $request->source;
        $origin->name = $request->name;
        $origin->created_at = Carbon::now();
        $origin->updated_at = Carbon::now();
        $origin->ip_created = $request->ip();
        $origin->ip_updated = $request->ip();
        if($origin->update()){
            return $origin->only('slug');
        }

    }
}
