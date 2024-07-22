@extends('layouts.admin-master')
@section('content')

    <section class="content-header">
        <h1>Manage Official Receipts</h1>
    </section>

    <section class="content">
        {{-- Item Modal --}}
        <table hidden="">
            <tbody id="item_template">
            <tr>
                <td>
                    {!! \App\Core\Helpers\__form2::selectOnly('items[rand][oru_txn_type]',[
                        'options' => [
                           'CANCELLATION' => 'CANCELLATION',
                           'SHUT-OUT' => 'SHUT-OUT',
                           'TRANSHIPMENT' => 'TRANSHIPMENT',
                           'TRANSHIPMENT' => 'TRANSHIPMENT',
                           ],
                    ]) !!}
                </td>
                <td>{!! \App\Core\Helpers\__form2::textboxOnly('items[rand][oru_sp_no]',[
                        'label' => 'S.P. No.:',
                     ]) !!}
                </td>
                <td>{!! \App\Core\Helpers\__form2::textboxOnly('items[rand][oru_volume]',[
                        'label' => 'Volume:',
                     ]) !!}
                </td>
                <td>{!! \App\Core\Helpers\__form2::textboxOnly('items[rand][oru_amount]',[
                        'label' => 'Amount:',
                        'class' => 'autonum_rand',
                     ]) !!}
                </td>
                <td><button type="button" class="btn btn-sm bg-red delete_row_item"><i class="fa fa-times"></i></button></td>
            </tr>
            </tbody>
        </table>
        {{-- Table Grid --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Official Receipts</h3>
                <div class="pull-right">
{{--                    <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" data-toggle="modal" data-target="#add_official_reciepts_modal" ><i class="fa fa-plus"></i> Add</button>--}}
                        <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" onclick="window.location='{{ url("/dashboard/official_reciepts/create") }}'" ><i class="fa fa-plus"></i> Add</button>

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
                            <div class="col-md-2 col-sm-3 col-lg-3"> <!-- Adjusted column size for date range -->
                                <div class="form-group">
                                    <input type="checkbox" id="date_range_check">
                                    <label> Filter by Date:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="date_range" type="text" class="form-control pull-right filters" id="date_range" autocomplete="off" disabled>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-1 col-sm-1 col-lg-2">
                                <label>Filter by Payor:</label>
                                <select id="payor_filter" class="form-control">
                                    <option value="">All</option>
                                    @php
                                        $uniqueOrPayors = $or->pluck('or_payor')->unique();
                                    @endphp
                                    @foreach($uniqueOrPayors as $payor)
                                        <option value="{{ $payor }}">{{ $payor }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-1 col-sm-1 col-lg-2">
                                <label>Filter by Mill:</label>
                                <select id="mill_filter" class="form-control">
                                    <option value="">All</option>
                                    @php
                                        $uniqueOrMill = $or->pluck('or_mill')->unique();
                                        $mills = App\Models\Mill::whereIn('slug', $uniqueOrMill)->get();
                                    @endphp
                                    @foreach($mills as $mill)
                                        <option value="{{ $mill->slug }}">{{ $mill->mill_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-1 col-sm-1 col-lg-2">
                                <label>Filter by Crop Year:</label>
                                <select id="crop_year_filter" class="form-control">
                                    <option value="">All</option>
                                    @php
                                        $uniqueOrCropYear = $or->pluck('or_crop_year')->unique();
                                    @endphp
                                    @foreach($uniqueOrCropYear as $cropYear)
                                        <option value="{{ $cropYear }}">{{ $cropYear }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="official_reciepts_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="official_reciepts_table" style="width: 100% !important">
                        <thead>
                        <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                            <th>SLUG</th>
                            <th >Official Receipt No.</th>
                            <th>Reciept Date</th>
                            <th>Payor</th>
                            <th>Mill</th>
                            <th>Crop Year</th>
                            <th>Shipping Permit</th>
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
<!-- Add official_reciepts Modal -->
{{--<div class="modal fade" id="add_official_reciepts_modal">--}}
{{--    <div class="modal-dialog modal-lg">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">×</span></button>--}}
{{--                <h4 class="modal-title">Official Reciepts - Shipping Permits</h4>--}}
{{--            </div>--}}
{{--            <form autocomplete="off" id="form_add_official_reciepts" enctype="multipart/form-data">--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="box-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-8">--}}
{{--                                <div class="modal-header">--}}
{{--                                    <h4 class="modal-title">O.R. Details</h4>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}

{{--                                    {!! \App\Core\Helpers\__form2::textbox('or_no',[--}}
{{--                                        'label' => 'O.R. No.:',--}}
{{--                                        'cols' => 6,--}}
{{--                                         'class' => 'autonum_init',--}}
{{--                                    ]) !!}--}}
{{--                                    {!! \App\Core\Helpers\__form2::textbox('or_date',[--}}
{{--                                        'label' => 'O.R. Date:',--}}
{{--                                        'type' => 'date',--}}
{{--                                        'cols' => 6,--}}
{{--                                    ]) !!}--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}

{{--                                    {!! \App\Core\Helpers\__form2::textbox('or_mill',[--}}
{{--                                        'label' => 'Mill:',--}}
{{--                                        'cols' => 6,--}}
{{--                                    ]) !!}--}}
{{--                                    {!! \App\Core\Helpers\__form2::textbox('or_sugar_class',[--}}
{{--                                        'label' => 'Sugar Class:',--}}
{{--                                        'cols' => 6,--}}
{{--                                    ]) !!}--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}

{{--                                    {!! \App\Core\Helpers\__form2::textbox('or_payor',[--}}
{{--                                        'label' => 'Payor:',--}}
{{--                                        'cols' => 12,--}}
{{--                                    ]) !!}--}}

{{--                                </div>--}}
{{--                                <div class="row">--}}

{{--                                    {!! \App\Core\Helpers\__form2::select('or_crop_year',[--}}
{{--                                        'label' => 'Crop Year:',--}}
{{--                                        'options' => \App\Core\Helpers\Arrays::cropYear(),--}}
{{--                                        'cols' => 12,--}}
{{--                                    ]) !!}--}}


{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="panel panel-default">--}}
{{--                                        <div class="panel-heading">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <p class="no-margin">--}}
{{--                                                        <b>Add Item</b>--}}
{{--                                                    </p>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <button id="add_row_item" type="button" class="btn btn-xs btn-success pull-right">Add Item &nbsp;<i class="fa fw fa-plus"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                        <div class="panel-body">--}}
{{--                                            <table class="table table-bordered" id="utilization_table">--}}

{{--                                                <thead>--}}
{{--                                                <tr>--}}
{{--                                                    <th>TXN TYPE</th>--}}
{{--                                                    <th>SP NO.</th>--}}
{{--                                                    <th>VOLUME</th>--}}
{{--                                                    <th>AMOUNT</th>--}}
{{--                                                    <th style="width: 40px"></th>--}}
{{--                                                </tr>--}}
{{--                                                </thead>--}}

{{--                                                <tbody>--}}
{{--                                                </tbody>--}}
{{--                                            </table>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="modal-header">--}}
{{--                                        <h4 class="modal-title">Payment Details</h4>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-body">--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="row">--}}

{{--                                                {!! \App\Core\Helpers\__form2::textbox('or_drawee_bank',[--}}
{{--                                                    'label' => 'Drawee Bank:',--}}

{{--                                                    'cols' => 6,--}}
{{--                                                ]) !!}--}}
{{--                                                {!! \App\Core\Helpers\__form2::textbox('or_cash_amount',[--}}
{{--                                                    'label' => 'Cash Amount:',--}}
{{--                                                    'cols' => 6,--}}
{{--                                                ]) !!}--}}
{{--                                            </div>--}}
{{--                                            <div class="row">--}}

{{--                                                {!! \App\Core\Helpers\__form2::textbox('or_chk_acct_no',[--}}
{{--                                                    'label' => 'Chk. Acct No.:',--}}
{{--                                                    'cols' => 6,--}}
{{--                                                ]) !!}--}}
{{--                                                {!! \App\Core\Helpers\__form2::textbox('or_check_amount',[--}}
{{--                                                    'label' => 'Check Amount:',--}}
{{--                                                    'cols' => 6,--}}
{{--                                                ]) !!}--}}


{{--                                            </div>--}}
{{--                                            <div class="row">--}}
{{--                                                {!! \App\Core\Helpers\__form2::textbox('or_chk_no',[--}}
{{--                                                    'label' => 'Check No.:',--}}
{{--                                                    'cols' => 6,--}}
{{--                                                ]) !!}--}}
{{--                                                {!! \App\Core\Helpers\__form2::textbox('or_money_order',[--}}
{{--                                                    'label' => 'Money Order:',--}}
{{--                                                    'cols' => 6,--}}
{{--                                                ]) !!}--}}

{{--                                            </div>--}}
{{--                                            <div class="row">--}}
{{--                                                {!! \App\Core\Helpers\__form2::textbox('or_chk_date',[--}}
{{--                                                    'label' => 'Check Date:',--}}
{{--                                                    'cols' => 6,--}}
{{--                                                ]) !!}--}}
{{--                                                {!! \App\Core\Helpers\__form2::textbox('or_total_paid',[--}}
{{--                                                    'label' => 'Total Paid:',--}}
{{--                                                    'cols' => 6,--}}
{{--                                                ]) !!}--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="modal-header">--}}
{{--                                        <h4 class="modal-title">Nature of Payment</h4>--}}
{{--                                    </div>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <br>--}}
{{--                                    <div class="modal-body">--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="row">--}}

{{--                                                {!! \App\Core\Helpers\__form2::textbox('sp_markings',[--}}
{{--                                                    'label' => 'Cancellation:',--}}
{{--                                                    'cols' => 12,--}}
{{--                                                ]) !!}--}}
{{--                                                {!! \App\Core\Helpers\__form2::textbox('sp_consignee',[--}}
{{--                                                    'label' => 'Shut-out:',--}}
{{--                                                    'cols' => 12,--}}
{{--                                                ]) !!}--}}
{{--                                                {!! \App\Core\Helpers\__form2::textbox('sp_shipper',[--}}
{{--                                                    'label' => 'Transhipment:',--}}
{{--                                                    'cols' => 12,--}}
{{--                                                ]) !!}--}}
{{--                                                {!! \App\Core\Helpers\__form2::textbox('sp_consignee_add',[--}}
{{--                                                    'label' => 'Shipping Permit:',--}}
{{--                                                    'cols' => 12,--}}
{{--                                                ]) !!}--}}
{{--                                                {!! \App\Core\Helpers\__form2::textbox('sp_shipper_add',[--}}
{{--                                                    'label' => 'Other Fees:',--}}
{{--                                                    'cols' => 12,--}}
{{--                                                ]) !!}--}}
{{--                                            </div>--}}
{{--                                            <div class="row">--}}

{{--                                                {!! \App\Core\Helpers\__form2::textbox('sp_markings',[--}}
{{--                                                    'label' => 'Total Amount:',--}}
{{--                                                    'cols' => 12,--}}
{{--                                                ]) !!}--}}
{{--                                                {!! \App\Core\Helpers\__form2::textbox('sp_consignee',[--}}
{{--                                                    'label' => 'Report No.:',--}}
{{--                                                    'cols' => 12,--}}
{{--                                                ]) !!}--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>--}}
{{--                        <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!}"><i class="fa fa-save"></i> Save</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


<!-- Edit modal -->
<div class="modal fade" id="edit_official_reciepts_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div id="edit_official_reciepts_modal_loader">
                <center>
                    <img style="width: 70px; margin: 40px 0;" src="{!! __static::loader(Auth::user()->color) !!}">
                </center>
            </div>
        </div>
    </div>
</div>

<!-- Print modal -->
<div class="modal fade" id="print_official_reciepts_btn">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div id="print_official_reciepts_modal_loader">
                <center>
                    <img style="width: 70px; margin: 40px 0;" src="<?php echo __static::loader(Auth::user()->color); ?>">
                </center>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript">
        {!! __js::modal_loader() !!}
        $('#payor_filter').on('change', function () {
            var or_payor = $(this).val();
            official_reciepts_table.columns(3).search(or_payor).draw();
        });

        $('#mill_filter').on('change', function () {
            var or_mill = $(this).val();
            official_reciepts_table.columns(4).search(or_mill).draw();
        });

        $('#crop_year_filter').on('change', function () {
            var or_crop_year = $(this).val();
            official_reciepts_table.columns(5).search(or_crop_year).draw();
        });

        //Date Range
        $('#date_range_check').change(function() {
            if ($(this).is(':checked')) {
                // Enable date range input
                $('#date_range').prop('disabled', false);
            } else {
                // Disable date range input
                $('#date_range').prop('disabled', true);
                // Clear date range filter and redraw the table
                official_reciepts_table.columns(2).search('').draw();
            }
        });

        // Date range picker initialization
        $('#date_range').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        // Listen for date range picker change event
        $('#date_range').on('apply.daterangepicker', function(ev, picker) {
            // Set the value of the input
            $(this).val(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate.format('MMMM D, YYYY'));
            // Filter data based on selected date range
            var startDate = picker.startDate.format('YYYY-MM-DD');
            var endDate = picker.endDate.format('YYYY-MM-DD');

            var currentDate = moment(startDate);
            var datesArray = [];

            while (currentDate <= moment(endDate)) {
                datesArray.push(currentDate.format('YYYY-MM-DD'));
                currentDate = currentDate.clone().add(1, 'days');
            }

            var datesString = datesArray.join('|');

            official_reciepts_table.columns(2).search(datesString, true, false).draw();

        });

        // Clear date range input when 'Clear' button is clicked
        $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            // Clear date range filter and redraw the table
            official_reciepts_table.columns(2).search('').draw();
        });
    </script>

    <script type="text/javascript">

        $(document).ready(function(){
            active = '';
            edit_loader = $("#edit_official_reciepts_modal .modal-content").html();



            $('#official_reciepts_table')
                .on('preXhr.dt', function ( e, settings, data ) {
                    Pace.restart();
                } )


            //-----DATATABLES-----//
            //Initialize DataTable
            official_reciepts_table = $("#official_reciepts_table").DataTable({
                'dom' : 'lBfrtip',
                "processing": true,
                "serverSide": true,
                "ajax" : {
                    url : '{{ route("dashboard.official_reciepts.index") }}',
                    type: 'GET',
                },
                "columns": [
                    {"data": "slug"},
                    {"data": "or_no"},
                    {"data": "or_date"},
                    {"data": "or_payor"},
                    {"data": "or_mill"},
                    {"data": "or_crop_year"},
                    {"data": "utilization"},
                    {"data": "action"}
                ],

                buttons: [
                    {!! __js::dt_buttons() !!}
                ],
                "columnDefs":[
                    {
                        "targets" :  0 ,
                        "visible" : false
                    },
                    {
                    "targets": 2, // sp_date column index
                            "render": function (data, type, full, meta) {
                            // Format the date using moment.js or any other library
                            return moment(data).format("MMMM D, YYYY"); // Adjust format as needed
                        }
                    },
                    {
                        "targets" : 6,
                        "orderable" : false,
                        "class" : 'action-10p'
                    },
                    {
                        "targets" : 7,
                        "orderable" : false,
                        "class" : 'action-10p'
                    },

                ],
                "order": [[2, "desc"]],
                "responsive": false,
                "initComplete": function( settings, json ) {
                    $('#tbl_loader').fadeOut(function(){
                        $("#official_reciepts_table_container").fadeIn();
                    });
                },
                "language":
                    {
                        "processing": "<center><img style='width: 70px' src='{!! __static::loader(Auth::user()->color) !!}'></center>",
                    },
                "drawCallback": function(settings){
                    $('[data-toggle="tooltip"]').tooltip();
                    $('[data-toggle="modal"]').tooltip();
                    if(active !== ''){
                        $("#official_reciepts_table #"+active).addClass('success');
                    }
                }
            })

            //Search Bar Styling
            style_datatable('#official_reciepts_table');

            //Need to press enter to search
            $('#official_reciepts_table_filter input').unbind();
            $('#official_reciepts_table_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    official_reciepts_table.search(this.value).draw();
                }
            });


            //-----Pap Code and Item-----//
            //Add Pap Code and Item
            $("#add_row_item").click(function(){
                let rowTemplate = $("#item_template").html();
                let random = makeId(10);
                rowTemplate = rowTemplate.replaceAll('rand',random);

                $("#utilization_table tbody").append(rowTemplate);
                $(".autonum_"+ random).each(function(){
                    $(this).attr('autocomplete','off');
                    new AutoNumeric(this, autonum_settings);
                });

            });

            //Delete item button
            $("body").on("click",'.delete_row_item',function (){
                $(this).parent('td').parent('tr').remove();
            });

            //Submit Add Reciept Form
            $("#form_add_official_reciepts").submit(function(e){
                e.preventDefault();
                form = $(this);
                loading_btn(form);
                formData = new FormData(this);
                Pace.restart();
                $.ajax({
                    url: "{{ route('dashboard.official_reciepts.store') }}",
                    data: formData,
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    headers: {
                        {!! __html::token_header() !!}
                    },
                    success: function(response){

                        console.log(response);
                        notify("Your data was successfully saved", "success");

                        official_reciepts_table.draw(false);
                        active = response.slug;

                        succeed(form,true,false);
                        $("#form_add_official_reciepts input[name='official_reciepts_name']").focus();
                        $("#table_body").html('');
                    },
                    error: function(response){
                        errored(form,response);
                    }
                })
            })


            //Edit Official Reciepts button
            $("body").on("click", ".edit_official_reciepts_btn", function(){
                $("#edit_official_reciepts_modal .modal-content").html(edit_loader);
                id = $(this).attr('data');
                uri = "{{ route('dashboard.official_reciepts.edit', 'slug') }}";
                uri = uri.replace('slug',id);
                Pace.restart();
                $.ajax({
                    url : uri ,
                    type : 'GET',
                    success: function(response){

                        $("#edit_official_reciepts_modal_loader").fadeOut(function(){
                            $("#edit_official_reciepts_modal .modal-content").html(response);

                        })
                    },error: function(response){
                        notify("Error: "+JSON.stringify(response), 'danger');
                    }
                })
            })



        })

        function printOfficialReceipt(slug) {
            var printUrl = '{{ route("official_reciepts.print", ":slug") }}'.replace(':slug', slug);

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



    </script>

@endsection