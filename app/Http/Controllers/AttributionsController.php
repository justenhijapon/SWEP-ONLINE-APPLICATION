<?php

namespace App\Http\Controllers;
use App\Core\Helpers\Helpers;

use App\Http\Requests\Attributions\AttributionsFormRequest;
use App\Models\Attributions;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AttributionsController extends Controller
{

    public function index(Request $request){
        if($request->ajax())
        {
            $attributions = Attributions::query();
            return datatables()->of($attributions)
                ->addColumn('action', function($data){
                    return view('dashboard.attributions.dtActions')->with([
                        'data' => $data,
                    ]);
                })
                ->rawColumns(['action'])
                ->setRowId('slug')
                ->make();
        }

        return view('dashboard.attributions.index');
    }

    public function store(AttributionsFormRequest $request){


        $attributions = new Attributions();
        $attributions->slug = Str::random(16);
        $attributions->activity = $request->activity;
        $attributions->date = Carbon::parse($request->date)->format('Y-m-d');
        $attributions->project_code = $request->project_code;
        $attributions->item = $request->item;
        $attributions->venue = $request->venue;
        $attributions->details = $request->details;
        $attributions->utilized_fund = Helpers::sanitizeAutonum($request->utilized_fund);
        $attributions->created_at = Carbon::now();
        $attributions->updated_at = Carbon::now();
        $attributions->ip_created = $request->ip();
        $attributions->ip_updated = $request->ip();

        if($attributions->save()){
            return $attributions->only('slug');
        }
    }

    public function destroy($slug){

        $attributions = Attributions::query()
            ->where('slug', $slug)
            ->first();
            $attributions ?? abort(404,'Attributions not found.');
        if($attributions->delete()){
            return 1;
        }
    }

    public function edit($slug){

        $attributions = Attributions::query()
            ->where('slug', $slug)
            ->first();
            $attributions ?? abort(404,'attributions not found.');
        return view('dashboard.attributions.edit')->with([
            'attributions'=>$attributions,
        ]);
    }

    public function update(AttributionsFormRequest $request, $slug){


        $attributions = Attributions::query()
            ->where('slug', $slug)
            ->first();
        $attributions ?? abort(404,'attributions not found.');

        $attributions->activity = $request->activity;
        $attributions->date = Carbon::parse($request->date)->format('Y-m-d');
        $attributions->project_code = $request->project_code;
        $attributions->item = $request->item;
        $attributions->venue = $request->venue;
        $attributions->details = $request->details;
        $attributions->utilized_fund = Helpers::sanitizeAutonum($request->utilized_fund);
        $attributions->created_at = Carbon::now();
        $attributions->updated_at = Carbon::now();
        $attributions->ip_created = $request->ip();
        $attributions->ip_updated = $request->ip();
        if($attributions->update()){
            return $attributions->only('slug');
        }

    }


}
