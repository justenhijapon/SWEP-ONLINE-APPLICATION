<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Helpers;
use App\Http\Requests\PapItemsFormRequest;
use App\Models\Pap;
use App\Models\PapItems;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PapItemsController extends Controller
{
    public function index($pap,Request $request){
        if($request->ajax() && $request->has('draw')){
            $papItems = PapItems::query()
                ->where('pap_code','=',$pap);
            return DataTables::of($papItems)
                ->addColumn('action',function($data){
                    return view('dashboard.pap_items.dtActions')->with([
                        'data' => $data,
                    ]);
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
        $pap = Pap::query()->where('pap_code','=',$pap)->first();
        $pap ?? abort(404,'Pap code not found.');
        return view('dashboard.pap_items.index')->with([
            'pap' => $pap,
        ]);
    }

    public function store($pap,PapItemsFormRequest $request){
        $papItem = new PapItems();
        $papItem->slug = Str::random();
        $papItem->pap_code = $pap;
        $papItem->item_no = $request->item_no;
        $papItem->item = $request->item;
        $papItem->unit_cost = $request->unit_cost;
        $papItem->qty = $request->qty;
        $papItem->uom = $request->uom;
        $papItem->total_budget = Helpers::sanitizeAutonum($request->total_budget);
        $papItem->mop = $request->mop;
        if($papItem->save()){
            return $papItem->only('slug');
        }
    }

    public function edit($slug){
        $papItem = PapItems::query()->where('slug','=',$slug)->first();
        $papItem ?? abort(404,'PAP Item not found.');
        return view('dashboard.pap_items.edit')->with([
            'pap_item' => $papItem,
        ]);
    }

    public function update(PapItemsFormRequest $request,$slug){
        $pap_item = PapItems::query()->where('slug','=',$slug)->first();
        $pap_item ?? abort(404,'PAP Item not found.');
        $pap_item->item_no = $request->item_no;
        $pap_item->item = $request->item;
        $pap_item->unit_cost = Helpers::sanitizeAutonum($request->unit_cost);
        $pap_item->qty = $request->qty;
        $pap_item->uom = $request->uom;
        $pap_item->total_budget = Helpers::sanitizeAutonum($request->total_budget);
        $pap_item->mop = $request->mop;
        if($pap_item->update()){
            return $pap_item->only('slug');
        }
    }

    public function destroy($slug){
        $pap_item = PapItems::query()->where('slug','=',$slug)->first();
        $pap_item ?? abort(404,'PAP Item not found.');
        if($pap_item->delete()){
            return 1;
        }
        abort(503,'Error deleting item.');
    }
}