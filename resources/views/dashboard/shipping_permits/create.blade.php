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
                        'id' => 'amount',
                        'class' => 'autonum_rand'
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
        <h1 class="text-center">Add Shipping Permit</h1>
    </section>

    <section class="content">
        {{-- Table Grid --}}

        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Permit Details</h3>
                        <div class="pull-right">
                            <button type="button" class="btn btn-default" data-toggle="modal"
                                    onclick="window.location='{{ url("dashboard/shipping_permits") }}'"> Back</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form autocomplete="off" id="form_add_shipping_permits" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- First Column Form Elements -->
                                            <div class="row">
                                                <!-- Shipping Permit No. -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_no',[
                                                'label' => 'Shipping Permit No.:',
                                                'cols' => 2,
                                                'type' => 'number',
                                                'class' => 'autonum_init',
                                                ]) !!}
                                                <!-- Permit Date -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_date',[
                                                'label' => 'Permit Date:',
                                                'type' => 'date',
                                                'cols' => 2,
                                                ]) !!}
                                                <!-- O.R. No. -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_or_no',[
                                                'label' => 'O.R. No.:',
                                                'cols' => 2,
//                                                'id' => 'or_no',
//                                                'options' => \App\Core\Helpers\Arrays::spOR(),
                                                ]) !!}
                                                <!-- EDD/ETD -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_edd_etd',[
                                                'label' => 'EDD/ETD:',
                                                'type' => 'date',
                                                'cols' => 2,
                                                ]) !!}

                                                <!-- EDA/ETA -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_eda_eta',[
                                                'label' => 'EDA/ETA:',
                                                'type' => 'date',
                                                'cols' => 2,
                                                ]) !!}
                                                <!-- Ref SP No. -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_ref_sp_no',[
                                                'label' => 'Ref SP No.:',
                                                'cols' => 2,
                                                ]) !!}
                                            </div>
                                            <div class="row">
                                                <!-- Port of Origin -->
                                                {!! \App\Core\Helpers\__form2::select('sp_port_of_origin',[
                                                'label' => 'Port of Origin:',
                                                'cols' => 3,
                                                'options' => \App\Core\Helpers\Arrays::portarray(),
                                                'id' => 'sp_port_of_origin',
                                                ]) !!}
                                                <!-- Port of Destination -->
                                                {!! \App\Core\Helpers\__form2::select('sp_port_of_destination',[
                                                'label' => 'Port of Destination:',
                                                'cols' => 3,
                                                'options' => \App\Core\Helpers\Arrays::portarray(),
                                                'id' => 'sp_port_of_destination',
                                                ]) !!}
                                                <!-- Mill -->
                                                {!! \App\Core\Helpers\__form2::select('sp_mill',[
                                                'label' => 'Mill:',
                                                'cols' => 2,
                                                'options' => \App\Core\Helpers\Arrays::millarray(),
                                                'id' => 'mill_code',
                                                ]) !!}
                                                <!-- Sugar Class -->
                                                {!! \App\Core\Helpers\__form2::select('sp_sugar_class',[
                                                'label' => 'Sugar Class:',
                                                'options' => \App\Core\Helpers\Arrays::SugarClass(),
                                                'cols' => 2,
                                                ]) !!}
                                                <!-- UoM -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_uom',[
                                                'label' => 'UoM:',
                                                'cols' => 2,
                                                ]) !!}
                                            </div>
                                            <div class="row">

                                            </div>
                                            <div class="row">
                                                <!-- Name of Vessel -->
                                                {!! \App\Core\Helpers\__form2::select('sp_vessel',[
                                                'label' => 'Name of Vessel:',
                                                'cols' => 3,
                                                'options' => \App\Core\Helpers\Arrays::spvessel(),
                                                'id' => 'vessel_description',
                                                ]) !!}
                                                <!-- Ship Operator -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_ship_operator',[
                                                'label' => 'Ship Operator:',
                                                'cols' => 3,
                                                'id' => 'ship_operator',
                                                ]) !!}
                                                <!-- Freight -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_freight',[
                                                'label' => 'Freight:',
                                                'cols' => 2,
//                                                'options' => \App\Core\Helpers\Arrays::spfreight(),
                                                ]) !!}
                                                <!-- Plate No. -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_plate_no',[
                                                'label' => 'Plate No.:',
                                                'cols' => 2,
                                                ]) !!}
                                                <!-- Status -->
                                                {!! \App\Core\Helpers\__form2::select('sp_status',[
                                                'label' => 'Status:',
                                                'options' => \App\Core\Helpers\Arrays::spStatus(),
                                                'cols' => 2,
                                                ]) !!}
                                            </div>
                                            <div class="row">

                                            </div>


{{--                                            <div class="box-header with-border"  style="background-color: #4477a3;color: white;">--}}
{{--                                                <p class="no-margin">--}}
{{--                                                    Volume--}}
{{--                                                    <small id="filter-notifier" class="label bg-blue blink"></small>--}}
{{--                                                    <button id="add_volume_btn" class="btn btn-xs pull-right btn-success add_volume_btn" style="background-color: #e3e3e3" data="addVolume" type="button"><i class="fa fa-plus"></i> ADD</button>--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                            <div class="box-body" style="">--}}
{{--                                                <table class="table table-bordered table-condensed sms_form1_table table_dynamic" id="addVolumeTable">--}}
{{--                                                    <thead>--}}
{{--                                                    <tr>--}}
{{--                                                        <th>Crop Year</th>--}}
{{--                                                        <th>SRO Number</th>--}}
{{--                                                        <th>Amount</th>--}}
{{--                                                        <th>Action</th>--}}
{{--                                                    </tr>--}}
{{--                                                    </thead>--}}
{{--                                                    <tbody>--}}
{{--                                                    @if(!empty($seriesNos['RAW']))--}}
{{--                                                        @foreach($seriesNos['RAW'] as $seriesNo)--}}
{{--                                                            @include('sms.dynamic_rows.insertSeriesNos',[--}}
{{--                                                                'for' => 'RAW',--}}
{{--                                                                'seriesNo' => $seriesNo,--}}
{{--                                                            ])--}}
{{--                                                        @endforeach--}}
{{--                                                    @else--}}
{{--                                                        @include('sms.dynamic_rows.insertSeriesNos',[--}}
{{--                                                                'for' => 'RAW',--}}
{{--                                                            ])--}}
{{--                                                    @endif--}}
{{--                                                    </tbody>--}}
{{--                                                </table>--}}
{{--                                            </div>--}}

                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p class="no-margin">
                                                                        <b>Add Volume</b>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button id="add_row_item" type="button" class="btn btn-xs btn-success pull-right" style="background-color: #f39c12; color: white; border-color: #f39c12;">
                                                                        Add Item &nbsp;<i class="fa fw fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <table class="table table-bordered" id="volume_table">
                                                                <thead>
                                                                <tr>
                                                                    <th style="width: 130px">Crop Year</th>
                                                                    <th>SRO Number</th>
                                                                    <th>Amount</th>
                                                                    <th style="width: 40px"></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            {!! \App\Core\Helpers\__form2::selectOnly('items[0][crop_year]',[
                                                                                'options' => \App\Core\Helpers\Arrays::cropYear(),
                                                                            ]) !!}
                                                                        </td>
                                                                        <td>{!! \App\Core\Helpers\__form2::textboxOnly('items[0][sro_number]',[
                                                                                'label' => 'SRO No.:',
                                                                                'type' => 'number',
                                                                             ]) !!}
                                                                        </td>
                                                                        <td>{!! \App\Core\Helpers\__form2::textboxOnly('items[0][amount]',[
                                                                                'label' => 'Amount:',
                                                                                'id' => 'amount',
                                                                                'class' => 'autonum_rand'
                                                                             ]) !!}
                                                                        </td>
                                                                        <td><button type="button" class="btn btn-sm bg-red delete_row_item"><i class="fa fa-times"></i></button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Volume and Amount textboxes -->
                                                <div class="col-md-2">
                                                    <!-- Volume -->
                                                    {!! \App\Core\Helpers\__form2::textbox('sp_volume',[
                                                        'label' => 'Volume:',
//                                                        'type' => 'number',
                                                        'cols' => 12,
                                                        'id' => 'sp_volume',
                                                    ]) !!}
                                                    <!-- Amount -->
                                                    {!! \App\Core\Helpers\__form2::textbox('sp_amount',[
                                                        'label' => 'Amount:',
                                                        'cols' => 12,
//                                                        'class' => 'autonum',
                                                        'id'=> 'sp_amount',
                                                    ]) !!}
                                                </div>
                                                <div>
                                                    <!-- Remarks -->
                                                    {!! \App\Core\Helpers\__form2::textbox('sp_remarks',[
                                                    'label' => 'Remarks:',
                                                    'cols' => 5,
                                                    ]) !!}
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Shipper</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Markings -->
{{--                                                {!! \App\Core\Helpers\__form2::select('sp_markings',[--}}
{{--                                                'label' => 'Markings:',--}}
{{--                                                'cols' => 6,--}}
{{--                                                 'options' => [],--}}
{{--                                                ]) !!}--}}

                                                <div class="form-group col-md-5">
                                                    <label for="sp_markings">Markings:</label>
                                                    <input list="markings_list" id="sp_markings" name="markings_list" class="form-control">
                                                    <datalist id="markings_list">

                                                    </datalist>
                                                </div>

                                                {!! \App\Core\Helpers\__form2::select('sp_collecting_officer',[
                                               'label' => 'Collecting Officer:',
                                               'cols' => 5,
                                               'options' => \App\Core\Helpers\Arrays::spCollectingOfficer(),
                                               'id' => 'user_id',
                                               ]) !!}
                                                {!! \App\Core\Helpers\__form2::textbox('sp_collecting_officer_position',[
                                               'label' => 'Position:',
                                               'cols' => '2',
                                               ]) !!}
                                            </div>
                                            <div class="row">
                                                <!-- Shipper, Shipper Address, and Shipper Tin -->
                                                {!! \App\Core\Helpers\__form2::select('sp_shipper',[
                                                'options' => \App\Core\Helpers\Arrays::sptrader(),
                                                'label' => 'Shipper:',
                                                'id' => 'trader_name',
                                                'cols' => 5,
                                                ]) !!}

{{--                                                {!! \App\Core\Helpers\__form2::textbox('sp_shipper_add',[--}}
{{--                                                'label' => 'Shipper Address:',--}}
{{--                                                'cols' => 2,--}}
{{--                                                ]) !!}--}}

                                                <div class="form-group col-md-5">
                                                    <label for="tc_markings">Shipper Address:</label>
                                                    <input list="cluster_list" id="tc_markings" name="sp_shipper_add" class="form-control">
                                                    <datalist id="cluster_list"></datalist>
                                                </div>

                                                {!! \App\Core\Helpers\__form2::textbox('sp_shipper_tin',[
                                                'label' => 'Shipper Tin:',
                                                'cols' => 2,
                                                ]) !!}
                                                <!-- Consignee, Consignee Address, and Consignee Tin -->
                                                {!! \App\Core\Helpers\__form2::select('sp_consignee',[
                                                'options' => \App\Core\Helpers\Arrays::spconsignee(),
                                                'label' => 'Consignee:',
                                                'id' => 'consignee_name',
                                                'cols' => 5,
                                                ]) !!}

                                                <div class="form-group col-md-5">
                                                    <label for="c_markings">Consignee Address:</label>
                                                    <input list="clusterC_list" id="c_markings" name="sp_consignee_add" class="form-control">
                                                    <datalist id="clusterC_list"></datalist>
                                                </div>

{{--                                                {!! \App\Core\Helpers\__form2::textbox('sp_consignee_add',[--}}
{{--                                                'label' => 'Consignee Address:',--}}
{{--                                                'cols' => 5,--}}
{{--                                                ]) !!}--}}
                                                {!! \App\Core\Helpers\__form2::textbox('sp_consignee_tin',[
                                                'label' => 'Consignee Tin:',
                                                'cols' => 2,
                                                ]) !!}
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left"
                                        onclick="window.location='{{ url("dashboard/shipping_permits") }}'"
                                        data-dismiss="modal">Close</button>
                                <button type="submit"
                                        class="btn {!! __static::bg_color(Auth::user()->color) !!}"><i class="fa fa-save"></i>
                                    Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>

@endsection


@section('scripts')

    <script type="text/javascript">

        $(document).ready(function(){


            //Submit Add port Form
            $("#form_add_shipping_permits").submit(function(e){
                e.preventDefault();
                form = $(this);
                // loading_btn(form);
                formData = new FormData(this);
                Pace.restart();
                Swal.fire({
                    title: "Do you want to save the changes?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Save and Next",
                    denyButtonText: `Save and Print`
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('dashboard.shipping_permits.store') }}",
                            data: formData,
                            type: "POST",
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            headers: {
                                {!! __html::token_header() !!}
                            },
                            success: function(response){
                                $('form').trigger("reset");
                                form.find("input, select, textarea").each(function() {
                                    // $(this).removeClass(); // Remove all custom classes
                                    $(this).removeAttr("disabled"); // Remove inline styles
                                    $(this).prop("disabled", false); // Re-enable any disabled inputs
                                });

                                console.log(response);
                                notify("Your data was successfully saved", "success");

                                shipping_permits_table.draw(false);
                                active = response.slug;

                                succeed(form,true,false);
                                $("#form_add_shipping_permits input[name='shipping_permits_name']").focus();
                                $("#table_body").html('');

                            },
                            error: function(response){
                                errored(form,response);
                            }
                        })
                    } else if (result.isDenied) {
                        $.ajax({
                            url: "{{ route('dashboard.shipping_permits.store') }}",
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
                                var slug = response.slug;
                                printShippingPermit(slug);
                                notify("Your data was successfully saved", "success");

                                shipping_permits_table.draw(false);
                                active = response.slug;

                                succeed(form,true,false);
                                $("#form_add_shipping_permits input[name='shipping_permits_name']").focus();
                                $("#table_body").html('');

                            },
                            error: function(response){
                                errored(form,response);
                            }
                        })

                    }
                });

            })

            $('#mill_code, #vessel_description, #sp_port_of_origin, #sp_port_of_destination, #consignee_name, #trader_name, #trader').select2();

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





        {{--$("body").on("change","#or_no",function (){--}}
        {{--    let url = '{{route('dashboard.ajax','for')}}';--}}
        {{--    let or_no = $(this).val();--}}
        {{--    url = url.replace('for','getMillFromOR');--}}
        {{--    $.ajax({--}}
        {{--        url : url,--}}
        {{--        data: {--}}
        {{--            or_no : or_no,--}}
        {{--        },--}}
        {{--        type: 'GET',--}}
        {{--        success:function (response){--}}
        {{--            $("#form_add_shipping_permits input[name='sp_volume']").val(response.or_payor);--}}

        {{--        },--}}
        {{--        error: function (response){--}}
        {{--            $or ?? abort(503,'OR not found');--}}
        {{--        }--}}
        {{--    });--}}
        {{--})--}}

            // OLD MARKING LOUIS
        {{--$("body").on("change", "#mill_code", function () {--}}
        {{--    let url = '{{route('dashboard.ajax','for')}}';--}}
        {{--    let mill_code = $(this).val();--}}
        {{--    url = url.replace('for', 'getMillUtilization');--}}
        {{--    $.ajax({--}}
        {{--        url: url,--}}
        {{--        data: {--}}
        {{--            mill_code: mill_code,--}}
        {{--        },--}}
        {{--        type: 'GET',--}}
        {{--        success: function (response) {--}}
        {{--            let selectElement = $("#form_add_shipping_permits select[name='sp_markings']");--}}
        {{--            selectElement.empty(); // Clear any existing options--}}

        {{--            // Iterate over the response data and append options to the select element--}}
        {{--            response.millData.forEach(function (mill) {--}}
        {{--                let option = $("<option></option>")--}}
        {{--                    // .attr("value", mill.mu_marking_code) // Assuming 'id' is a property of the mill--}}
        {{--                    .text(mill.mu_description); // Assuming 'name' is a property of the mill--}}
        {{--                selectElement.append(option);--}}
        {{--            });--}}
        {{--        },--}}
        {{--        error: function (response) {--}}
        {{--            alert('Mill not found');--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

            // DATALIST MARKING LOUIS
            $("body").on("change", "#mill_code", function () {
                let url = '{{route('dashboard.ajax','for')}}';
                let mill_code = $(this).val();
                url = url.replace('for', 'getMillUtilization');
                $.ajax({
                    url: url,
                    data: {
                        mill_code: mill_code,
                    },
                    type: 'GET',
                    success: function (response) {
                        let datalistElement = $("#markings_list");
                        datalistElement.html(""); // Clear any existing options

                        let html;
                        // Iterate over the response data and append options to the datalist
                        response.millData.forEach(function (mill) {
                            html = html + '<option value="'+mill.mu_description+'"></option>';
                        });
                        console.log(html);
                        datalistElement.html(html);
                    },
                    error: function (response) {
                        alert('Mill not found');
                    }
                });
            });

        {{--$("body").on("change", "#mill_code", function () {--}}
            {{--    let url = '{{route('dashboard.ajax','for')}}';--}}
            {{--    let mill_code = $(this).val();--}}
            {{--    url = url.replace('for', 'getMillUtilization');--}}
            {{--    $.ajax({--}}
            {{--        url: url,--}}
            {{--        data: {--}}
            {{--            mill_code: mill_code,--}}
            {{--        },--}}
            {{--        type: 'GET',--}}
            {{--        success: function (response) {--}}
            {{--            let datalistElement = $("#markings_list");--}}
            {{--            datalistElement.html(""); // Clear any existing options--}}

            {{--            let html;--}}
            {{--            // Iterate over the response data and append options to the datalist--}}
            {{--            response.millData.forEach(function (mill) {--}}
            {{--                html = html + '<option value="'+mill.mu_description+'"></option>';--}}
            {{--            });--}}
            {{--            console.log(html);--}}
            {{--            datalistElement.html(html);--}}
            {{--        },--}}
            {{--        error: function (response) {--}}
            {{--            alert('Mill not found');--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}



        /** Trader_Cluster_address_List_Aten **/
        $("body").on("change", "#trader_name", function () {
            let url = '{{ route('dashboard.ajax', 'for') }}';
            let traderName = $(this).val(); // Use trader name as the value for request
            url = url.replace('for', 'getTraderCluster');

            $.ajax({
                url: url,
                data: {
                    trader_name: traderName, // Pass trader_name to the server
                },
                type: 'GET',
                success: function (response) {
                    let datalistElement = $("#cluster_list");
                    datalistElement.html(""); // Clear existing options

                    let html = '';
                    if (response.traderData && response.traderData.length > 0) {
                        response.traderData.forEach(function (trader) {
                            html += '<option value="' + trader.sp_shipper_add + '"></option>';
                        });
                    } else {
                        html = '<option value="No addresses available"></option>';
                    }
                    datalistElement.html(html);
                },
                error: function () {
                    $("#cluster_list").html('<option value="Error fetching data"></option>');
                }
            });
        });


            $("body").on("change", "#consignee_name", function () {
                let url = '{{ route('dashboard.ajax', 'for') }}';
                let consigneeName = $(this).val(); // Use trader name as the value for request
                url = url.replace('for', 'getConsigneeCluster');

                $.ajax({
                    url: url,
                    data: {
                        consignee_name: consigneeName, // Pass trader_name to the server
                    },
                    type: 'GET',
                    success: function (response) {
                        let datalistElement = $("#clusterC_list");
                        datalistElement.html(""); // Clear existing options

                        let html = '';
                        if (response.consigneeData && response.consigneeData.length > 0) {
                            response.consigneeData.forEach(function (consignee) {
                                html += '<option value="' + consignee.sp_consignee_add + '"></option>';
                            });
                        } else {
                            html = '<option value="No addresses available"></option>';
                        }
                        datalistElement.html(html);
                    },
                    error: function () {
                        $("#clusterC_list").html('<option value="Error fetching data"></option>');
                    }
                });
            });





            {{--$("body").on("change", "#trader_name", function () {--}}
            {{--    let url = '{{ route('dashboard.ajax', 'for') }}';--}}
            {{--    let slug = $(this).val();--}}
            {{--    url = url.replace('for', 'getTraderCluster');--}}

            {{--    $.ajax({--}}
            {{--        url: url,--}}
            {{--        data: {--}}
            {{--            slug: slug,--}}
            {{--        },--}}
            {{--        type: 'GET',--}}
            {{--        success: function (response) {--}}
            {{--            let datalistElement = $("#cluster_list");--}}
            {{--            datalistElement.html("");--}}

            {{--            let html = '';--}}
            {{--            if (response.traderData && response.traderData.length > 0) {--}}
            {{--                response.traderData.forEach(function (trader_cluster) {--}}
            {{--                    html += '<option value="' + trader_cluster.tc_address+ '"></option>';--}}
            {{--                });--}}
            {{--            } else {--}}
            {{--                html = '<option value="No cluster addresses available"></option>';--}}
            {{--            }--}}
            {{--            datalistElement.html(html);--}}
            {{--        },--}}
            {{--        error: function () {--}}
            {{--            $("#cluster_list").html('<option value="Error fetching data"></option>');--}}
            {{--        }--}}
            {{--    });--}}

            {{--});--}}







        $("body").on("change","#user_id",function (){
            let url = '{{route('dashboard.ajax','for')}}';
            let user_id = $(this).val();
            url = url.replace('for','getOfficerPosition');
            $.ajax({
                url : url,
                data: {
                    user_id : user_id,
                },
                type: 'GET',
                success:function (response){
                    $("#form_add_shipping_permits input[name='sp_collecting_officer_position']").val(response.position);
                },
                error: function (response){
                    $or ?? abort(503,'User not found');
                }
            });
        })


        $("body").on("change","#vessel_description",function (){
            let url = '{{route('dashboard.ajax','for')}}';
            let vessel_description = $(this).val();
            url = url.replace('for','getShipOperator');
            $.ajax({
                url : url,
                data: {
                    vessel_description : vessel_description,
                },
                type: 'GET',
                success:function (response){
                    $("#form_add_shipping_permits input[name='sp_ship_operator']").val(response.vessel_ship_operator);
                },
                error: function (response){
                    $or ?? abort(503,'Consignee not found');
                }
            });
        })

        $("body").on("change","#trader_name",function (){
            let url = '{{route('dashboard.ajax','for')}}';
            let trader_name = $(this).val();
            url = url.replace('for','getTraderTinConsignee');
            $.ajax({
                url : url,
                data: {
                    trader_name : trader_name,
                },
                type: 'GET',
                success:function (response){
                    $("#form_add_shipping_permits input[name='sp_shipper_add']").val(response.trader_address);
                    $("#form_add_shipping_permits input[name='sp_shipper_tin']").val(response.trader_tin);
                },
                error: function (response){
                    $or ?? abort(503,'Trader not found');
                }
            });
        })


        $("body").on("change","#consignee_name",function (){
            let url = '{{route('dashboard.ajax','for')}}';
            let consignee_name = $(this).val();
            url = url.replace('for','getAddressTinConsignee');
            $.ajax({
                url : url,
                data: {
                    consignee_name : consignee_name,
                },
                type: 'GET',
                success:function (response){
                    $("#form_add_shipping_permits input[name='sp_consignee_add']").val(response.consignee_address);
                    $("#form_add_shipping_permits input[name='sp_consignee_tin']").val(response.consignee_tin);
                },
                error: function (response){
                    $or ?? abort(503,'Consignee not found');
                }
            });
        })









        });

        // document.getElementById('add_volume_btn').addEventListener('click', function() {
        //     const tableBody = document.querySelector('#addVolumeTable tbody');
        //     const newRow = document.createElement('tr');
        //
        //     newRow.innerHTML = `
        //     <td><input type="text" class="form-control" name="crop_year[]" placeholder="Enter Crop Year" required></td>
        //     <td><input type="text" class="form-control" name="sro_number[]" placeholder="Enter SRO Number" required></td>
        //     <td><input type="number" class="form-control" name="amount[]" placeholder="Enter Amount" required></td>
        //     <td><button type="button" class="btn btn-danger btn-sm removeRowBtn">Remove</button></td>
        // `;
        //
        //     tableBody.appendChild(newRow);
        // });
        //
        // document.querySelector('#addVolumeTable').addEventListener('click', function(e) {
        //     if (e.target.classList.contains('removeRowBtn')) {
        //         e.target.closest('tr').remove();
        //     }
        // });





        $("#add_row_item").click(function(){
            let rowTemplate = $("#item_template").html();
            let random = makeId(10);
            rowTemplate = rowTemplate.replaceAll('rand', random);

            $("#volume_table tbody").append(rowTemplate);
            $(".autonum_" + random).each(function(){
                $(this).attr('autocomplete', 'off');
                new AutoNumeric(this, autonum_settings);
            });

            utiltableAmounttoShippingPermit();
            // UtilizationTableAmountTotal();
        });

        // Delete item button
        $("body").on("click", '.delete_row_item', function (){
            $(this).closest('tr').remove();
            utiltableAmounttoShippingPermit();
            // UtilizationTableAmountTotal();
        });


        function SanitizeAutoNum(num){
            // num = num.replace("/,/g","").replace("/₱/g","");
            num = num.replaceAll(",","").replaceAll("₱","");
            num = parseFloat(num);
            return num;
        }

        // Function to extract data from the utilization table and calculate total amount
        function utiltableAmounttoShippingPermit() {
            let tableData = [];
            let totalAmount = 0;
            let totalAmountSuper = 0;

            $("#volume_table tbody tr").each(function() {
                // let txnType = $(this).find("select").val();
                let amount = SanitizeAutoNum($(this).find("input[name*='amount']").val()) || 0;
                // SanitizeAutoNum($(this).find("input[name*='amount']").val());
                let rowData = {
                    // txnType: txnType,
                    amount: amount
                };

                tableData.push(rowData);

                // Add the current amount to the total amount
                totalAmount += amount;
                totalAmountSuper = totalAmount * 3;
            });

            // Update the 'or_shipping_permit' field with the total amount from the table
            $("#sp_volume").val(totalAmount.toFixed(2));

            const autoNumInstance = new AutoNumeric('#sp_amount', {
                decimalPlaces: 2,
                digitGroupSeparator: ',',
                decimalCharacter: '.',
            });

            // Set value programmatically and apply formatting
            autoNumInstance.set(totalAmountSuper.toFixed(2));

            // Recalculate the total amount
            // calculateTotalAmount();
        }

        // Trigger utiltableAmounttoShippingPermit when oru_amount changes
        $("#volume_table tbody").on("input", "input[name*='amount']", function () {
            utiltableAmounttoShippingPermit();
        });
    </script>

@endsection