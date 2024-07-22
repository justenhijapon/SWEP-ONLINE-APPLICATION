@extends('layouts.admin-master')
@section('content')
    <style type="text/css">
        .for_sort>li{
            padding: 1px 10px;
            background-color: #ebdcec
        }
    </style>
    <section class="content-header">
        <h1>Shipping Permit Reports</h1>
    </section>
    <section class="content">
        <div class="box box-default">

            <div class="box-header with-border">
                <i class="fa fa-warning"></i>

                <h3 class="box-title">Shipping Permit Report</h3>
            </div>


            <div class="box-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="well well-sm">
                            <form id="generate_report_form">
                                <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!}" style="width: 100%">Generate Report</button>

                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#advanced_filters" aria-expanded="true" class="">
                                            <i class="fa fa-filter"></i>  Filters <i class=" fa  fa-angle-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="advanced_filters" class="panel-collapse collapse" aria-expanded="true" style="">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Filters</div>
                                                <div class="panel-body with-scroll" style="height: 350px; overflow-y: auto;">
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="checkbox" id="date_range_check">
                                                                <label> Permit Date:</label>

                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input name="date_range" type="text" class="form-control pull-right filters" id="date_range" autocomplete="off"disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="checkbox" id="date_range_check_1">
                                                                <label> EDD/ETD:</label>

                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input name="date_range_1" type="text" class="form-control pull-right filters" id="date_range_1" autocomplete="off"disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="checkbox" id="date_range_check_2">
                                                                <label> EDA/ETA:</label>

                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input name="date_range_2" type="text" class="form-control pull-right filters" id="date_range_2" autocomplete="off"disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Group Report By:</label>
                                                            <select name="layout" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="all">List All</option>
                                                                <option value="sp_or_no">Group by O.R. No.</option>
                                                                <option value="sp_status">Group by Status</option>
                                                                <option value="sp_mill">Group by Mill</option>
                                                                <option value="sp_ref_sp_no">Group by Ref. SP. No.</option>
                                                                <option value="sp_sugar_class">Group by Sugar Class</option>
                                                                <option value="sp_port_of_origin">Group by Port of Origin</option>
                                                                <option value="sp_port_of_destination">Group by Port of Destination</option>
                                                                <option value="sp_vessel">Group by Vessel</option>
                                                                <option value="sp_shipper">Group by Shipper</option>
                                                                <option value="sp_consignee">Group by Consignee</option>
                                                                <option value="sp_collecting_officer">Group by Collecting Officer</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>O.R. No.:</label>
                                                            <select name="sp_or_no" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
                                                                @foreach($sp->pluck('sp_or_no')->unique() as $sp_or_no)
                                                                    <option value="{{ $sp_or_no }}">{{ $sp_or_no }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Status:</label>
                                                            <select name="sp_status" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
                                                                @foreach($sp->pluck('sp_status')->unique() as $sp_status)
                                                                    <option value="{{ $sp_status }}">{{ $sp_status }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Mill:</label>
                                                            <select name="sp_mill" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
                                                                @php
                                                                    $displayedMillNames = [];
                                                                @endphp

                                                                @foreach ($sp as $spm)
                                                                    @php
                                                                        $millName = $spm->spMIll_Origin->mill_name ?? null;
                                                                    @endphp

                                                                    @if (!in_array($millName, $displayedMillNames))
                                                                        <option value="{{ $millName }}">{{ $millName }}</option>
                                                                        @php
                                                                            $displayedMillNames[] = $millName;
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Ref Sp No:</label>
                                                            <select name="sp_ref_sp_no" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
                                                                @foreach($sp->pluck('sp_ref_sp_no')->unique() as $sp_ref_sp_no)
                                                                    <option value="{{ $sp_ref_sp_no }}">{{ $sp_ref_sp_no }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Sugar Class:</label>
                                                            <select name="sp_sugar_class" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
                                                                @foreach($sp->pluck('sp_sugar_class')->unique() as $sp_sugar_class)
                                                                    <option value="{{ $sp_sugar_class }}">{{ $sp_sugar_class }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>


                                                        <div class="col-md-12">
                                                            <label>Port Of Origin:</label>

                                                            <select name="sp_port_of_origin" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>

                                                                @if(count($sp) > 0)
                                                                    @php
                                                                        $displayedPortNames = [];
                                                                    @endphp

                                                                    @foreach ($sp as $key => $singleSp)
                                                                        @php
                                                                            $portName = $singleSp->sp_port_of_origin;
                                                                        @endphp

                                                                        @if (!in_array($portName, $displayedPortNames))
                                                                            <option value="{{ $singleSp->sp_port_of_origin }}">{{ $portName }}</option>
                                                                            @php
                                                                                $displayedPortNames[] = $portName;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Port Of Destination:</label>

                                                            <select name="sp_port_of_destination" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>

                                                                @if(count($sp) > 0)
                                                                    @php
                                                                        $displayedPortNames = [];
                                                                    @endphp

                                                                    @foreach ($sp as $key => $singleSp)
                                                                        @php
                                                                            $portName = $singleSp->sp_port_of_destination;
                                                                        @endphp

                                                                        @if (!in_array($portName, $displayedPortNames))
                                                                            <option value="{{ $singleSp->sp_port_of_destination }}">{{ $portName }}</option>
                                                                            @php
                                                                                $displayedPortNames[] = $portName;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Vessel:</label>
                                                            <select name="sp_vessel" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
                                                                @foreach($sp->pluck('sp_vessel')->unique() as $sp_vessel)
                                                                    <option value="{{ $sp_vessel }}">{{ $sp_vessel }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Shipper:</label>
                                                            <select name="sp_shipper" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
                                                                @foreach($sp->pluck('sp_shipper')->unique() as $sp_shipper)
                                                                    <option value="{{ $sp_shipper }}">{{ $sp_shipper }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Consignee:</label>
                                                            <select name="sp_consignee" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
                                                                @foreach($sp->pluck('sp_consignee')->unique() as $sp_consignee)
                                                                    <option value="{{ $sp_consignee }}">{{ $sp_consignee }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Collecting Officer:</label>
                                                            <select name="sp_collecting_officer" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
                                                                @if(count($sp) > 0)
                                                                    @php
                                                                        $array = [];
                                                                    @endphp

                                                                    @foreach ($sp as $key => $singleSp)
                                                                        @php
                                                                            $user = $singleSp->spCollecting_Officer;
                                                                            if ($user) {
                                                                                $middleInitial = $user->middlename ? substr($user->middlename, 0, 1) . '.' : '';
                                                                                $fullName = $user->lastname . ', ' . $user->firstname . ' ' . $middleInitial;
                                                                                $co = $fullName;
                                                                            }
                                                                        @endphp

                                                                        @if ($user && !in_array($co, $array))
                                                                            <option value="{{ $singleSp->sp_collecting_officer }}">{{ $co }}</option>
                                                                            @php
                                                                                $array[] = $co;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                @endif

                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#advanced_filters2" aria-expanded="true" class="">
                                            <i class="fa fa-filter"></i>  Select Columns <i class=" fa  fa-angle-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="advanced_filters2" class="panel-collapse collapse" aria-expanded="true" style="">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Column Selection (Drag to reorder)</div>
                                                <div class="panel-body with-scroll" style="height: 350px; overflow-y: auto;">
                                                    <div class="col-md-12">
                                                        <span class="text-info text-strong">(Drag to reorder)</span>
                                                        <ol class="for_sort sortable todo-list">
                                                            @php
                                                                // Array of values to be unchecked
                                                                $uncheckedValues = ["sp_ship_operator", "sp_freight","sp_plate_no","sp_remarks","sp_ref_sp_no","sp_uom","sp_markings","sp_shipper","sp_shipper_add","sp_shipper_tin","sp_consignee","sp_consignee_add","sp_consignee_tin","sp_collecting_officer",];
                                                            @endphp

                                                            @if(!empty($columns))
                                                                @foreach($columns as $key => $column)
                                                                    <li>
                                                                        <div class="checkbox" style="margin: 0">
                                                                            <label>
                                                                                <input
                                                                                        type="checkbox"
                                                                                        name="columns[]"
                                                                                        value="{{$column}}"
                                                                                        @if(!in_array($column, $uncheckedValues))
                                                                                            checked
                                                                                        @endif
                                                                                >
                                                                                {{$key}}
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            @endif


                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <span style="font-weight: bold; font-size: 16px">Print Preview</span>
                                <button id="print_btn" class="btn {!! __static::bg_color(Auth::user()->color) !!} btn-sm pull-right"><i class="fa fa-print"></i> Print</button>
                                <button id="excel_btn"  class="btn {!! __static::bg_color(Auth::user()->color) !!} btn-sm pull-right" style='margin-right:20px'><i class= "fa fa-file-excel-o"></i> Excel</button>
                            </div>
                            <div class="panel-body" style="height: auto;">
                                <div id="print_container" style="text-align: center; margin-top: 100px">
                                    <i class="fa fa-print" style="font-size: 300px; color: grey; "></i>
                                    <br>
                                    <span class="text-info">Click <b>"Generate Report"</b> button to see print preview here</span>
                                </div>


                                <div id="report_frame_loader" style="display: none">
                                    <center>
                                        <img style="width: 100px; margin: 140px 0;" src="{!! __static::loader(Auth::user()->color) !!}">
                                    </center>
                                </div>
                                <div class="row" id="report_frame_container" style="height: 100%; display: none">
                                    <div class="col-md-12" style="height: 100%">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe id="report_frame" style="width: 100%; height: 100%;" class="embed-responsive" src="" ></iframe>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection


@section('modals')

    {!! __html::blank_modal('show_scholars_modal','lg') !!}
    {!! __html::blank_modal('edit_scholars_modal','lg') !!}

@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            function toggleDateRange(selector, checkboxSelector) {
                $(selector).attr('disabled', 'disabled');
                $(checkboxSelector).change(function() {
                    if ($(this).prop('checked')) {
                        $(selector).removeAttr('disabled');
                    } else {
                        $(selector).attr('disabled', 'disabled');
                    }
                });
                $(selector).daterangepicker({});
            }

            toggleDateRange("#date_range", "#date_range_check");
            toggleDateRange("#date_range_1", "#date_range_check_1");
            toggleDateRange("#date_range_2", "#date_range_check_2");
        });



        $("#generate_report_form").submit(function (e) {
            e.preventDefault();

            url = "{{ route('dashboard.shipping_permits.report_generate') }}";
            data = $(this).serialize();
            console.log(data);
            $("#report_frame_loader").show();
            $("#report_frame_container").hide();

            $("#report_frame").attr("src", url+"?"+data);

            wait_button("#generate_report_form");
            $("#print_container").slideUp();
        });

        $("#report_frame").on('load', function(){
            $("#report_frame_loader").slideUp(function(){
                $("#report_frame_container").fadeIn();
            });
            unwait_button("#generate_report_form","Generate Report");
        })


        $(".for_sort").sortable();

        $("#print_btn").click(function(){
            $("#report_frame").get(0).contentWindow.print();
        })

        $("#excel_btn").click(function (){
            let formData = $("#generate_report_form").serialize();
            let link = '{{route("dashboard.shipping_permits.report_generate")}}?excel=true&'+formData;

            window.open(link);
        })


    </script>
@endsection