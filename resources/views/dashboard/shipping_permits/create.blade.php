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
                                                <!-- Shipping Permit No. -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_no',[
                                                'label' => 'Shipping Permit No.:',
                                                'cols' => 6,
                                                'class' => 'autonum_init',
                                                ]) !!}
                                                <!-- EDD/ETD -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_edd_etd',[
                                                'label' => 'EDD/ETD:',
                                                'type' => 'date',
                                                'cols' => 3,
                                                ]) !!}

                                                <!-- EDA/ETA -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_eda_eta',[
                                                'label' => 'EDA/ETA:',
                                                'type' => 'date',
                                                'cols' => 3,
                                                ]) !!}
                                            </div>
                                            <div class="row">
                                                <!-- Permit Date -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_date',[
                                                'label' => 'Permit Date:',
                                                'type' => 'date',
                                                'cols' => 2,
                                                ]) !!}
                                                <!-- Port of Origin -->
                                                {!! \App\Core\Helpers\__form2::select('sp_port_of_origin',[
                                                'label' => 'Port of Origin:',
                                                'cols' => 5,
                                                'options' => \App\Core\Helpers\Arrays::portofOrigin(),
                                                ]) !!}
                                                <!-- Port of Destination -->
                                                {!! \App\Core\Helpers\__form2::select('sp_port_of_destination',[
                                                'label' => 'Port of Destination:',
                                                'cols' => 5,
                                                'options' => \App\Core\Helpers\Arrays::portofdestination(),
                                                ]) !!}
                                            </div>
                                            <div class="row">
                                                <!-- Mill -->
                                                {!! \App\Core\Helpers\__form2::select('sp_mill',[
                                                'label' => 'Mill:',
                                                'cols' => 3,
                                                'options' => \App\Core\Helpers\Arrays::originmill(),
                                                ]) !!}
                                                <!-- Sugar Class -->
                                                {!! \App\Core\Helpers\__form2::select('sp_sugar_class',[
                                                'label' => 'Sugar Class:',
                                                'options' => [
                                                'RAW' => 'RAW',
                                                'DIRECT CONSUMPTION' => 'DIRECT CONSUMPTION',
                                                'REFINED' => 'REFINED',
                                                'OTHER'=> 'OTHER'
                                                ],
                                                'cols' => 3,
                                                ]) !!}
                                                <!-- Volume -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_volume',[
                                                'label' => 'Volume:',
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

                                                ]) !!}
                                                <!-- Ship Operator -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_ship_operator',[
                                                'label' => 'Ship Operator:',
                                                'cols' => 3,
                                                ]) !!}
                                                <!-- Freight -->
                                                {!! \App\Core\Helpers\__form2::select('sp_freight',[
                                                'label' => 'Freight:',
                                                'cols' => 3,
                                                'options' => \App\Core\Helpers\Arrays::spfreight(),

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
                                                <!-- Amount -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_amount',[
                                                'label' => 'Amount:',
                                                'cols' => 4,
                                                'class' => 'autonum',
                                                ]) !!}
                                            </div>
                                            <div class="row">
                                                <!-- O.R. No. -->
                                                {!! \App\Core\Helpers\__form2::select('sp_or_no',[
                                                'label' => 'O.R. No.:',
                                                'cols' => 4,
                                                'id' => 'or_no',
                                                'options' => \App\Core\Helpers\Arrays::spOR(),
                                                ]) !!}

                                                <!-- Ref SP No. -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_ref_sp_no',[
                                                'label' => 'Ref SP No.:',
                                                'cols' => 4,
                                                ]) !!}
                                                <!-- Status -->
                                                {!! \App\Core\Helpers\__form2::select('sp_status',[
                                                'label' => 'Status:',
                                                'options' => [
                                                'PENDING' => 'PENDING',
                                                'SHIPPED' => 'SHIPPED',
                                                'CANCELLED' => 'CANCELLED'
                                                ],
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
                                                {!! \App\Core\Helpers\__form2::textbox('sp_markings',[
                                                'label' => 'Markings:',
                                                'cols' => 12,
                                                ]) !!}
                                            </div>
                                            <div class="row">
                                                <!-- Shipper, Shipper Address, and Shipper Tin -->
                                                {!! \App\Core\Helpers\__form2::textbox('sp_shipper',[
                                                'label' => 'Shipper:',
                                                'cols' => 5,
                                                ]) !!}
                                                {!! \App\Core\Helpers\__form2::textbox('sp_shipper_add',[
                                                'label' => 'Shipper Address:',
                                                'cols' => 5,
                                                ]) !!}
                                                {!! \App\Core\Helpers\__form2::textbox('sp_shipper_tin',[
                                                'label' => 'Shipper Tin:',
                                                'cols' => 2,
                                                ]) !!}
                                            </div>
                                            <!-- Consignee, Consignee Address, and Consignee Tin -->
                                            <div class="row">
                                                {!! \App\Core\Helpers\__form2::textbox('sp_consignee',[
                                                'label' => 'Consignee:',
                                                'cols' => 5,
                                                ]) !!}
                                                {!! \App\Core\Helpers\__form2::textbox('sp_consignee_add',[
                                                'label' => 'Consignee Address:',
                                                'cols' => 5,
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
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });


            })





        $("body").on("change","#or_no",function (){
            let url = '{{route('dashboard.ajax','for')}}';
            let or_no = $(this).val();
            url = url.replace('for','getMillFromOR');
            $.ajax({
                url : url,
                data: {
                    or_no : or_no,
                },
                type: 'GET',
                success:function (response){
                    $("#form_add_shipping_permits input[name='sp_volume']").val(response.or_payor);

                },
                error: function (response){
                    $or ?? abort(503,'OR not found');
                }
            });
        })

        });
    </script>

@endsection