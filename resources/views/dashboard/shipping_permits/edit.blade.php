@php
    $rand = \Illuminate\Support\Str::random();
@endphp
<form id="edit_shipping_permits_form_{{$rand}}" autocomplete="off">
    @csrf
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Permit Details</h4>
    </div>

    <div class="modal-body">
        @method('PUT')

        <div class="modal-body">
            <div class="col-md-12">
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
                                    ],$sp ?? null) !!}
                                    <!-- Shipping Permit No. -->
                                    {!! \App\Core\Helpers\__form2::textbox('sp_no',[
                                    'label' => 'Shipping Permit No.:',
                                    'cols' => 3,
                                    'type' => 'number',
                                    'class' => 'autonum_init',
                                    ],$sp ?? null) !!}
                                    <!-- Permit Date -->
                                    {!! \App\Core\Helpers\__form2::textbox('sp_date',[
                                    'label' => 'Permit Date:',
                                    'type' => 'date',
                                    'cols' => 2,
                                    ],$sp ?? null) !!}
                                    <!-- EDD/ETD -->
                                    {!! \App\Core\Helpers\__form2::textbox('sp_edd_etd',[
                                    'label' => 'EDD/ETD:',
                                    'type' => 'date',
                                    'cols' => 2,
                                    ],$sp ?? null) !!}

                                    <!-- EDA/ETA -->
                                    {!! \App\Core\Helpers\__form2::textbox('sp_eda_eta',[
                                    'label' => 'EDA/ETA:',
                                    'type' => 'date',
                                    'cols' => 2,
                                    ],$sp ?? null) !!}
                                </div>
                                <div class="row">
                                    <!-- Port of Origin -->
                                    {!! \App\Core\Helpers\__form2::select('sp_port_of_origin',[
                                    'label' => 'Port of Origin:',
                                    'cols' => 3,
                                    'options' => \App\Core\Helpers\Arrays::portarray(),
                                    ],$sp ?? null) !!}
                                    <!-- Port of Destination -->
                                    {!! \App\Core\Helpers\__form2::select('sp_port_of_destination',[
                                    'label' => 'Port of Destination:',
                                    'cols' => 3,
                                    'options' => \App\Core\Helpers\Arrays::portarray(),
                                    ],$sp ?? null) !!}
                                    <!-- Mill -->
                                    {!! \App\Core\Helpers\__form2::select('sp_mill',[
                                    'label' => 'Mill:',
                                    'cols' => 3,
                                    'options' => \App\Core\Helpers\Arrays::millarray(),
                                    'id' => 'mill_code',
                                    ],$sp ?? null) !!}
                                    <!-- Sugar Class -->
                                    {!! \App\Core\Helpers\__form2::select('sp_sugar_class',[
                                    'label' => 'Sugar Class:',
                                    'options' => \App\Core\Helpers\Arrays::SugarClass(),
                                    'cols' => 3,
                                    ],$sp ?? null) !!}
                                </div>
                                <div class="row">
                                    <!-- Volume -->
                                    {!! \App\Core\Helpers\__form2::textbox('sp_volume',[
                                    'label' => 'Volume:',
                                    'type' => 'number',
                                    'cols' => 3,
                                    ],$sp ?? null) !!}
                                    <!-- Amount -->
                                    {!! \App\Core\Helpers\__form2::textbox('sp_amount',[
                                    'label' => 'Amount:',
                                    'cols' => 3,
                                    'class' => 'autonum',
                                    ],$sp ?? null) !!}
                                    <!-- Ref SP No. -->
                                    {!! \App\Core\Helpers\__form2::textbox('sp_ref_sp_no',[
                                    'label' => 'Ref SP No.:',
                                    'cols' => 3,
                                    ],$sp ?? null) !!}
                                    <!-- UoM -->
                                    {!! \App\Core\Helpers\__form2::textbox('sp_uom',[
                                    'label' => 'UoM:',
                                    'cols' => 3,
                                    ],$sp ?? null) !!}
                                </div>
                                <div class="row">
                                    <!-- Name of Vessel -->
                                    {!! \App\Core\Helpers\__form2::select('sp_vessel',[
                                    'label' => 'Name of Vessel:',
                                    'cols' => 3,
                                    'options' => \App\Core\Helpers\Arrays::spvessel(),
                                    'id' => 'vessel_description',
                                    ],$sp ?? null) !!}
                                    <!-- Ship Operator -->
                                    {!! \App\Core\Helpers\__form2::textbox('sp_ship_operator',[
                                    'label' => 'Ship Operator:',
                                    'cols' => 3,
                                    'id' => 'ship_operator',
                                    ],$sp ?? null) !!}
                                    <!-- Freight -->
                                    {!! \App\Core\Helpers\__form2::textbox('sp_freight',[
                                    'label' => 'Freight:',
                                    'cols' => 3,
//                                                'options' => \App\Core\Helpers\Arrays::spfreight(),
                                    ],$sp ?? null) !!}
                                    <!-- Plate No. -->
                                    {!! \App\Core\Helpers\__form2::textbox('sp_plate_no',[
                                    'label' => 'Plate No.:',
                                    'cols' => 3,
                                    ],$sp ?? null) !!}
                                </div>
                                <div class="row">
                                    <!-- Remarks -->
                                    {!! \App\Core\Helpers\__form2::textbox('sp_remarks',[
                                    'label' => 'Remarks:',
                                    'cols' => 8,
                                    ],$sp ?? null) !!}
                                    <!-- Status -->
                                    {!! \App\Core\Helpers\__form2::select('sp_status',[
                                    'label' => 'Status:',
                                    'options' => [
                                        '114370' => '114370',
                                        '125093' => '125093',
                                        'CANCELLATION' => 'CANCELLATION',
                                        'CANCELLED' => 'CANCELLED',
                                        'CANCELLED ERROR IN PRINT' => 'CANCELLED ERROR IN PRINT',
                                        'ISSUED' => 'ISSUED',
                                        'RETURN SHIPMENT' => 'RETURN SHIPMENT',
                                        'SHUT-OUT' => 'SHUT-OUT',
                                        'TRANSHIPMENT' => 'TRANSHIPMENT',
                                        'W/ TRANSHIPMENT' => 'W/ TRANSHIPMENT',
                                    ],
                                    'cols' => 4,
                                    ],$sp ?? null) !!}
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
                                     'options' => \App\Core\Helpers\Arrays::millutilarray(),
                                    ],$sp ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::select('sp_collecting_officer',[
                                   'label' => 'Collecting Officer:',
                                   'cols' => 4,
                                   'options' => \App\Core\Helpers\Arrays::spCollectingOfficer(),
                                   'id' => 'user_id',
                                   ],$sp ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('sp_collecting_officer_position',[
                                   'label' => 'Position:',
                                   'cols' => 2,
                                   ],$sp ?? null) !!}
                                </div>
                                <div class="row">
                                    <!-- Shipper, Shipper Address, and Shipper Tin -->
                                    {!! \App\Core\Helpers\__form2::select('sp_shipper',[
                                    'options' => \App\Core\Helpers\Arrays::sptrader(),
                                    'label' => 'Shipper:',
                                    'id' => 'trader_name',
                                    'cols' => 2,
                                    ],$sp ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('sp_shipper_add',[
                                    'label' => 'Shipper Address:',
                                    'cols' => 2,
                                    ],$sp ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('sp_shipper_tin',[
                                    'label' => 'Shipper Tin:',
                                    'cols' => 2,
                                    ],$sp ?? null) !!}
                                    <!-- Consignee, Consignee Address, and Consignee Tin -->
                                    {!! \App\Core\Helpers\__form2::select('sp_consignee',[
                                    'options' => \App\Core\Helpers\Arrays::spconsignee(),
                                    'label' => 'Consignee:',
                                    'id' => 'consignee_name',
                                    'cols' => 2,
                                    ],$sp ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('sp_consignee_add',[
                                    'label' => 'Consignee Add.:',
                                    'cols' => 2,
                                    ],$sp ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('sp_consignee_tin',[
                                    'label' => 'Consignee Tin:',
                                    'cols' => 2,
                                    ],$sp ?? null) !!}
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} pull-right update_shipping_permits_btn"> <i class="fa fa-fw fa-save"></i> Save</button>
    </div>
</form>



<script type="text/javascript">

    autonum_settings = {
        currencySymbol : ' ₱',
        decimalCharacter : '.',
        digitGroupSeparator : ',',
    };

    $("#edit_shipping_permits_form_{{$rand}} .autonum").each(function(){
        new AutoNumeric(this, autonum_settings);
    })

    $('#edit_shipping_permits_form_{{$rand}} .select2').select2();

    $("#edit_shipping_permits_form_{{$rand}}").submit(function(e){
        let form = $(this);
        e.preventDefault();
        let uri = "{{ route('dashboard.shipping_permits.update', 'slug') }}";
        uri = uri.replace('slug',id);
        let formData = new FormData(this);
        $.ajax({
            url: uri,
            data: formData,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res){
                succeed(form,true,true);

                active = res.slug;
                shipping_permits_table.draw(false);
                notify('Data successfully updated.','success');
            },
            error: function(res){
                errored(form,res);
            }
        })
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
                $("#edit_shipping_permits_form_{{$rand}} input[name='sp_amount']").val(response.sample);
                $("#edit_shipping_permits_form_{{$rand}} input[name='sp_volume']").val(response.or_payor);

            },
            error: function (response){
                $or ?? abort(503,'OR not found');
            }
        });
    })

    // Disable the select initially
    $("#edit_shipping_permits_form_{{$rand}} select[name='sp_markings']").prop('disabled', true);

    // Listen for changes in #mill_code
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
                let selectElement = $("#edit_shipping_permits_form_{{$rand}} select[name='sp_markings']");
                selectElement.empty(); // Clear any existing options

                // Iterate over the response data and append options to the select element
                response.millData.forEach(function (mill) {
                    let option = $("<option></option>")
                        // .attr("value", mill.mu_marking_code) // Assuming 'id' is a property of the mill
                        .text(mill.mu_description); // Assuming 'name' is a property of the mill
                    selectElement.append(option);
                });

                // Enable the select after successful response
                selectElement.prop('disabled', false);
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
                $("#edit_shipping_permits_form_{{$rand}} input[name='sp_collecting_officer_position']").val(response.position);
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
                $("#edit_shipping_permits_form_{{$rand}} input[name='sp_ship_operator']").val(response.vessel_ship_operator);
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
                $("#edit_shipping_permits_form_{{$rand}} input[name='sp_shipper_add']").val(response.trader_address);
                $("#edit_shipping_permits_form_{{$rand}} input[name='sp_shipper_tin']").val(response.trader_tin);
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
                $("#edit_shipping_permits_form_{{$rand}} input[name='sp_consignee_add']").val(response.consignee_address);
                $("#edit_shipping_permits_form_{{$rand}} input[name='sp_consignee_tin']").val(response.consignee_tin);
            },
            error: function (response){
                $or ?? abort(503,'Consignee not found');
            }
        });
    })

</script>


