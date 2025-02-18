@extends('layouts.admin-master')

@section('content')

    <table hidden="">
        <tbody id="item_template">
        <tr>
            <td>
                {!! \App\Core\Helpers\__form2::selectOnly('items[rand][crop_year]',[
                    'options' => \App\Core\Helpers\Arrays::cropYear(),
                ]) !!}
            </td>
            <td>{!! \App\Core\Helpers\__form2::textboxOnly('items[rand][sro_number]',[
                        'label' => 'SRO No.:',
                        'type' => 'number',
                     ]) !!}
            </td>
            <td>{!! \App\Core\Helpers\__form2::textboxOnly('items[rand][amount]',[
                        'label' => 'Amount:',
                        'type' => 'number',
                        'id' => 'amount',
                     ]) !!}
            </td>
            {{--            <td>--}}
            {{--                {!! \App\Core\Helpers\__form2::textboxOnly('items[rand][oru_amount]',[--}}
            {{--                    'label' => 'Amount:',--}}
            {{--                    'type' => 'number',--}}
            {{--                    'id' => 'oru_amount',--}}
            {{--                ]) !!}--}}
            {{--            </td>--}}
            <td><button type="button" class="btn btn-sm bg-red delete_row_item"><i class="fa fa-times"></i></button></td>
        </tr>
        </tbody>
    </table>
    <section class="content-header">
        <h1>Manage Shipping Permits</h1>
    </section>

    <section class="content">
        {{-- Table Grid --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Shipping Permits</h3>
                <div class="pull-right">
                    <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" data-toggle="modal" onclick="window.location='{{ url("/dashboard/shipping_permits/create") }}'" ><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>
            <div class="panel">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#advanced_filters" aria-expanded="true" class="">
                            <i class="fa fa-filter"></i>  Advanced Filters <i class=" fa  fa-angle-down"></i>
                        </a>
                    </h4>
                </div>
                <div id="advanced_filters" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-2 col-sm-1 col-lg-2"> <!-- Adjusted column size for date range -->
                                <div class="form-group">
                                    <input type="checkbox" id="date_range_check">
                                    <label>Filter by Permit Date:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="date_range" type="text" class="form-control pull-right filters" id="date_range" autocomplete="off" disabled>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-1 col-sm-1 col-lg-2">
                                <label>Filter by O.R. No.:</label>
                                <select id="or_filter" class="form-control">
                                    <option value="">All</option>
                                    @php
                                        $uniqueOr = $sp->pluck('sp_or_no')->unique();
                                    @endphp
                                    @foreach($uniqueOr as $uniqueOr)
                                        <option value="{{ $uniqueOr }}">{{ $uniqueOr }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 col-sm-1 col-lg-2">
                                <label>Filter by Sugar Class:</label>
                                <select id="sugar_class_filter" class="form-control">
                                    <option value="">All</option>
                                    @php
                                        $uniquesc = $sp->pluck('sp_sugar_class')->unique();
                                    @endphp
                                    @foreach($uniquesc as $uniquesc)
                                        <option value="{{ $uniquesc }}">{{ $uniquesc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 col-sm-1 col-lg-2">
                                <label>Filter by Status:</label>
                                <select id="status_filter" class="form-control">
                                    <option value="">All</option>
                                    @php
                                        $uniquestatus = $sp->pluck('sp_status')->unique();
                                    @endphp
                                    @foreach($uniquestatus as $uniquestatus)
                                        <option value="{{ $uniquestatus }}">{{ $uniquestatus }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 col-sm-1 col-lg-2">
                                <label>Filter by Collecting Officer:</label>
                                <select id="officer_filter" class="form-control">
                                    <option value="">All</option>
                                    @php
                                        $uniqueSpOfficer = $sp->pluck('sp_collecting_officer')->unique();
                                        $officer = App\Models\User::whereIn('user_id', $uniqueSpOfficer)->get();
                                    @endphp
                                    @foreach($officer as $officer)
                                        <option value="{{ $officer->slug }}">{{ $officer->lastname }}, {{ $officer->middlename }} {{substr($officer->middlename, 0, 1)}}.</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-lg-2">
                                <label>Filter by Port of Origin:</label>
                                <select id="port_origin_filter" class="form-control">
                                    <option value="">All</option>

                                    @php
                                        $uniqueport1 = $sp->pluck('sp_port_of_origin')->unique();
                                    @endphp
                                    @foreach($uniqueport1 as $ports)
                                        <option value="{{$ports}}">{{$ports}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 col-sm-1 col-lg-2">
                                <label>Filter by Port of Destination:</label>
                                <select id="port_destination_filter" class="form-control">
                                    <option value="">All</option>
                                    @php
                                        $uniqueport2 = $sp->pluck('sp_port_of_destination')->unique();
                                    @endphp
                                    @foreach($uniqueport2 as $ports)
                                        <option value="{{$ports}}">{{$ports}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-1 col-lg-2"> <!-- Adjusted column size for date range -->
                                <div class="form-group">
                                    <input type="checkbox" id="date_range_check_1">
                                    <label>Filter by EDD/ETD:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="date_range_1" type="text" class="form-control pull-right filters" id="date_range_1" autocomplete="off" disabled>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-2 col-sm-1 col-lg-2"> <!-- Adjusted column size for date range -->
                                <div class="form-group">
                                    <input type="checkbox" id="date_range_check_2">
                                    <label>Filter by EDA/ETA:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="date_range_2" type="text" class="form-control pull-right filters" id="date_range_2" autocomplete="off" disabled>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-1 col-sm-1 col-lg-2">
                                <label>Filter by Mill:</label>
                                <select id="mill_filter" class="form-control">
                                    <option value="">All</option>
                                    @php
                                        $uniqueSpMill = $sp->pluck('sp_mill')->unique();
                                        $mills = App\Models\Mill::whereIn('slug', $uniqueSpMill)->get();
                                    @endphp
                                    @foreach($mills as $mill)
                                        <option value="{{ $mill->slug }}">{{ $mill->mill_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="shipping_permits_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="shipping_permits_table" style="width: 100% !important">
                        <thead>
                        <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                            <th>SLUG</th>
                            <th>SP No.</th>
                            <th>Permit Date</th>
                            <th>Mill & Marking</th>
                            <th>Origin / Destination</th>
                            <th>Other Details</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th class="action">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>


                <div id="tbl_loader">
                    <center>
                        <img style="width: 100px" src="{!! __static::loader(Auth::user()->color) !!}">
                    </center>
                </div>
            </div>
            <!-- /.box-body -->
        </div>


    </section>


@endsection

@section('modals')
    {!! __html::modal_delete('shipping_permits_delete') !!}
    <!-- Add shipping_permits Modal -->
{{--    <div class="modal fade" id="add_shipping_permits_modal">--}}
{{--        <div class="modal-dialog modal-lg">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">×</span></button>--}}
{{--                    <h4 class="modal-title">Permit Details</h4>--}}
{{--                </div>--}}
{{--                <form autocomplete="off" id="form_add_shipping_permits" enctype="multipart/form-data">--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div class="row">--}}

{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_no',[--}}
{{--                                    'label' => 'Shipping Permit No.:',--}}
{{--                                    'cols' => 6,--}}
{{--                                     'class' => 'autonum_init',--}}
{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_edd_etd',[--}}
{{--                                    'label' => 'EDD/ETD:',--}}
{{--                                    'type' => 'date',--}}
{{--                                    'cols' => 6,--}}
{{--                                ]) !!}--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}

{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_date',[--}}
{{--                                    'label' => 'Permit Date:',--}}
{{--                                    'type' => 'date',--}}
{{--                                    'cols' => 6,--}}
{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_eda_eta',[--}}
{{--                                    'label' => 'EDA/ETA:',--}}
{{--                                    'type' => 'date',--}}
{{--                                    'cols' => 6,--}}
{{--                                ]) !!}--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}

{{--                                {!! \App\Core\Helpers\__form2::select('sp_port_of_origin',[--}}
{{--                                    'label' => 'Port of Origin:',--}}
{{--                                    'cols' => 8,--}}
{{--                                    'options' => \App\Core\Helpers\Arrays::portofOrigin(),--}}
{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_mill',[--}}
{{--                                    'label' => 'Mill:',--}}
{{--                                    'cols' => 4,--}}
{{--                                ]) !!}--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}

{{--                                {!! \App\Core\Helpers\__form2::select('sp_port_of_destination',[--}}
{{--                                    'label' => 'Port of Destination:',--}}
{{--                                    'cols' => 8,--}}
{{--                                    'options' => \App\Core\Helpers\Arrays::portofdestination(),--}}
{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::select('sp_sugar_class',[--}}
{{--                                    'label' => 'Sugar Class:',--}}
{{--                                    'options' => [--}}
{{--                                        'RAW' => 'RAW',--}}
{{--                                        'DIRECT CONSUMPTION' => 'DIRECT CONSUMPTION',--}}
{{--                                        'REFINED' => 'REFINED',--}}
{{--                                        'OTHER'=> 'OTHER'--}}
{{--                                        ],--}}
{{--                                    'cols' => 4,--}}
{{--                                ]) !!}--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}

{{--                                {!! \App\Core\Helpers\__form2::select('sp_vessel',[--}}
{{--                                    'label' => 'Name of Vessel:',--}}
{{--                                    'cols' => 8,--}}
{{--                                    'options' => \App\Core\Helpers\Arrays::spvessel(),--}}

{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_volume',[--}}
{{--                                    'label' => 'Volume:',--}}
{{--                                    'cols' => 4,--}}
{{--                                ]) !!}--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}

{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_ship_operator',[--}}
{{--                                    'label' => 'Ship Operator:',--}}
{{--                                    'cols' => 8,--}}
{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_uom',[--}}
{{--                                    'label' => 'UoM:',--}}
{{--                                    'cols' => 4,--}}
{{--                                ]) !!}--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}

{{--                                {!! \App\Core\Helpers\__form2::select('sp_freight',[--}}
{{--                                    'label' => 'Freight:',--}}
{{--                                    'cols' => 4,--}}
{{--                                    'options' => \App\Core\Helpers\Arrays::spfreight(),--}}

{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_plate_no',[--}}
{{--                                    'label' => 'Plate No.:',--}}
{{--                                    'cols' => 4,--}}
{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_or_no',[--}}
{{--                                    'label' => 'O.R. No.:',--}}
{{--                                    'cols' => 4,--}}
{{--                                ]) !!}--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}

{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_remarks',[--}}
{{--                                    'label' => 'Remarks:',--}}
{{--                                    'cols' => 8,--}}
{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_amount',[--}}
{{--                                    'label' => 'Amount:',--}}
{{--                                    'cols' => 4,--}}
{{--                                    'class' => 'autonum',--}}
{{--                                ]) !!}--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}

{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_ref_sp_no',[--}}
{{--                                    'label' => 'Ref SP No.:',--}}
{{--                                    'cols' => 8,--}}
{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::select('sp_status',[--}}
{{--                                    'label' => 'Status:',--}}
{{--                                    'options' => [--}}
{{--                                        'Pending' => 'Pending',--}}
{{--                                        'Shipped' => 'Shipped',--}}
{{--                                        'Cancelled' => 'Cancelled'--}}
{{--                                        ],--}}
{{--                                    'cols' => 4,--}}
{{--                                ]) !!}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-header">--}}
{{--                        <h4 class="modal-title">Shipper</h4>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div class="row">--}}

{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_markings',[--}}
{{--                                    'label' => 'Markings:',--}}
{{--                                    'cols' => 12,--}}
{{--                                ]) !!}--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}

{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_shipper',[--}}
{{--                                    'label' => 'Shipper:',--}}
{{--                                    'cols' => 5,--}}
{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_shipper_add',[--}}
{{--                                    'label' => 'Shipper Address:',--}}
{{--                                    'cols' => 5,--}}
{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_shipper_tin',[--}}
{{--                                    'label' => 'Shipper Tin:',--}}
{{--                                    'cols' => 2,--}}
{{--                                ]) !!}--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}

{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_consignee',[--}}
{{--                                    'label' => 'Consignee:',--}}
{{--                                    'cols' => 5,--}}
{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_consignee_add',[--}}
{{--                                    'label' => 'Consignee Address:',--}}
{{--                                    'cols' => 5,--}}
{{--                                ]) !!}--}}
{{--                                {!! \App\Core\Helpers\__form2::textbox('sp_consignee_tin',[--}}
{{--                                    'label' => 'Consignee Tin:',--}}
{{--                                    'cols' => 2,--}}
{{--                                ]) !!}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>--}}
{{--                        <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!}"><i class="fa fa-save"></i> Save</button>--}}
{{--                    </div>--}}

{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    {!! __html::modal_delete('shipping_permits_delete') !!}

    <!-- Edit modal -->
    <div class="modal fade" id="edit_shipping_permits_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div id="edit_shipping_permits_modal_loader">
                    <center>
                        <img style="width: 70px; margin: 40px 0;" src="{!! __static::loader(Auth::user()->color) !!}">
                    </center>
                </div>
            </div>
        </div>
    </div>

    <!-- Print modal -->
    <div class="modal fade" id="print_shipping_permits_btn">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div id="print_shipping_permits_modal_loader">
                    <center>
                        <img style="width: 70px; margin: 40px 0;" src="{!! __static::loader(Auth::user()->color) !!}">
                    </center>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script type="text/javascript">
        {!! __js::modal_loader() !!}
    </script>
    <script type="text/javascript">
        // Filters
        $('#or_filter').on('change', function () {
            var sp_or_no = $(this).val();
            shipping_permits_table.columns(1).search(sp_or_no).draw();
        });
        $('#status_filter').on('change', function () {
            var sp_status = $(this).val();
            shipping_permits_table.columns(7).search(sp_status).draw();
        });
        $('#port_origin_filter').on('change', function () {
            var sp_port_of_origin = $(this).val();
            shipping_permits_table.columns(10).search(sp_port_of_origin).draw();
        });
        $('#port_destination_filter').on('change', function () {
            var sp_port_of_destination = $(this).val();
            shipping_permits_table.columns(11).search(sp_port_of_destination).draw();
        });

        $('#mill_filter').on('change', function () {
            var sp_mill = $(this).val();
            shipping_permits_table.columns(12).search(sp_mill).draw();
        });
        $('#mill_filter').on('change', function () {
            var sp_collecting_officer = $(this).val();
            shipping_permits_table.columns(13).search(sp_collecting_officer).draw();
        });

        $('#sugar_class_filter').on('change', function () {
            var sp_sugar_class = $(this).val();
            shipping_permits_table.columns(4).search(sp_sugar_class).draw();
        });


        function initializeDateRangePicker(checkId, rangeId, columnIndex) {
            // Date range checkbox change event
            $(checkId).change(function() {
                var rangeInput = $(rangeId);
                if ($(this).is(':checked')) {
                    rangeInput.prop('disabled', false);
                } else {
                    rangeInput.prop('disabled', true);
                    shipping_permits_table.columns(columnIndex).search('').draw();
                }
            });

            // Date range picker initialization
            $(rangeId).daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            // Listen for date range picker change event
            $(rangeId).on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate.format('MMMM D, YYYY'));
                var startDate = picker.startDate.format('YYYY-MM-DD');
                var endDate = picker.endDate.format('YYYY-MM-DD');
                var currentDate = moment(startDate);
                var datesArray = [];

                while (currentDate <= moment(endDate)) {
                    datesArray.push(currentDate.format('YYYY-MM-DD'));
                    currentDate = currentDate.clone().add(1, 'days');
                }

                var datesString = datesArray.join('|');
                shipping_permits_table.columns(columnIndex).search(datesString, true, false).draw();
            });

            // Clear date range input when 'Clear' button is clicked
            $(rangeId).on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                shipping_permits_table.columns(columnIndex).search('').draw();
            });
        }

        // Initialize date range picker for each range
        initializeDateRangePicker('#date_range_check', '#date_range', 3);
        initializeDateRangePicker('#date_range_check_1', '#date_range_1', 9);
        initializeDateRangePicker('#date_range_check_2', '#date_range_2', 8);


    </script>

    <script type="text/javascript">

        $(document).ready(function(){
            active = '';
            edit_loader = $("#edit_shipping_permits_modal .modal-content").html();

            $('#shipping_permits_table')
                .on('preXhr.dt', function ( e, settings, data ) {
                    Pace.restart();
                } )


            //-----DATATABLES-----//
            //Initialize DataTable
            shipping_permits_table = $("#shipping_permits_table").DataTable({
                'dom' : 'lBfrtip',
                "processing": true,
                "serverSide": true,
                "ajax" : {
                    url : '{{ route("dashboard.shipping_permits.index") }}',
                    type: 'GET',
                },
                // "columns": [
                //     {"data": "slug"},
                //     {"data": "sp_or_no"},
                //     {"data": "sp_no"},
                //     {"data": "sp_date"},
                //     {"data": "sp_sugar_class"},
                //     {"data": "sp_volume"},
                //     {
                //         "data": "sp_amount",
                //         "render": function(data, type, row) {
                //             // Check if the data is null and set it to 0 if it is
                //             var amount = data ? data : 0;
                //             // Add peso sign to the amount
                //             return "₱" + amount;
                //         }
                //     },
                //     {"data": "sp_status"},
                //     {"data": "sp_edd_etd"},
                //     {"data": "sp_eda_eta"},
                //     {"data": "sp_port_of_origin"},
                //     {"data": "sp_port_of_destination"},
                //     {"data": "sp_mill"},
                //     {"data": "sp_collecting_officer"},
                //     {"data": "action"},
                //
                // ],

                "columns": [
                    {"data": "slug"},
                    {"data": "sp_no"},
                    {"data": "sp_date"},
                    {"data": "sp_mill"},
                    {"data": "sp_origin_destination"},
                    {"data": "sp_other_details"},
                    {
                        "data": "sp_amount",
                        "render": function(data, type, row) {
                            // Check if the data is null and set it to 0 if it is
                            var amount = data ? data : 0;
                            // Add peso sign to the amount
                            return "₱" + amount;
                        }
                    },
                    {"data": "sp_status"},
                    {"data": "action"},

                ],

                buttons: [
                    {!! __js::dt_buttons() !!}
                ],
                // "columnDefs":[
                //     {
                //         "targets" :  [0,1,8,9,10,11,12,13] ,
                //         "visible" : false
                //     },
                //     {
                //         "targets" : [11,10],
                //         "orderable": true,
                //         "class" : 'w-5p'
                //     },
                //     {
                //         "targets" : 7,
                //         "orderable": true,
                //         "class" : 'w-6p'
                //     },
                //     {
                //         "targets" : 14,
                //         "orderable": false,
                //         "class" : 'action-10p'
                //     },
                //     {
                //         "targets": [3], // sp_date column index
                //         "render": function (data, type, full, meta) {
                //             // Format the date using moment.js or any other library
                //             return moment(data).format("MMMM D, YYYY"); // Adjust format as needed
                //         }
                //     }
                //
                // ],

                "columnDefs":[
                    {
                        "targets" :  [0] ,
                        "visible" : false
                    },
                    {
                        "targets" : 8,
                        "orderable": false,
                        "class" : 'action-10p'
                    },
                    {
                        "targets" : 7,
                        "class" : 'action-8p'
                    },
                    {
                        "targets" : 6,
                        "class" : 'action-8p text-right'
                    },
                ],

                "order": [[2, "desc"]], // Sort by sp_date column in ascending order
                "responsive": false,
                "initComplete": function( settings, json ) {
                    $('#tbl_loader').fadeOut(function(){
                        $("#shipping_permits_table_container").fadeIn();
                    });
                },
                "language":
                    {
                        "processing": "<center><img style='width: 70px' src='{!! __static::loader(Auth::user()->color) !!}'></center>",
                    },
                "drawCallback": function(settings){
                    $('[data-toggle="tooltip"]').tooltip();
                    $('[data-toggle="modal"]').tooltip();
                    $('[data-toggle="dropdown"]').tooltip();
                    if(active !== ''){
                        $("#shipping_permits_table #"+active).addClass('success');
                    }
                }
            })

            //Search Bar Styling
            style_datatable('#shipping_permits_table');

            //Need to press enter to search
            $('#shipping_permits_table_filter input').unbind();
            $('#shipping_permits_table_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    shipping_permits_table.search(this.value).draw();
                }
            });

            {{--//Submit Add Permit Form--}}
            {{--$("#form_add_shipping_permits").submit(function(e){--}}
            {{--    e.preventDefault();--}}
            {{--    form = $(this);--}}
            {{--    loading_btn(form);--}}
            {{--    formData = new FormData(this);--}}
            {{--    Pace.restart();--}}
            {{--    $.ajax({--}}
            {{--        url: "{{ route('dashboard.shipping_permits.store') }}",--}}
            {{--        data: formData,--}}
            {{--        type: "POST",--}}
            {{--        dataType: 'json',--}}
            {{--        processData: false,--}}
            {{--        contentType: false,--}}
            {{--        headers: {--}}
            {{--            {!! __html::token_header() !!}--}}
            {{--        },--}}
            {{--        success: function(response){--}}

            {{--            console.log(response);--}}
            {{--            notify("Your data was successfully saved", "success");--}}

            {{--            shipping_permits_table.draw(false);--}}
            {{--            active = response.slug;--}}

            {{--            succeed(form,true,false);--}}
            {{--            $("#form_add_shipping_permits input[name='shipping_permits_name']").focus();--}}
            {{--            $("#table_body").html('');--}}
            {{--        },--}}
            {{--        error: function(response){--}}
            {{--            errored(form,response);--}}
            {{--        }--}}
            {{--    })--}}
            {{--})--}}

            //Edit Shipping Permit button
            $("body").on("click", ".edit_shipping_permits_btn", function(){
                $("#edit_shipping_permits_modal .modal-content").html(edit_loader);
                id = $(this).attr('data');
                uri = "{{ route('dashboard.shipping_permits.edit', 'slug') }}";
                uri = uri.replace('slug',id);
                Pace.restart();
                $.ajax({
                    url : uri ,
                    type : 'GET',
                    success: function(response){

                        $("#edit_shipping_permits_modal_loader").fadeOut(function(){
                            $("#edit_shipping_permits_modal .modal-content").html(response);

                        })
                    },error: function(response){
                        notify("Error: "+JSON.stringify(response), 'danger');
                    }
                })
            })

            //Status
            $("body").on('click', '.psc', function() {
                let btn = $(this);
                let slug = btn.attr('data');
                let status = btn.attr('status');
                Swal.fire({
                    title: "Do you want to save the changes?",
                    showCancelButton: true,
                    confirmButtonText: status.toUpperCase(),
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        let url = '{{route('dashboard.shipping_permits.change_status',["slug","status"])}}';
                        url = url.replace('slug',slug);
                        url = url.replace('status',status);
                        $.ajax({
                            url : url,
                            type: 'POST',
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            headers: {
                                {!! __html::token_header() !!}
                            },
                            success: function (res){
                                location.reload();
                                notify('Shipping permit status successfully updated',"success");
                            },
                            error: function (res){
                                notify("Error: "+JSON.stringify(response), 'danger');
                            }
                        })
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });



            });
        });

        function printShippingPermit(slug) {
            var printUrl = '{{ route("shipping_permit.print", ":slug") }}'.replace(':slug', slug);

            // Use AJAX to fetch the content from the URL
            $.ajax({
                url: printUrl,
                success: function(data) {
                    // Create an iframe to load the content
                    var iframe = document.createElement('iframe');
                    iframe.style.position = 'absolute';
                    iframe.style.width = '0px';
                    iframe.style.height = '0px';
                    iframe.style.border = 'none';
                    document.body.appendChild(iframe);

                    // Write the fetched content to the iframe
                    iframe.contentWindow.document.open();
                    iframe.contentWindow.document.write(data);
                    iframe.contentWindow.document.close();

                    // Trigger the print dialog
                    iframe.contentWindow.focus();
                    iframe.contentWindow.print();

                    // Remove the iframe after printing
                    setTimeout(function() {
                        document.body.removeChild(iframe);
                    }, 1000);
                },
                error: function() {
                    alert('Failed to load the content for printing.');
                }
            });
        }

        {{--function printShippingPermits(slug) {--}}
        {{--    var printUrl = '{{ route("printables.index", ":slug") }}'.replace(':slug', slug);--}}

        {{--    // Use AJAX to fetch the content from the URL--}}
        {{--    $.ajax({--}}
        {{--        url: printUrl,--}}
        {{--        success: function(data) {--}}
        {{--            // Create an iframe to load the content--}}
        {{--            var iframe = document.createElement('iframe');--}}
        {{--            iframe.style.position = 'absolute';--}}
        {{--            iframe.style.width = '0px';--}}
        {{--            iframe.style.height = '0px';--}}
        {{--            iframe.style.border = 'none';--}}
        {{--            document.body.appendChild(iframe);--}}

        {{--            // Write the fetched content to the iframe--}}
        {{--            iframe.contentWindow.document.open();--}}
        {{--            iframe.contentWindow.document.write(data);--}}
        {{--            iframe.contentWindow.document.close();--}}

        {{--            // Trigger the print dialog--}}
        {{--            iframe.contentWindow.focus();--}}
        {{--            iframe.contentWindow.print();--}}

        {{--            // Remove the iframe after printing--}}
        {{--            setTimeout(function() {--}}
        {{--                document.body.removeChild(iframe);--}}
        {{--            }, 1000);--}}
        {{--        },--}}
        {{--        error: function() {--}}
        {{--            alert('Failed to load the content for printing.');--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}


    </script>

@endsection


