<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Arrays;
use App\Core\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Port\PortFormRequest;
use App\Models\Port;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $port = Port::query();
            return datatables()->of($port)
                ->addColumn('action', function($data){
                    return view('dashboard.port.dtAction')->with([
                        'data' => $data,
                    ]);
                })
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->setRowId('slug')
                ->make();
        }

        return view('dashboard.port.index');
    }


    public function store(PortFormRequest $request){


        $port = new Port();
        $port->slug = Str::random(16);
        $port->category = $request->category;
        $port->port_name = $request->port_name;
        $port->port_id = $request->port_id;
        $port->port_location = $request->port_location;
        $port->ship = $request->ship;
        $port->vessel = $request->vessel;
        $port->created_at = Carbon::now();
        $port->updated_at = Carbon::now();
        $port->ip_created = $request->ip();
        $port->ip_updated = $request->ip();

        if($port->save()){

            return $port->only('slug');
        }
    }

    public function destroy($slug){

        $port = Port::query()
            ->where('slug', $slug)
            ->first();
            $port ?? abort(404,'Port not found.');
        if($port->delete()){
            return 1;
        }
    }

    public function edit($slug){

        $port = Port::query()
            ->where('slug', $slug)
            ->first();
            $port ?? abort(404,'Port not found.');
        return view('dashboard.port.edit')->with([
            'port'=>$port,
        ]);
    }

    public function update(PortFormRequest $request, $slug){


        $port = Port::query()
            ->where('slug', $slug)
            ->first();
            $port ?? abort(404,'attributions not found.');

        $port->category = $request->category;
        $port->port_name = $request->port_name;
        $port->port_id = $request->port_id;
        $port->port_location = $request->port_location;
        $port->ship = $request->ship;
        $port->vessel = $request->vessel;
        $port->created_at = Carbon::now();
        $port->updated_at = Carbon::now();
        $port->ip_created = $request->ip();
        $port->ip_updated = $request->ip();
        if($port->update()){
            return $port->only('slug');
        }

    }
}
