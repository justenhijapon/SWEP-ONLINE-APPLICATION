@extends('layouts.admin-master')

@section('content')

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
                                                <!-- O.R. No. -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_or_no',[
                                                'label' => 'O.R. No.:',
                                                'cols' => 3,
//                                                'id' => 'or_no',
//                                                'options' => \App\Core\Helpers\Arrays::spOR(),
                                                ]) !!}
                                                <!-- Shipping Permit No. -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_no',[
                                                'label' => 'Shipping Permit No.:',
                                                'cols' => 3,
                                                'type' => 'number',
                                                'class' => 'autonum_init',
                                                ]) !!}
                                                <!-- Permit Date -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_date',[
                                                'label' => 'Permit Date:',
                                                'type' => 'date',
                                                'cols' => 2,
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
                                            </div>
                                            <div class="row">
                                                <!-- Port of Origin -->
                                                {!! \App\Core\Helpers\__form2::select('sp_port_of_origin',[
                                                'label' => 'Port of Origin:',
                                                'cols' => 3,
                                                'options' => \App\Core\Helpers\Arrays::portarray(),
                                                ]) !!}
                                                <!-- Port of Destination -->
                                                {!! \App\Core\Helpers\__form2::select('sp_port_of_destination',[
                                                'label' => 'Port of Destination:',
                                                'cols' => 3,
                                                'options' => \App\Core\Helpers\Arrays::portarray(),
                                                ]) !!}
                                                <!-- Mill -->
                                                {!! \App\Core\Helpers\__form2::select('sp_mill',[
                                                'label' => 'Mill:',
                                                'cols' => 3,
                                                'options' => \App\Core\Helpers\Arrays::millarray(),
                                                'id' => 'mill_code',
                                                ]) !!}
                                                <!-- Sugar Class -->
                                                {!! \App\Core\Helpers\__form2::select('sp_sugar_class',[
                                                'label' => 'Sugar Class:',
                                                'options' => \App\Core\Helpers\Arrays::SugarClass(),
                                                'cols' => 3,
                                                ]) !!}
                                            </div>
                                            <div class="row">
                                                <!-- Volume -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_volume',[
                                                'label' => 'Volume:',
                                                'type' => 'number',
                                                'cols' => 3,
                                                ]) !!}
                                                <!-- Amount -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_amount',[
                                                'label' => 'Amount:',
                                                'cols' => 3,
                                                'class' => 'autonum',
                                                ]) !!}
                                                <!-- Ref SP No. -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_ref_sp_no',[
                                                'label' => 'Ref SP No.:',
                                                'cols' => 3,
                                                ]) !!}
                                                <!-- UoM -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_uom',[
                                                'label' => 'UoM:',
                                                'cols' => 3,
                                                ]) !!}
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
                                                'cols' => 3,
//                                                'options' => \App\Core\Helpers\Arrays::spfreight(),
                                                ]) !!}
                                                <!-- Plate No. -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_plate_no',[
                                                'label' => 'Plate No.:',
                                                'cols' => 3,
                                                ]) !!}
                                            </div>
                                            <div class="row">
                                                <!-- Remarks -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_remarks',[
                                                'label' => 'Remarks:',
                                                'cols' => 8,
                                                ]) !!}
                                                <!-- Status -->
                                                {!! \App\Core\Helpers\__form2::select('sp_status',[
                                                'label' => 'Status:',
                                                'options' => \App\Core\Helpers\Arrays::spStatus(),
                                                'cols' => 4,
                                                ]) !!}
                                            </div>
                                            <div class="row">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Shipper</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Markings -->
                                                {!! \App\Core\Helpers\__form2::select('sp_markings',[
                                                'label' => 'Markings:',
                                                'cols' => 6,
                                                 'options' => [],
                                                ]) !!}
                                                {!! \App\Core\Helpers\__form2::select('sp_collecting_officer',[
                                               'label' => 'Collecting Officer:',
                                               'cols' => 4,
                                               'options' => \App\Core\Helpers\Arrays::spCollectingOfficer(),
                                               'id' => 'user_id',
                                               ]) !!}
                                                {!! \App\Core\Helpers\__form2::textbox('sp_collecting_officer_position',[
                                               'label' => 'Position:',
                                               'cols' => 2,
                                               ]) !!}
                                            </div>
                                            <div class="row">
                                                <!-- Shipper, Shipper Address, and Shipper Tin -->
                                                {!! \App\Core\Helpers\__form2::select('sp_shipper',[
                                                'options' => \App\Core\Helpers\Arrays::sptrader(),
                                                'label' => 'Shipper:',
                                                'id' => 'trader_name',
                                                'cols' => 2,
                                                ]) !!}
                                                {!! \App\Core\Helpers\__form2::textbox('sp_shipper_add',[
                                                'label' => 'Shipper Address:',
                                                'cols' => 2,
                                                ]) !!}
                                                {!! \App\Core\Helpers\__form2::textbox('sp_shipper_tin',[
                                                'label' => 'Shipper Tin:',
                                                'cols' => 2,
                                                ]) !!}
                                                <!-- Consignee, Consignee Address, and Consignee Tin -->
                                                {!! \App\Core\Helpers\__form2::select('sp_consignee',[
                                                'options' => \App\Core\Helpers\Arrays::spconsignee(),
                                                'label' => 'Consignee:',
                                                'id' => 'consignee_name',
                                                'cols' => 2,
                                                ]) !!}
                                                {!! \App\Core\Helpers\__form2::textbox('sp_consignee_add',[
                                                'label' => 'Consignee Address:',
                                                'cols' => 2,
                                                ]) !!}
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
                    denyButtonText: `Print`
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
                    let selectElement = $("#form_add_shipping_permits select[name='sp_markings']");
                    selectElement.empty(); // Clear any existing options

                    // Iterate over the response data and append options to the select element
                    response.millData.forEach(function (mill) {
                        let option = $("<option></option>")
                            // .attr("value", mill.mu_marking_code) // Assuming 'id' is a property of the mill
                            .text(mill.mu_description); // Assuming 'name' is a property of the mill
                        selectElement.append(option);
                    });
                },
                error: function (response) {
                    alert('Mill not found');
                }
            });
        });

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
    </script>

@endsection