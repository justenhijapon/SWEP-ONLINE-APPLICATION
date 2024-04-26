<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Helpers;
use App\Exports\GroupedShippingPermitExport;
use App\Exports\ShippingPermitExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shipping_Permit\ShippingPermitFormRequest;
use App\Models\Port;
use App\Models\ShippingPermit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\PDF;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\Location;


class ShippingPermitController extends Controller
{
    public function create(){
        return view('dashboard.shipping_permits.create');
    }
    public function index(Request $request){
        if($request->ajax())
        {
            $sp = ShippingPermit::query();
            return datatables()->of($sp)
                ->addColumn('action', function($data){
                    return view('dashboard.shipping_permits.dtAction')->with([
                        'data' => $data,
                    ]);
                })
                ->editColumn('sp_status', function($data){
                    if($data->sp_status == 'PENDING'){
                        return '<span class="label bg-orange col-md-12">PENDING</span>' ;
                    }else if($data->sp_status == 'SHIPPED'){
                        return '<span class="label bg-green col-md-12">SHIPPED</span>';
                    }
                    else if($data->sp_status == 'CANCELLED'){
                        return '<span class="label bg-red col-md-12">CANCELLED</span>';
                    }
                })
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->setRowId('slug')
                ->make();
        }

        return view('dashboard.shipping_permits.index');
    }

    public function store(ShippingPermitFormRequest $request){


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
        $sp->sp_amount = Helpers::sanitizeAutonum($request->sp_amount);
        $sp->sp_ref_sp_no = $request->sp_ref_sp_no;
        $sp->sp_status = $request->sp_status;
        $sp->sp_markings = $request->sp_markings;
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

        if($sp->save()){

            return $sp->only('slug');
        }
    }

    public function destroy($slug){

        $sp = ShippingPermit::query()
            ->where('slug', $slug)
            ->first();
            $sp ?? abort(404,'Shipping Permit not found.');
        if($sp->delete()){
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
        $sp->sp_amount = Helpers::sanitizeAutonum($request->sp_amount);
        $sp->sp_ref_sp_no = $request->sp_ref_sp_no;
        $sp->sp_status = $request->sp_status;
        $sp->sp_markings = $request->sp_markings;
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
        if($sp->update()){
            return $sp->only('slug');
        }

    }

    public function changeStatus($slug,$type){
        $sp = ShippingPermit::query()
            ->where('slug', $slug)
            ->first();
        $sp->sp_status = strtoupper($type);
        if($sp->update()){
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

    private function columns(){
        $columns = [
            "Numbering" => "numbering",
            "Date" => "sp_date",
            "Shipping Permit No" => "sp_no",
            "Port of Origin" => "sp_port_of_origin",

        ];
        return $columns;
    }
    public function reports(){
        $sp = ShippingPermit::query()
            ->with([
                "portOfOrigin",
                "portOfDestination",
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
                "portOfOrigin",
                "portOfDestination",
            ]);

        if($request->sp_sugar_class != "" AND $request->sp_sugar_class != "all"){
            $sp = $sp->where('sp_sugar_class',"=",$request->sp_sugar_class);
        }

        if($request->sp_mill != "" AND $request->sp_mill != "all"){
            $sp = $sp->where('sp_mill',"=",$request->sp_mill);
        }

        if($request->sp_port_of_origin != "" AND $request->sp_port_of_origin != "all"){
            $sp = $sp->where('sp_port_of_origin',"=",$request->sp_port_of_origin);
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

            $sp = $sp->whereBetween('sp_date',[$df,$dt]);

        }

        if($type == "all"){

            if($request->excel == true){

                return Excel::download(new ShippingPermitExport($request->get('columns'),$sp->get(),$this->columns()), 'shipping_permit_report.xlsx');
            }
            return view('printables.shipping_permits.list_all')->with([
                'sp' => $sp->get(),
                'columns_chosen' => $request->get('columns'),
                'columns' => $this->columns(),
                'filters'=> $filters,

            ]);
        }

        if($type == "sp_port_of_origin") {
            $sp = $sp->get();
            $port_origin = [];
            foreach ($sp as $port) {
                $port_origin[$port->sp_port_of_origin][$port->slug] = $port;
            }
            if ($type == "sp_port_of_origin") {

                // Sort $sp by port before exporting
                $sp = $sp->sortByDesc('sp_port_of_origin');

                if ($request->excel == true) {
//                echo "<script>
//                alert('Only List All Layout can generate Excel Report');
//                window.location.href='/dashboard/ShippingPermit_reports';
//                </script>";
                    return Excel::download(new GroupedShippingPermitExport(
                        $request->get('columns'),
                        $sp,
                        $this->columns(),
                        $port_origin
                    ), 'grouped_by_port_shipping_permit_report.xlsx');

                }
                return view('printables.shipping_permits.grouped_list')->with([
                    'sp' => $sp,
                    'port_origin' => $port_origin,
                    'columns_chosen' => $request->get('columns'),
                    'columns' => $this->columns(),
                    'filters' => $filters,

                ]);
            }
        }

    }


}
