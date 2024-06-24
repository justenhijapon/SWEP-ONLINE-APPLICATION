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
                ->editColumn('or_mill', function($data){
                    return $data->orMIll_Origin->mill_name ?? null;
                })

                ->rawColumns(['action'])
                ->setRowId('slug')
                ->make();
        }
        return view('dashboard.official_reciepts.index')->with([
            'or' => OfficialReciepts::all()
        ]);
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

        $utilizationArray = [];
        foreach ((array) $request->items as $item){
            array_push($utilizationArray,[
                'slug' => $or->slug,
                'oru_txn_type' => $item['oru_txn_type'],
                'oru_sp_no' => $item['oru_sp_no'],
                'oru_volume' => $item['oru_volume'],
                'oru_amount' => Helpers::sanitizeAutonum($item['oru_amount']),
            ]);
        }


        $or->created_at = Carbon::now();
        $or->updated_at = Carbon::now();
        $or->ip_created = $request->ip();
        $or->ip_updated = $request->ip();

        if($or->save()){
            OfficialRecieptUtilization::insert($utilizationArray);
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
        $or->or_mill = $request->or_mill;
        $or->or_sugar_class = $request->or_sugar_class;
        $or->or_payor = $request->or_payor;
        $or->or_crop_year = $request->or_crop_year;
        $or->or_drawee_bank = $request->or_drawee_bank;
        $or->or_chk_acct_no = $request->or_chk_acct_no;
        $or->or_chk_no = $request->or_chk_no;
        $or->or_chk_date = Carbon::parse($request->or_chk_date)->format('Y-m-d');
        $or->or_cash_amount = Helpers::sanitizeAutonum($request->or_cash_amount);
        $or->or_check_amount = Helpers::sanitizeAutonum($request->or_check_amount);
        $or->or_money_order = Helpers::sanitizeAutonum($request->or_money_order);
        $or->or_money_order = Helpers::sanitizeAutonum($request->or_money_order);
        $or->or_total_paid = Helpers::sanitizeAutonum($request->or_total_paid);

        $utilizationArray = [];
        foreach ((array) $request->items as $item){
            array_push($utilizationArray,[
                'slug' => $or->slug,
                'oru_txn_type' => $item['oru_txn_type'],
                'oru_sp_no' => $item['oru_sp_no'],
                'oru_volume' => $item['oru_volume'],
                'oru_amount' => Helpers::sanitizeAutonum($item['oru_amount']),
            ]);
        }


        $or->created_at = Carbon::now();
        $or->updated_at = Carbon::now();
        $or->ip_created = $request->ip();
        $or->ip_updated = $request->ip();
        if($or->update()){
            $or->orUtilization()->delete();
            OfficialRecieptUtilization::insert($utilizationArray);
            return $or->only('slug');
        }

    }

    private function columns(){
        $columns = [
            "Numbering" => "numbering",
            "Date" => "or_date",
            "Official Reciept No." => "or_no",
            "Payor"=>"or_payor",
            "Crop Year"=>"or_crop_year",
            "Mill"=>"or_mill",
            "Sugar Class"=>"or_sugar_class",
            "Drawee Bank"=>"or_drawee_bank",
            "Cheque Account No."=>"or_chk_acct_no",
            "Cheque No."=>"or_chk_no",
            "Cheque date"=>"or_chk_date",
            "Cash Amount"=>"or_cash_amount",
            "Check Amount"=>"or_check_amount",
            "Money Order"=>"or_money_order",
            "Total Paid"=>"or_total_paid",
            "Cancellation"=>"or_cancellation",
            "Shut Out"=>"or_shut_out",
            "Transhipment"=>"or_transhipment",
            "Other Fees"=>"or_other_fees",
            "Other Fees "=>"or_other_fees_2",
            "Total Amount"=>"or_total_amount",
            "Report No."=>"or_report_no",
            "Shipping Permits"=>"orShippingPermit",


        ];
        return $columns;
    }

    public function reports(){
        $or = OfficialReciepts::query()->with([
//                "orShippingPermit",
            "orUtilization",
            "orMIll_Origin",
        ]);

        return view('dashboard.official_reciepts.reports')->with([
            'columns' => $this->columns(),
            'or' => $or->get(),
        ]);
    }

    public function report_generate(Request $request){
        $type = $request->get('layout');
        $or = OfficialReciepts::query()
            ->with([
//                "orShippingPermit",
                "orUtilization",
                "orMIll_Origin",
            ]);

        $fields = [
            'or_payor' => $request->or_payor,
            'or_crop_year' => $request->or_crop_year,
            'or_mill' => $request->or_mill,
            'or_sugar_class'=> $request->or_sugar_class,
            'or_drawee_bank' => $request->or_drawee_bank,
            'or_cancellation' => $request->or_cancellation,
            'or_shut_out' => $request->or_shut_out,
            'or_transhipment' => $request->or_transhipment,
            'or_other_fees' => $request->or_other_fees,
        ];

        foreach ($fields as $field => $value) {
            if ($value != "" && $value != "all") {
                $or = $or->where($field, "=", $value);
            }
        }


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
        $or = $or->get();
        $types = [$type];

        if($type == "all"){
            if($request->excel == true){

                return Excel::download(new OfficialRecieptsExport($request->get('columns'),$or,$this->columns()), 'Official Reciept Report ' . date('d-m-Y') . '.xlsx');
            }
            return view('printables.official_reciepts.list_all')->with([
                'or' => $or,
                'columns_chosen' => $request->get('columns'),
                'columns' => $this->columns(),
                'filters'=> $filters,
                'types' => $types,
            ]);
        }

        return $this->generateGroupedReport($request, $or, $type, $filters);
    }

    private function generateGroupedReport(Request $request, $or, $type, $filters) {
        $group_array = [];
        switch ($type) {
            case "or_payor":
                foreach ($or as $data) {
                    $group_array[$data->or_payor][$data->slug] = $data;
                }
                $or = $or->sortByDesc('or_payor');
                break;
            case "or_crop_year":
                foreach ($or as $data) {
                    $group_array[$data->or_crop_year][$data->slug] = $data;
                }
                $or = $or->sortByDesc('or_crop_year');
                break;
            case "or_mill":
                foreach ($or as $data) {
                    $group_array[$data->or_mill][$data->slug] = $data;
                }
                $or = $or->sortByDesc('or_mill');
                break;
            case "or_sugar_class":
                foreach ($or as $data) {
                    $group_array[$data->or_sugar_class][$data->slug] = $data;
                }
                $or = $or->sortByDesc('or_sugar_class');
                break;
            case "or_drawee_bank":
                foreach ($or as $data) {
                    $group_array[$data->or_drawee_bank][$data->slug] = $data;
                }
                $or = $or->sortByDesc('or_drawee_bank');
                break;
            case "or_cancellation":
                foreach ($or as $data) {
                    $group_array[$data->or_cancellation][$data->slug] = $data;
                }
                $or = $or->sortByDesc('or_cancellation');
                break;
            case "or_shut_out":
                foreach ($or as $data) {
                    $group_array[$data->or_shut_out][$data->slug] = $data;
                }
                $or = $or->sortByDesc('or_shut_out');
                break;
            case "or_transhipment":
                foreach ($or as $data) {
                    $group_array[$data->or_transhipment][$data->slug] = $data;
                }
                $or = $or->sortByDesc('or_transhipment');
                break;
            case "or_other_fees":
                foreach ($or as $data) {
                    $group_array[$data->or_other_fees][$data->slug] = $data;
                }
                $or = $or->sortByDesc('or_other_fees');
                break;
            default:
                break;
        }

        if ($request->excel == true) {
            $groupedBy = match ($type) {
                'or_payor' => 'Payor',
                'or_crop_year' => 'Crop Year',
                'or_mill' => 'Mill',
                'or_sugar_class' => 'Sugar Class',
                'or_drawee_bank' => 'Drawee Bank',
                'or_cancellation' => 'Cancellation',
                'or_shut_out' => 'Shut Out',
                'or_transhipment' => 'Transhipment',
                'or_other_fees' => 'Other Fees',
                default => $type,
            };
            return Excel::download(new OfficialRecieptsExport(
                $request->get('columns'),
                $or,
                $this->columns(),
                $group_array,
            ), 'Grouped by ' . $groupedBy . ' Official Receipt Report ' . date('d-m-Y') . '.xlsx');
        }


        return view('printables.official_reciepts.grouped_list')->with([
            'or' => $or,
            'group_array' => $group_array,
            'columns_chosen' => $request->get('columns'),
            'columns' => $this->columns(),
            'filters' => $filters,
            'types' => [$type]
        ]);
    }
}

