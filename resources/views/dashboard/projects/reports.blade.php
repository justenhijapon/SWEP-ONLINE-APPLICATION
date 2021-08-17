@extends('layouts.admin-master')
@section('content')
    <style type="text/css">
        .for_sort>li{
            padding: 1px 10px;
            background-color: #ebdcec
        }
    </style>
    <section class="content-header">
        <h1>Printable Reports</h1>
    </section>
    <section class="content">
        <div class="box box-default">

            <div class="box-header with-border">
                <i class="fa fa-warning"></i>

                <h3 class="box-title">Alerts</h3>
            </div>


            <div class="box-body">

                <div class="row">
                    <div class="col-md-3">
                        <div class="well well-sm">
                            <form id="generate_report_form">
                                Filters
                                <br>
                                <div class="row">

                                    <div class="col-md-6">
                                        <label>Year:</label>

                                        <select name="year" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">

                                            @if(!empty($years))
                                                @foreach($years as $year)
                                                    @if(\Carbon\Carbon::now()->year == $year)
                                                        <option value="{{$year}}" selected>{{$year}} (Current)</option>
                                                    @else
                                                        <option value="{{$year}}">{{$year}}</option>
                                                    @endif

                                                @endforeach
                                            @endif
                                        </select>
                                    </div>








                                    <div class="col-md-12">
                                        <br>
                                        Select columns to show: <span class="text-info text-strong pull-right">(Drag to reorder)</span>
                                        <ol class="for_sort sortable todo-list" >


                                            @if(!empty($columns))
                                                @foreach($columns as $key => $column)
                                                    <li>
                                                        <div class="checkbox" style="margin: 0">
                                                            <label>
                                                                <input checked type="checkbox" name="columns[]" value="{{$key}}"> {{$column}}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ol>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="pull-right btn {!! __static::bg_color(Auth::user()->color) !!}">Generate Report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <span style="font-weight: bold; font-size: 16px">Print Preview</span>
                                <button id="print_btn" class="btn {!! __static::bg_color(Auth::user()->color) !!} btn-sm pull-right"><i class="fa fa-print"></i> Print</button>
                            </div>
                            <div class="panel-body" style="height: 700px">
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
                                            <iframe id="report_frame" style="width: 100%; height: 100%" class="embed-responsive" src=""></iframe>
                                        </div>
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
        $("#generate_report_form").submit(function (e) {
            e.preventDefault();

            url = "{{ route('dashboard.projects.report_generate') }}";
            data = $(this).serialize();

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
    </script>
@endsection