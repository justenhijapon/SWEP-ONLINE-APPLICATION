<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sugar_Liens\SugarLiensFormRequest;
use App\Models\SugarLiens;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SugarLiensController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $sl = SugarLiens::query();
            return datatables()->of($sl)
                ->addColumn('action', function($data){
                    return view('dashboard.sugar_liens.dtAction')->with([
                        'data' => $data,
                    ]);
                })

                ->rawColumns(['action'])
                ->setRowId('slug')
                ->make();
        }

        return view('dashboard.sugar_liens.index');
    }

    public function store(SugarLiensFormRequest $request){


        $sl = new SugarLiens();
        $sl->slug = Str::random(16);
        $sl->sl_description = $request->sl_description;
        $sl->sl_factor = $request->sl_factor;


        if($sl->save()){
            return $sl->only('slug');
        }
    }

    public function destroy($slug){

        $sl = SugarLiens::query()
            ->where('slug', $slug)
            ->first();
            $sl ?? abort(404,'Sugar Liens not found.');
        if($sl->delete()){
            return 1;
        }
    }

    public function edit($slug){

        $sl = SugarLiens::query()
            ->where('slug', $slug)
            ->first();
            $sl ?? abort(404,'Seminar not found.');
        return view('dashboard.sugar_liens.edit')->with([
            'sl'=>$sl,
        ]);
    }

    public function update(SugarLiensFormRequest $request, $slug){


        $sl = SugarLiens::query()
            ->where('slug', $slug)
            ->first();
            $sl ?? abort(404,'Seminar not found.');
        $sl->sl_description = $request->sl_description;
        $sl->sl_factor = $request->sl_factor;

        if($sl->update()){
            return $sl->only('slug');
        }

    }
}
