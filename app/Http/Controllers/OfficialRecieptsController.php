<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Arrays;
use App\Core\Helpers\Helpers;
use App\Exports\OfficialRecieptsExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Official_reciepts\OfficialRecieptsFormRequest;
use App\Models\OfficialReciepts;
use App\Models\OfficialRecieptUtilization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class OfficialRecieptsController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $or = OfficialReciepts::query()->with([
                "orUtilization",
                "orShippingPermit"
            ]);


            return datatables()->of($or)
                ->addColumn('utilization', function($data){
                    return view('dashboard.official_reciepts.dtUtilization')->with([
                        'utilization' => $data->orUtilization,
                        "shippingpermit" => $data->orShippingPermit
                    ]);
                })
                ->addColumn('action', function($data){
                    return view('dashboard.official_reciepts.dtAction')->with([
                        'data' => $data,
                    ]);
                })

                ->rawColumns(['action'])
                ->setRowId('slug')
                ->make();
        }
        return view('dashboard.official_reciepts.index');
    }

    public function create(){
        return view('dashboard.official_reciepts.create');
    }

    public function store(OfficialRecieptsFormRequest $request){


        $or = new OfficialReciepts();
        $or->slug = Str::random(16);
        $or->or_no = $request->or_no;
        $or->or_date = Carbon::parse($request->or_date)->format('Y-m-d');
        $or->or_payor = $request->or_payor;
        $or->or_crop_year = $request->or_crop_year;
        $or->or_mill = $request->or_mill;
        $or->or_sugar_class = $request->or_sugar_class;
        $or->or_drawee_bank = $request->or_drawee_bank;
        $or->or_chk_acct_no = $request->or_chk_acct_no;
        $or->or_chk_no = $request->or_chk_no;
        $or->or_chk_date = Carbon::parse($request->or_chk_date)->format('Y-m-d');
        $or->or_cash_amount = Helpers::sanitizeAutonum($request->or_cash_amount);
        $or->or_check_amount = Helpers::sanitizeAutonum($request->or_check_amount);
        $or->or_money_order = Helpers::sanitizeAutonum($request->or_money_order);
        $or->or_money_order = Helpers::sanitizeAutonum($request->or_money_order);
        $or->or_total_paid = Helpers::sanitizeAutonum($request->or_total_paid);

//        $utilizationArray = [];
//        foreach ((array) $request->items as $item){
//            array_push($utilizationArray,[
//                'slug' => $or->slug,
//                'oru_txn_type' => $item['oru_txn_type'],
//                'oru_sp_no' => $item['oru_sp_no'],
//                'oru_volume' => $item['oru_volume'],
//                'oru_amount' => Helpers::sanitizeAutonum($item['oru_amount']),
//            ]);
//        }


        $or->created_at = Carbon::now();
        $or->updated_at = Carbon::now();
        $or->ip_created = $request->ip();
        $or->ip_updated = $request->ip();

        if($or->save()){
//            OfficialRecieptUtilization::insert($utilizationArray);
            return $or->only('slug');
        }
    }

    public function destroy($slug){

        $or = OfficialReciepts::query()
            ->where('slug', $slug)
            ->first();
            $or ?? abort(404,'Shipping Permit not found.');
        if($or->delete()){
            $or->orUtilization()->delete();
            return 1;
        }
    }

    public function edit($slug){

        $or = OfficialReciepts::query()
            ->where('slug', $slug)
            ->first();
            $or ?? abort(404,'Seminar not found.');
        $total = $or->orShippingPermit->sum('sp_amount');
        return view('dashboard.official_reciepts.edit')->with([
            'or'=>$or,
            'total'=>$total,
        ]);
    }

    public function update(OfficialRecieptsFormRequest $request, $slug){


        $or = OfficialReciepts::query()
            ->where('slug', $slug)
            ->first();
            $or ?? abort(404,'Seminar not found.');
        $or->or_no = $request->or_no;
        $or->or_date = Carbon::parse($request->or_date)->format('Y-m-d');
        $or->or_payor = $request->or_payor;
        $or->or_crop_year = $request->or_crop_year;
        $or->or_mill = $request->or_mill;
        $or->or_sugar_class = $request->or_sugar_class;
        $or->or_drawee_bank = $request->or_drawee_bank;
        $or->or_chk_acct_no = $request->or_chk_acct_no;
        $or->or_chk_no = $request->or_chk_no;
        $or->or_chk_date = Carbon::parse($request->or_chk_date)->format('Y-m-d');
        $or->or_cash_amount = Helpers::sanitizeAutonum($request->or_cash_amount);
        $or->or_check_amount = Helpers::sanitizeAutonum($request->or_check_amount);
        $or->or_money_order = Helpers::sanitizeAutonum($request->or_money_order);
        $or->or_money_order = Helpers::sanitizeAutonum($request->or_money_order);
        $or->or_total_paid = Helpers::sanitizeAutonum($request->or_total_paid);

//        $utilizationArray = [];
//        foreach ((array) $request->items as $item){
//            array_push($utilizationArray,[
//                'slug' => $or->slug,
//                'oru_txn_type' => $item['oru_txn_type'],
//                'oru_sp_no' => $item['oru_sp_no'],
//                'oru_volume' => $item['oru_volume'],
//                'oru_amount' => Helpers::sanitizeAutonum($item['oru_amount']),
//            ]);
//        }


        $or->created_at = Carbon::now();
        $or->updated_at = Carbon::now();
        $or->ip_created = $request->ip();
        $or->ip_updated = $request->ip();
        if($or->update()){
//            $or->orUtilization()->delete();
//            OfficialRecieptUtilization::insert($utilizationArray);
            return $or->only('slug');
        }

    }

    private function columns(){
        $columns = [
            "Numbering" => "numbering",
            "Date" => "or_date",
            "Official Reciept No" => "or_no",
            "Utilization"=>"utilization",

        ];
        return $columns;
    }

    public function reports(){
        $or = OfficialReciepts::query();

        return view('dashboard.official_reciepts.reports')->with([
            'columns' => $this->columns(),
            'or' => $or->get(),
        ]);
    }

    public function report_generate(Request $request){
        $type = $request->get('layout');
        $or = OfficialReciepts::query()
            ->with([
                "orUtilization",
                "orShippingPermit",
            ]);


        $filters = [];

        foreach ($request->all() as $key => $value) {
            if(!is_array($value)){
                if($key != "layout" and $value != null){
                    array_push($filters, $value);
                }
            }
        }

        if(!empty($request->date_range)){
            $date_range = "";
            $date_range = explode('-', $request->date_range);
            foreach ($date_range as $key => $value) {
                $date_range[$key] = date("Ymd",strtotime($value));
            }
            $df = $date_range[0];
            $dt = $date_range[1];

            $or = $or->whereBetween('or_date',[$df,$dt]);

        }

        if($type == "all"){
            if($request->excel == true){

                return Excel::download(new OfficialRecieptsExport($request->get('columns'),$or->get(),$this->columns()), 'official_receipts_report.xlsx');
            }
            return view('printables.official_reciepts.list_all')->with([
                'or' => $or->get(),
                'columns_chosen' => $request->get('columns'),
                'columns' => $this->columns(),
                'filters'=> $filters,

            ]);
        }


    }
}

