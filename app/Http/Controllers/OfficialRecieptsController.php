<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Arrays;
use App\Core\Helpers\Helpers;
use App\Core\Helpers\TranslateTextHelper;
use App\Exports\OfficialRecieptsExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Official_reciepts\OfficialRecieptsFormRequest;
use App\Models\ActivityLogs;
use App\Models\OfficialReciepts;
use App\Models\OfficialRecieptUtilization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Rmunate\Utilities\SpellNumber;

class OfficialRecieptsController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $or = OfficialReciepts::query()->with([
                "orUtilization",
                "orShippingPermit",
                "orMIll_Origin"
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
//                    dd($data->orMIll_Origin->mill_name);
                    return $data->orMIll_Origin->mill_name ?? null;
                })

                ->rawColumns(['action'])
                ->setRowId('slug')
                ->make();
        }
        $or = OfficialReciepts::query()->with([
            "orMIll_Origin"
        ]);

        return view('dashboard.official_reciepts.index')->with([
            'or' => $or
        ]);
    }

    public function create(){
        return view('dashboard.official_reciepts.create');
    }

    public function store(OfficialRecieptsFormRequest $request){

        // Check if or_no already exists
        $existingOr = OfficialReciepts::where('or_no', $request->or_no)->first();
        if ($existingOr) {
            // Return a response with a notification message
            return response()->json(['message' => 'The Official Receipt number already exists.'], 422);
        }

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
        $or->or_total_paid = Helpers::sanitizeAutonum($request->or_total_paid);
        $or->or_cancellation = Helpers::sanitizeAutonum($request->or_cancellation);
        $or->or_shut_out = Helpers::sanitizeAutonum($request->or_shut_out);
        $or->or_transhipment = Helpers::sanitizeAutonum($request->or_transhipment);
        $or->or_shipping_permit = Helpers::sanitizeAutonum($request->or_shipping_permit);
        $or->or_other_fees = Helpers::sanitizeAutonum($request->or_other_fees);
        $or->or_other_fees_2 = Helpers::sanitizeAutonum($request->or_other_fees_2);
        $or->or_total_amount = Helpers::sanitizeAutonum($request->or_total_amount);
        $or->or_report_no = Helpers::sanitizeAutonum($request->or_report_no);

        $utilizationArray = [];
        foreach ((array) $request->items as $item){
            array_push($utilizationArray,[
                'slug' => Str::random(16),
                'or_slug' => $or->slug,
                'oru_txn_type' => $item['oru_txn_type'],
                'oru_sp_no' => $item['oru_sp_no'],
                'oru_volume' => $item['oru_volume'],
                'oru_amount' => Helpers::sanitizeAutonum($item['oru_amount']),
            ]);
        }

         $activitylogArray = [];
                array_push($activitylogArray,[
                    'module' => 'Official Receipts',
                    'event' => 'Create ',
                    'user_id' => Auth::user()->user_id,
                    'slug' => $or->slug,
                    'remarks' => "O.R. No: " .  $or->or_no,
                    'created_at' => Carbon::now(),
                ]);
        $or->created_at = Carbon::now();
        $or->updated_at = Carbon::now();
        $or->ip_created = $request->ip();
        $or->ip_updated = $request->ip();

        if($or->save()){
            OfficialRecieptUtilization::insert($utilizationArray);
            ActivityLogs::insert($activitylogArray);
            return $or->only('slug');
        }
    }

    public function destroy($slug){

        $or = OfficialReciepts::query()
            ->where('slug', $slug)
            ->first();
            $or ?? abort(404,'Shipping Permit not found.');
        $activitylogArray = [];
            array_push($activitylogArray,[
                'module' => 'Official Receipts',
                'event' => 'Delete ',
                'user_id' => Auth::user()->user_id,
                'slug' => $or->slug,
                'remarks' => "O.R. No: " .  $or->or_no,
                'created_at' => Carbon::now(),
            ]);
        if($or->delete()){
            ActivityLogs::insert($activitylogArray);
            $or->orUtilization()->delete();
            return 1;
        }
    }

    public function edit($slug){

        $or = OfficialReciepts::query()
            ->where('slug', $slug)
            ->first();
            $or ?? abort(404,'Seminar not found.');
//        $total = $or->orShippingPermit->sum('sp_amount');
        return view('dashboard.official_reciepts.edit')->with([
            'or'=>$or,
//            'total'=>$total,
        ]);
    }

    public function update(OfficialRecieptsFormRequest $request, $slug){
        $or = OfficialReciepts::query()
            ->where('slug', $slug)
            ->first();
            $or ?? abort(404, 'Seminar not found.');

        // Store original data
        $originalData = $or->toArray();

        // Update with new data
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
        $or->or_total_paid = Helpers::sanitizeAutonum($request->or_total_paid);
        $or->or_cancellation = Helpers::sanitizeAutonum($request->or_cancellation);
        $or->or_shut_out = Helpers::sanitizeAutonum($request->or_shut_out);
        $or->or_transhipment = Helpers::sanitizeAutonum($request->or_transhipment);
        $or->or_shipping_permit = Helpers::sanitizeAutonum($request->or_shipping_permit);
        $or->or_other_fees = Helpers::sanitizeAutonum($request->or_other_fees);
        $or->or_other_fees_2 = Helpers::sanitizeAutonum($request->or_other_fees_2);
        $or->or_total_amount = Helpers::sanitizeAutonum($request->or_total_amount);
        $or->or_report_no = Helpers::sanitizeAutonum($request->or_report_no);

        // Create utilization array
        $utilizationArray = [];
        foreach ((array) $request->items as $item) {
            // Check if 'slug' key exists in $item, otherwise set to null or handle accordingly
            $slug = isset($item['slug']) ? $item['slug'] : Str::random(16);

            // You can also use null coalescing operator if you're using PHP 7 or higher
            // $slug = $item['slug'] ?? null;


            array_push($utilizationArray, [
                'slug' => $slug,
                'or_slug' => $or->slug,
                'oru_txn_type' => $item['oru_txn_type'] ?? null,
                'oru_sp_no' => $item['oru_sp_no'] ?? null,
                'oru_volume' => $item['oru_volume'] ?? null,
                'oru_amount' => Helpers::sanitizeAutonum($item['oru_amount'] ?? null),
            ]);
        }



        //Activity log arrays
        $activitylogArray = [];
        $excludedFields = ['created_at', 'updated_at'];

        foreach ($originalData as $key => $value) {
            if (!in_array($key, $excludedFields) && $or[$key] != $value) {
                $oldValue = $value;
                $newValue = $or[$key];

                // Log the change for this field
                $remarks = ucfirst(str_replace('_', ' ', $key)) . ": $oldValue -> $newValue";

                array_push($activitylogArray, [
                    'module' => 'Official Receipts',
                    'event' => 'Update',
                    'user_id' => Auth::user()->user_id,
                    'slug' => $or->slug,
                    'remarks' => $remarks,
                    'created_at' => Carbon::now(),
                ]);
            }
        }


        // Activity log for utilization array changes
        $utilizationActivityLog = [];
//        $originalUtilization = [];
//        if (isset($or->orUtilization)) { // Check if utilization data exists
//            $originalUtilization = $or->orUtilization->toArray();
//        }
//
//        // Handle removed items
//        $removedItems = [];
//        foreach ($originalUtilization as $key => $oldData) {
//            if (!isset($utilizationArray[$key])) {
//                $removedItems[] = $oldData;
//            }
//        }
//
//        foreach ($removedItems as $key => $data) {
//            $remarks = "Item ". ($key + 1). ": Removed SP No." .$oldData['oru_sp_no'];
//            array_push($utilizationActivityLog, [
//                'module' => 'Official Receipts - Utilization',
//                'event' => 'Remove',
//                'user_id' => Auth::user()->user_id,
//                'slug' => $or->slug,
//                'remarks' => $remarks,
//                'created_at' => Carbon::now(),
//            ]);
//        }
//
//        foreach ($utilizationArray as $key => $newData) {
//            $oldValue = null;  // Initialize to null
//            $newValue = $newData;
//
//            // Check if original utilization data exists for this key
//            if (isset($originalUtilization[$key])) {
//                $oldValue = $originalUtilization[$key];
//            }
//
//            // Compare each field within the utilization data
//            $hasChanges = false;
//            foreach ($newData as $field => $value) {
//                // Only compare if both $oldValue and $newData have the field
//                if (is_array($oldValue) && isset($oldValue[$field]) && $oldValue[$field]!= $value) {
//                    $hasChanges = true;
//                    break; // Exit inner loop if a change is found
//                }
//            }
//
//            if ($hasChanges) {
//                $remarks = "Item " . ($key + 1). " " . $field . ": " . $oldValue[$field] . " -> " . $value;
//                array_push($utilizationActivityLog, [
//                    'module' => 'Official Receipts - Utilization',
//                    'event' => 'Update',
//                    'user_id' => Auth::user()->user_id,
//                    'slug' => $or->slug,
//                    'remarks' => $remarks,
//                    'created_at' => Carbon::now(),
//                ]);
//            }
//            if (!isset($originalUtilization[$key])) {
//                // Log activity for new item added
//                $remarks = "Item " . ($key + 1) . ": Added SP No. " . $newValue['oru_sp_no'];
//                array_push($utilizationActivityLog, [
//                    'module' => 'Official Receipts - Utilization',
//                    'event' => 'Add',
//                    'user_id' => Auth::user()->user_id,
//                    'slug' => $or->slug,
//                    'remarks' => $remarks,
//                    'created_at' => Carbon::now(),
//                ]);
//            }
//        }
        $originalUtilization = $or->orUtilization ? $or->orUtilization->toArray() : [];

        // Log removed items
        foreach ($originalUtilization as $key => $oldData) {
            if (!isset($utilizationArray[$key])) {
                $remarks = "Item " . ($key + 1) . ": Removed SP No. " . $oldData['oru_sp_no'];
                array_push($utilizationActivityLog, [
                    'module' => 'Official Receipts - Utilization',
                    'event' => 'Remove',
                    'user_id' => Auth::user()->user_id,
                    'slug' => $or->slug,
                    'remarks' => $remarks,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        // Log added and updated items
        foreach ($utilizationArray as $key => $newData) {
            if (!isset($originalUtilization[$key])) {
                // New item added
                $remarks = "Item " . ($key + 1) . ": Added SP No. " . $newData['oru_sp_no'];
                array_push($utilizationActivityLog, [
                    'module' => 'Official Receipts - Utilization',
                    'event' => 'Add',
                    'user_id' => Auth::user()->user_id,
                    'slug' => $or->slug,
                    'remarks' => $remarks,
                    'created_at' => Carbon::now(),
                ]);
            } else {
                // Check for updates
                foreach ($newData as $field => $value) {
                    if (isset($originalUtilization[$key][$field]) && $originalUtilization[$key][$field] != $value) {
                        $remarks = "Item " . ($key + 1) . " " . ucfirst(str_replace('_', ' ', $field)) . ": " . $originalUtilization[$key][$field] . " -> " . $value;
                        array_push($utilizationActivityLog, [
                            'module' => 'Official Receipts - Utilization',
                            'event' => 'Update',
                            'user_id' => Auth::user()->user_id,
                            'slug' => $or->slug,
                            'remarks' => $remarks,
                            'created_at' => Carbon::now(),
                        ]);
                    }
                }
            }
        }



        // Update timestamps and IP addresses
        $or->created_at = Carbon::now();
        $or->updated_at = Carbon::now();
        $or->ip_created = $request->ip();
        $or->ip_updated = $request->ip();

        // Perform update and log activities
        if ($or->update()) {
            // Insert activity logs if there are changes
            if (!empty($activitylogArray)) {
                ActivityLogs::insert($activitylogArray);
            }

            // Insert utilization activity logs
            if (!empty($utilizationActivityLog)) {
                ActivityLogs::insert($utilizationActivityLog);
            }

            $or->orUtilization()->delete();
            OfficialRecieptUtilization::insert($utilizationArray);
            return $or->only('slug');
        }
    }


    public function print($slug)
    {
        $print = OfficialReciepts::query()
            ->with([
                "orMIll_Origin",
                "orUtilization",
            ])
            ->where('slug', $slug)
            ->first();

        // Handle null value for or_total_amount
        $orAmount = optional($print)->or_total_amount ?? 0;

        // Ensure $orAmount is a float for consistent processing
        $orAmount = (float)$orAmount;

        // Convert the amount to a string representation in words
        if (strpos($orAmount, '.') !== false) {
            // If the amount has a decimal point, handle as float
            $word = SpellNumber::float($orAmount)->toLetters();
        } else {
            // Otherwise, handle as integer
            $word = SpellNumber::integer((int)$orAmount)->toLetters();
        }

        // Translate the word representation if needed
        $translated = TranslateTextHelper::translate($word);


        return view('printables.official_reciepts.print')->with([
            "print" => $print,
            'translated' => $translated,
        ]);
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

