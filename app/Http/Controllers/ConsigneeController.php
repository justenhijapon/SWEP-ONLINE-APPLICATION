<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Consignee\ConsigneeFormRequest;
use App\Models\Consignee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConsigneeController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $consignee = Consignee::query();
            return datatables()->of($consignee)
                ->addColumn('action', function($data){
                    return view('dashboard.consignee.dtAction')->with([
                        'data' => $data,
                    ]);
                })
                ->rawColumns(['action'])
                ->setRowId('slug')
                ->make();
        }

        return view('dashboard.consignee.index');
    }

    public function store(ConsigneeFormRequest $request){


        $consignee = new Consignee();
        $consignee->slug = Str::random(16);
        $consignee->consignee_id = $request->consignee_id;
        $consignee->consignee_name = $request->consignee_name;
        $consignee->consignee_address = $request->consignee_address;
        $consignee->consignee_tin = $request->consignee_tin;
        $consignee->created_at = Carbon::now();
        $consignee->updated_at = Carbon::now();
        $consignee->ip_created = $request->ip();
        $consignee->ip_updated = $request->ip();

        if($consignee->save()){

            return $consignee->only('slug');
        }
    }

    public function destroy($slug){

        $consignee = Consignee::query()
            ->where('slug', $slug)
            ->first();
            $consignee ?? abort(404,'Consignee not found.');
        if($consignee->delete()){
            return 1;
        }
    }

    public function edit($slug){

        $consignee = Consignee::query()
            ->where('slug', $slug)
            ->first();
            $consignee ?? abort(404,'Consignee not found.');
        return view('dashboard.consignee.edit')->with([
            'consignee'=>$consignee,
        ]);
    }

    public function update(ConsigneeFormRequest $request, $slug){


        $consignee = Consignee::query()
            ->where('slug', $slug)
            ->first();
            $consignee ?? abort(404,'Consignee not found.');

        $consignee->consignee_id = $request->consignee_id;
        $consignee->consignee_name = $request->consignee_name;
        $consignee->consignee_address = $request->consignee_address;
        $consignee->consignee_tin = $request->consignee_tin;
        $consignee->created_at = Carbon::now();
        $consignee->updated_at = Carbon::now();
        $consignee->ip_created = $request->ip();
        $consignee->ip_updated = $request->ip();
        if($consignee->update()){
            return $consignee->only('slug');
        }

    }
}
