<?php

namespace App\Http\Controllers;

use App\Models\Pap;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PapController extends Controller
{
    public function index(Request $request){
        if($request->ajax() && $request->has('draw')){
            $paps = Pap::query();
            return DataTables::of($paps)
                ->addColumn('action',function($data){
                    return view('dashboard.pap.dtActions')->with([
                        'data' => $data,
                    ]);
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
        return view('dashboard.pap.index');
    }
}