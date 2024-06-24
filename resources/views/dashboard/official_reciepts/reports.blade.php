@extends('layouts.admin-master')
@section('content')
    <style type="text/css">
        .for_sort>li{
            padding: 1px 10px;
            background-color: #ebdcec
        }
    </style>
    <section class="content-header">
        <h1>Official Receipts Reports</h1>
    </section>
    <section class="content">
        <div class="box box-default">

            <div class="box-header with-border">
                <i class="fa fa-warning"></i>

                <h3 class="box-title">O.R. Report</h3>
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
                                                                <label> Date range:</label>

                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input name="date_range" type="text" class="form-control pull-right filters" id="date_range" autocomplete="off"disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Group Report By:</label>
                                                            <select name="layout" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="all">List All</option>
                                                                <option value="or_payor">Group by Payor</option>
                                                                <option value="or_crop_year">Group by Crop Year</option>
                                                                <option value="or_mill">Group by Mill</option>
                                                                <option value="or_sugar_class">Group by Sugar Class</option>
                                                                <option value="or_drawee_bank">Group by Drawee Bank</option>
                                                                <option value="or_cancellation">Group by Cancellation</option>
                                                                <option value="or_shut_out">Group by Shut Out</option>
                                                                <option value="or_transhipment">Group by Transhipment</option>
                                                                <option value="or_other_fees">Group by Other Fees</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>O.R. Payor:</label>
                                                            <select name="or_payor" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
                                                                @foreach($or->pluck('or_payor')->unique() as $or_payor)
                                                                    <option value="{{ $or_payor }}">{{ $or_payor }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Crop Year:</label>
                                                            <select name="or_crop_year" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
                                                                @foreach($or->pluck('or_crop_year')->unique() as $or_crop_year)
                                                                    <option value="{{ $or_crop_year }}">{{ $or_crop_year }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Mill:</label>
                                                            <select name="or_mill" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
{{--                                                                @foreach($or->pluck('or_mill')->unique() as $or_mill)--}}
{{--                                                                    <option value="{{ $or_mill }}">{{ $or->orMIll_Origin->mill_name }}</option>--}}
{{--                                                                @endforeach--}}
                                                                @if(count($or) > 0)
                                                                    @php
                                                                        $mill = [];
                                                                    @endphp

                                                                    @foreach ($or as $key => $or)
                                                                        @php
                                                                            $millname = $or->orMIll_Origin->mill_name;
                                                                        @endphp

                                                                        @if (!in_array($millname, $mill))
                                                                            <option value="{{ $or->or_mill }}">{{ $millname }}</option>
                                                                            @php
                                                                                $mill[] = $millname;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Sugar Class:</label>
                                                            <select name="or_sugar_class" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
                                                                @foreach($or->pluck('or_sugar_class')->unique() as $or_sugar_class)
                                                                    <option value="{{ $or_sugar_class }}">{{ $or_sugar_class }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Drawee Bank:</label>
                                                            <select name="or_drawee_bank" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                                                <option value="">All</option>
                                                                @foreach($or->pluck('or_drawee_bank')->unique() as $or_drawee_bank)
                                                                    <option value="{{ $or_drawee_bank }}">{{ $or_drawee_bank }}</option>
                                                                @endforeach
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
                                                                $uncheckedValues = ['or_cancellation', 'or_shut_out', 'or_transhipment', 'or_other_fees', 'or_other_fees_2',];
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
        </div>





    </section>

@endsection


@section('modals')

    {!! __html::blank_modal('show_scholars_modal','lg') !!}
    {!! __html::blank_modal('edit_scholars_modal','lg') !!}

@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#date_range").attr('disabled','disabled');
        })

        $("#date_range_check").change(function(){
            if($(this).prop('checked') == true){
                $("#date_range").removeAttr('disabled');
            }else{
                $("#date_range").attr('disabled','disabled');
            }
        });
        $("#date_range").daterangepicker({});


        $("#generate_report_form").submit(function (e) {
            e.preventDefault();

            url = "{{ route('dashboard.official_reciepts.report_generate') }}";
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
            let link = '{{route("dashboard.official_reciepts.report_generate")}}?excel=true&'+formData;

            window.open(link);
        })

    </script>
@endsection