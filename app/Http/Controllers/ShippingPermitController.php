<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Helpers;
use App\Core\Helpers\TranslateTextHelper;
use App\Exports\GroupedShippingPermitExport;
use App\Exports\ShippingPermitExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shipping_Permit\ShippingPermitFormRequest;
use App\Models\ActivityLogs;
use App\Models\OfficialReciepts;
use App\Models\Origin;
use App\Models\Port;
use App\Models\ShippingPermit;
use App\Models\VolumeModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\PDF;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\Location;
use Rmunate\Utilities\SpellNumber;


class ShippingPermitController extends Controller
{
    public function create(){
        return view('dashboard.shipping_permits.create');
    }
    public function index(Request $request){
        $spor = OfficialReciepts::all();
        $port = Port::all();
//        $mill = Origin::all();

        if($request->ajax())
        {
            $sp = ShippingPermit::query()->with(["spMIll_Origin"]);
            return datatables()->of($sp)
                ->addColumn('action', function($data){
                    return view('dashboard.shipping_permits.dtAction')->with([
                        'data' => $data,
                    ]);
                })
                ->editColumn('sp_status', function($data) {
                    switch($data->sp_status) {
                        case 'TRANSHIPMENT':
                        case 'W/ TRANSHIPMENT':
                            return '<span class="label bg-orange col-md-12">'.$data->sp_status.'</span>';
                        case 'ISSUED':
                            return '<span class="label bg-green col-md-12">'.$data->sp_status.'</span>';
                        case 'CANCELLATION':
                        case 'CANCELLED':
                        case 'CANCELLED ERROR IN PRINT':
                        case 'SHUT-OUT':
                            return '<span class="label bg-red col-md-12">'.$data->sp_status.'</span>';
                        default:
                            return '<span class="label bg-blue col-md-12">'.$data->sp_status.'</span>'; // Handle other statuses if necessary
                    }
                })

                ->addColumn('sp_origin_destination', function($data){
                    return view("dashboard.shipping_permits.DTOriginDest")->with(["data"=>$data]);
                })

                ->addColumn('sp_other_details', function($data){
                    return view("dashboard.shipping_permits.DTOtherDetails")->with(["data"=>$data]);
                })

//                ->editColumn('sp_port_of_origin', function($data){
//                    return $data->portOfOrigin->port_name ?? null;
//                })
//                ->editColumn('sp_port_of_destination', function($data){
//                    return $data->portOfDestination->port_name ?? null;
//                })
                ->editColumn('sp_mill', function($data){
                    return view("dashboard.shipping_permits.DTMillMark")->with(["data"=>$data]);
                })
                ->editColumn('sp_date', function($data){
                    return Carbon::parse($data->sp_date)->format("M. d, Y");
                })

                ->escapeColumns([])
                ->rawColumns(['action'])
                ->setRowId('slug')
                ->make();
        }

        return view('dashboard.shipping_permits.index')->with([
            'spor' => $spor,
            'port' => $port,
//            'mill' => $mill,
            'sp' => ShippingPermit::query(),
        ]);
    }

    public function store(ShippingPermitFormRequest $request) {
        // Check if sp_no already exists
        $existingSp = ShippingPermit::where('sp_no', $request->sp_no)->first();
        if ($existingSp) {
            // Return a response with a notification message
            return response()->json(['message' => 'The Shipping Permit number already exists.'], 422);
        }

        $sp = new ShippingPermit();
        $sp->slug = Str::random(16);
        $sp->sp_no = $request->sp_no;
        $sp->sp_edd_etd = Carbon::parse($request->sp_edd_etd)->format('Y-m-d');
        $sp->sp_date = Carbon::parse($request->sp_date)->format('Y-m-d');
        $sp->sp_eda_eta = Carbon::parse($request->sp_eda_eta)->format('Y-m-d');
        $sp->sp_port_of_origin = $request->sp_port_of_origin;
        $sp->sp_mill = $request->sp_mill;
        $sp->sp_port_of_destination = $request->sp_port_of_destination;
        $sp->sp_sugar_class = $request->sp_sugar_class;
        $sp->sp_vessel = $request->sp_vessel;
        $sp->sp_volume = $request->sp_volume;
        $sp->sp_ship_operator = $request->sp_ship_operator;
        $sp->sp_uom = $request->sp_uom;
        $sp->sp_freight = $request->sp_freight;
        $sp->sp_plate_no = $request->sp_plate_no;
        $sp->sp_or_no = $request->sp_or_no;
        $sp->sp_remarks = $request->sp_remarks;
        $sp->sp_amount = $request->sp_amount !== null ? Helpers::sanitizeAutonum($request->sp_amount) : 0;
        $sp->sp_ref_sp_no = $request->sp_ref_sp_no;
        $sp->sp_status = $request->sp_status;
        $sp->sp_markings = $request->sp_markings;
        $sp->sp_collecting_officer = $request->sp_collecting_officer;
        $sp->sp_collecting_officer_position = $request->sp_collecting_officer_position;
        $sp->sp_shipper = $request->sp_shipper;
        $sp->sp_shipper_add = $request->sp_shipper_add;
        $sp->sp_shipper_tin = $request->sp_shipper_tin;
        $sp->sp_consignee = $request->sp_consignee;
        $sp->sp_consignee_add = $request->sp_consignee_add;
        $sp->sp_consignee_tin = $request->sp_consignee_tin;
        $sp->created_at = Carbon::now();
        $sp->updated_at = Carbon::now();
        $sp->ip_created = $request->ip();
        $sp->ip_updated = $request->ip();

        $activitylogArray = [];
        array_push($activitylogArray,[
            'module' => 'Shipping Permit',
            'event' => 'Create',
            'user_id' => Auth::user()->user_id,
            'slug' => $sp->slug,
            'remarks' => "No: " .  $sp->sp_no,
            'created_at' => Carbon::now(),
        ]);

//        $spvolume = [];
//        array_push($spvolume,[
//            'slug' => Str::random(12),
//            'sp_slug' => $sp->slug,
//            'crop_year' => $request->crop_year,
//            'sro_number' => $request->sro_number,
//            'amount' => $request->amount,
//        ]);

        $spvolume = [];
        foreach ((array) $request->items as $item){
            array_push($spvolume,[
                'slug' => Str::random(12),
                'sp_slug' => $sp->slug,
                'crop_year' => $item['crop_year'],
                'sro_number' => $item['sro_number'],
                'amount' => Helpers::sanitizeAutonum($item['amount']),
            ]);
        }


        if ($sp->save()) {
            ActivityLogs::insert($activitylogArray);
            VolumeModel::insert($spvolume);
            return response()->json(['slug' => $sp->slug]);
        }
    }


    public function destroy($slug){

        $sp = ShippingPermit::query()
            ->where('slug', $slug)
            ->first();
            $sp ?? abort(404,'Shipping Permit not found.');
        $activitylogArray = [];
        array_push($activitylogArray,[
            'module' => 'Shipping Permit',
            'event' => 'Delete',
            'user_id' => Auth::user()->user_id,
            'slug' => $sp->slug,
            'remarks' => "No: " . $sp->sp_no,
            'created_at' => Carbon::now(),
        ]);
        if($sp->delete()){
            ActivityLogs::insert($activitylogArray);
            return 1;
        }
    }

    public function edit($slug){

        $sp = ShippingPermit::query()
            ->where('slug', $slug)
            ->first();
            $sp ?? abort(404,'Shipping Permit not found.');
        return view('dashboard.shipping_permits.edit')->with([
            'sp' => $sp,
        ]);
    }

    public function update(ShippingPermitFormRequest $request, $slug){


        $sp = ShippingPermit::query()
            ->where('slug', $slug)
            ->first();
            $sp ?? abort(404,'Shipping Permit not found.');

        // Store original data
        $originalData = $sp->toArray();

        $sp->sp_no = $request->sp_no;
        $sp->sp_edd_etd = Carbon::parse($request->sp_edd_etd)->format('Y-m-d');
        $sp->sp_date = Carbon::parse($request->sp_date)->format('Y-m-d');
        $sp->sp_eda_eta = Carbon::parse($request->sp_eda_eta)->format('Y-m-d');
        $sp->sp_port_of_origin = $request->sp_port_of_origin;
        $sp->sp_mill = $request->sp_mill;
        $sp->sp_port_of_destination = $request->sp_port_of_destination;
        $sp->sp_sugar_class = $request->sp_sugar_class;
        $sp->sp_vessel = $request->sp_vessel;
        $sp->sp_volume = $request->sp_volume;
        $sp->sp_ship_operator = $request->sp_ship_operator;
        $sp->sp_uom = $request->sp_uom;
        $sp->sp_freight = $request->sp_freight;
        $sp->sp_plate_no = $request->sp_plate_no;
        $sp->sp_or_no = $request->sp_or_no;
        $sp->sp_remarks = $request->sp_remarks;
        $sp->sp_amount = $request->sp_amount !== null ? Helpers::sanitizeAutonum($request->sp_amount) : 0;
        $sp->sp_ref_sp_no = $request->sp_ref_sp_no;
        $sp->sp_status = $request->sp_status;
        $sp->sp_markings = $request->sp_markings;
        $sp->sp_collecting_officer = $request->sp_collecting_officer;
        $sp->sp_collecting_officer_position = $request->sp_collecting_officer_position;
        $sp->sp_shipper = $request->sp_shipper;
        $sp->sp_shipper_add = $request->sp_shipper_add;
        $sp->sp_shipper_tin = $request->sp_shipper_tin;
        $sp->sp_consignee = $request->sp_consignee;
        $sp->sp_consignee_add = $request->sp_consignee_add;
        $sp->sp_consignee_tin = $request->sp_consignee_tin;
        $sp->created_at = Carbon::now();
        $sp->updated_at = Carbon::now();
        $sp->ip_created = $request->ip();
        $sp->ip_updated = $request->ip();

        // Prepare activity log array
        $activitylogArray = [];
        $remarks = "Changes: \n";
        $excludedFields = ['created_at', 'updated_at'];

        foreach ($originalData as $key => $value) {
            if (!in_array($key, $excludedFields) && $sp[$key] != $value) {
                $remarks .= ucfirst(str_replace('_', ' ', $key)) . ": $value -> " . $sp[$key] . "\n";
            }
        }
        array_push($activitylogArray,[
            'module' => 'Shipping Permit',
            'event' => 'Update',
            'user_id' => Auth::user()->user_id,
            'slug' => $sp->slug,
            'remarks' => $remarks,
            'created_at' => Carbon::now(),
        ]);

        // Create utilization array
        $sp_utilizationArray = [];
        foreach ((array) $request->items as $item) {
            // Check if 'slug' key exists in $item, otherwise set to null or handle accordingly
            $slug = isset($item['slug']) ? $item['slug'] : Str::random(16);

            // You can also use null coalescing operator if you're using PHP 7 or higher
            // $slug = $item['slug'] ?? null;


            array_push($sp_utilizationArray, [
                'slug' => Str::random(12),
                'sp_slug' => $sp->slug,
                'crop_year' => $item['crop_year'],
                'sro_number' => $item['sro_number'],
                'amount' => Helpers::sanitizeAutonum($item['amount']),
            ]);
        }

        if($sp->update()){
            $sp->spUtilization()->delete();
            VolumeModel::insert($sp_utilizationArray);

            ActivityLogs::insert($activitylogArray);
            return $sp->only('slug');
        }

    }

    public function changeStatus($slug, $type)
    {
        $sp = ShippingPermit::query()
            ->where('slug', $slug)
            ->first();
            $sp ?? abort(404, 'Shipping Permit not found.');

        // Store original status
        $originalStatus = $sp->sp_status;

        // Update the status
        $sp->sp_status = strtoupper($type);

        // Prepare activity log array
        $activitylogArray = [];
        $remarks = "Status: $originalStatus -> " . $sp->sp_status . "\n";

        array_push($activitylogArray, [
            'module' => 'Shipping Permit',
            'event' => 'Change Status',
            'user_id' => Auth::user()->user_id,
            'slug' => $sp->slug,
            'remarks' => $remarks,
            'created_at' => Carbon::now(),
        ]);

        // Perform update and log activities
        if ($sp->update()) {
            ActivityLogs::insert($activitylogArray);
            return $sp->only('slug');
        }
    }


//    public function print($slug){
//        $sp = ShippingPermit::where('slug', $slug)->get();
//        return
//            view('printables.testprint')>with([
//                'sp' => $sp,
//            ]);
//    }

    public function print($slug)
    {
        $print = ShippingPermit::query()
            ->with([
                "spCollecting_Officer",
                "spMIll_Origin",
            ])
            ->where('slug', $slug)
            ->first();

        // Handle null value for sp_volume
        $spVolume = optional($print)->sp_volume ?? 0;  // Default to 0 if sp_volume is null
        $word = SpellNumber::integer($spVolume)->toLetters();
        $translated = TranslateTextHelper::translate($word);

        return view('printables.shipping_permits.print')->with([
            "print" => $print,
            'translated' => $translated,
        ]);
    }

    private function columns(){
        $columns = [
            "Numbering" => "numbering",
            "OR. No." => "sp_or_no",
            "Shipping Permit No" => "sp_no",
            "Date" => "sp_date",
            "EDD/ETD" => "sp_edd_etd",
            "EDA/ETA" => "sp_eda_eta",
            "Port of Origin" => "sp_port_of_origin",
            "Port of Destination" => "sp_port_of_destination",
            "Vessel" => "sp_vessel",
            "Ship Operator" => "sp_ship_operator",
            "Freight" => "sp_freight",
            "Plate No." => "sp_plate_no",
            "Remarks" => "sp_remarks",
            "Reference SP No." => "sp_ref_sp_no",
            "Mill" => "sp_mill",
            "Sugar Class" => "sp_sugar_class",
            "Volume" => "sp_volume",
            "UOM" => "sp_uom",
            "Amount" => "sp_amount",
            "Status" => "sp_status",
            "Markings" => "sp_markings",
            "Shipper" => "sp_shipper",
            "Shipper Address" => "sp_shipper_add",
            "Shipper Tin" => "sp_shipper_tin",
            "Consignee" => "sp_consignee",
            "Consignee Address" => "sp_consignee_add",
            "Consignee Tin" => "sp_consignee_tin",
            "Collecting Officer" => "sp_collecting_officer",
        ];
        return $columns;
    }
    public function reports(){
        $sp = ShippingPermit::query()
            ->with([
                "spCollecting_Officer",
                "spMIll_Origin",
            ]);
        return view('dashboard.shipping_permits.reports')->with([
            'columns' => $this->columns(),
            'sp' => $sp->get(),
        ]);
    }

    public function report_generate(Request $request){
        $type = $request->get('layout');
        $sp = ShippingPermit::query()
            ->with([
                "spCollecting_Officer",
                "spMIll_Origin",
            ]);

        $fields = [
            'sp_or_no' => $request->sp_or_no,
            'sp_status' => $request->sp_status,
            'sp_mill' => $request->sp_mill,
            'sp_ref_sp_no'=> $request->sp_ref_sp_no,
            'sp_sugar_class' => $request->sp_sugar_class,
            'sp_port_of_origin' => $request->sp_port_of_origin,
            'sp_port_of_destination' => $request->sp_port_of_destination,
            'sp_vessel' => $request->sp_vessel,
            'sp_shipper' => $request->sp_shipper,
            'sp_consignee' => $request->sp_consignee,
            'sp_collecting_officer' => $request->sp_collecting_officer,
        ];

        foreach ($fields as $field => $value) {
            if ($value != "" && $value != "all") {
                $sp = $sp->where($field, "=", $value);
            }
        }


        $filters = [];

        foreach ($request->all() as $key => $value) {
            if(!is_array($value)){
                if($key != "layout" && $value != null){
                    array_push($filters, $value);
                }
            }
        }

        function applyDateRangeFilter($request, $field, $column, $sp) {
            if (!empty($request->$field)) {
                $date_range = array_map(function($value) {
                    return date("Ymd", strtotime($value));
                }, explode('-', $request->$field));

                $df = $date_range[0];
                $dt = $date_range[1];

                $sp = $sp->whereBetween($column, [$df, $dt]);
            }
            return $sp;
        }

        $sp = applyDateRangeFilter($request, 'date_range', 'sp_date', $sp);
        $sp = applyDateRangeFilter($request, 'date_range_1', 'sp_edd_etd', $sp);
        $sp = applyDateRangeFilter($request, 'date_range_2', 'sp_eda_eta', $sp);


        $sp = $sp->get();
        $types = [$type]; // Ensure $type is an array

        if ($type == "all") {
            if ($request->excel == true) {
                return Excel::download(
                    new ShippingPermitExport($request->get('columns'), $sp, $this->columns()),
                    'Shipping Permit Report ' . date('d-m-Y') . '.xlsx'
                );
            }
            return view('printables.shipping_permits.list_all')->with([
                'sp' => $sp,
                'columns_chosen' => $request->get('columns'),
                'columns' => $this->columns(),
                'filters' => $filters,
                'types' => $types,
            ]);
        }

        return $this->generateGroupedReport($request, $sp, $type, $filters);
    }

    private function generateGroupedReport(Request $request, $sp, $type, $filters) {
        $group_array = [];

        switch ($type) {
            case "sp_or_no":
                foreach ($sp as $data) {
                    $group_array[$data->sp_or_no][$data->slug] = $data;
                }
                $sp = $sp->sortByDesc('sp_or_no');
                break;
            case "sp_status":
                foreach ($sp as $data) {
                    $group_array[$data->sp_status][$data->slug] = $data;
                }
                $sp = $sp->sortByDesc('sp_status');
                break;
            case "sp_mill":
                foreach ($sp as $data) {
                    $group_array[$data->sp_mill][$data->slug] = $data;
                }
                $sp = $sp->sortByDesc('sp_mill');
                break;
            case "sp_ref_sp_no":
                foreach ($sp as $data) {
                    $group_array[$data->sp_ref_sp_no][$data->slug] = $data;
                }
                $sp = $sp->sortByDesc('sp_ref_sp_no');
                break;
            case "sp_sugar_class":
                foreach ($sp as $data) {
                    $group_array[$data->sp_sugar_class][$data->slug] = $data;
                }
                $sp = $sp->sortByDesc('sp_sugar_class');
                break;
            case "sp_port_of_origin":
                foreach ($sp as $data) {
                    $group_array[$data->sp_port_of_origin][$data->slug] = $data;
                }
                $sp = $sp->sortByDesc('sp_port_of_origin');
                break;
            case "sp_port_of_destination":
                foreach ($sp as $data) {
                    $group_array[$data->sp_port_of_destination][$data->slug] = $data;
                }
                $sp = $sp->sortByDesc('sp_port_of_destination');
                break;
            case "sp_vessel":
                foreach ($sp as $data) {
                    $group_array[$data->sp_vessel][$data->slug] = $data;
                }
                $sp = $sp->sortByDesc('sp_vessel');
                break;
            case "sp_shipper":
                foreach ($sp as $data) {
                    $group_array[$data->sp_shipper][$data->slug] = $data;
                }
                $sp = $sp->sortByDesc('sp_shipper');
                break;
            case "sp_consignee":
                foreach ($sp as $data) {
                    $group_array[$data->sp_consignee][$data->slug] = $data;
                }
                $sp = $sp->sortByDesc('sp_consignee');
                break;
            case "sp_collecting_officer":
                foreach ($sp as $data) {
                    $group_array[$data->sp_collecting_officer][$data->slug] = $data;
                }
                $sp = $sp->sortByDesc('sp_collecting_officer');
                break;
            default:
                break;
        }

        if ($request->excel == true) {
            $groupedBy = match ($type) {
                'sp_or_no' => 'Official Receipt No.',
                'sp_status' => 'Status',
                'sp_mill' => 'Mill',
                'sp_ref_sp_no' => 'Ref. Sp. No.',
                'sp_sugar_class' => 'Sugar Class',
                'sp_port_of_origin' => 'Port of Origin',
                'sp_port_of_destination' => 'Port of Destination',
                'sp_vessel' => 'Vessel',
                'sp_shipper' => 'Shipper',
                'sp_consignee' => 'Consignee',
                'sp_collecting_officer' => 'Collecting Officer',
                default => str_replace('_', ' ', $type),
            };
            return Excel::download(new GroupedShippingPermitExport(
                $request->get('columns'),
                $sp,
                $this->columns(),
                $group_array,
            ), 'Grouped by ' . $groupedBy . ' Shipping Permit Report ' . date('d-m-Y') . '.xlsx');
        }


        return view('printables.shipping_permits.grouped_list')->with([
            'sp' => $sp,
            'group_array' => $group_array,
            'columns_chosen' => $request->get('columns'),
            'columns' => $this->columns(),
            'filters' => $filters,
            'types' => [$type]
        ]);
    }



}
