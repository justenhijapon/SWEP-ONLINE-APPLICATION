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

                    {!! \App\Core\Helpers\__form2::textbox('sp_no',[
                        'label' => 'Shipping Permit No.:',
                        'cols' => 6,
                         'class' => 'autonum_init',
                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::textbox('sp_edd_etd',[
                        'label' => 'EDD/ETD:',
                        'type' => 'date',
                        'cols' => 6,
                    ],$sp ?? null) !!}
                </div>
                <div class="row">

                    {!! \App\Core\Helpers\__form2::textbox('sp_date',[
                        'label' => 'Permit Date:',
                        'type' => 'date',
                        'cols' => 6,
                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::textbox('sp_eda_eta',[
                        'label' => 'EDA/ETA:',
                        'type' => 'date',
                        'cols' => 6,
                    ],$sp ?? null) !!}
                </div>
                <div class="row">

                    {!! \App\Core\Helpers\__form2::select('sp_port_of_origin',[
                        'label' => 'Port of Origin:',
                        'cols' => 8,
                        'options' => \App\Core\Helpers\Arrays::portofOrigin(),
                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::select('sp_mill',[
                        'label' => 'Mill:',
                        'cols' => 4,
                        'options' => \App\Core\Helpers\Arrays::originmill(),
                    ],$sp ?? null) !!}
                </div>
                <div class="row">

                    {!! \App\Core\Helpers\__form2::select('sp_port_of_destination',[
                        'label' => 'Port of Destination:',
                        'cols' => 8,
                        'options' => \App\Core\Helpers\Arrays::portofdestination(),
                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::select('sp_sugar_class',[
                        'label' => 'Sugar Class:',
                        'options' => [
                            'RAW' => 'RAW',
                            'DIRECT CONSUMPTION' => 'DIRECT CONSUMPTION',
                            'REFINED' => 'REFINED',
                            'OTHER'=> 'OTHER'
                            ],
                        'cols' => 4,
                    ],$sp ?? null) !!}
                </div>
                <div class="row">

                    {!! \App\Core\Helpers\__form2::select('sp_vessel',[
                        'label' => 'Name of Vessel:',
                        'cols' => 8,
                        'options' => \App\Core\Helpers\Arrays::spvessel(),

                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::textbox('sp_volume',[
                        'label' => 'Volume:',
                        'cols' => 4,
                    ],$sp ?? null) !!}
                </div>
                <div class="row">

                    {!! \App\Core\Helpers\__form2::textbox('sp_ship_operator',[
                        'label' => 'Ship Operator:',
                        'cols' => 8,
                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::textbox('sp_uom',[
                        'label' => 'UoM:',
                        'cols' => 4,
                    ],$sp ?? null) !!}
                </div>
                <div class="row">

                    {!! \App\Core\Helpers\__form2::select('sp_freight',[
                        'label' => 'Freight:',
                        'cols' => 4,
                        'options' => \App\Core\Helpers\Arrays::spfreight(),

                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::textbox('sp_plate_no',[
                        'label' => 'Plate No.:',
                        'cols' => 4,
                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::select('sp_or_no',[
                        'label' => 'O.R. No.:',
                        'cols' => 4,
                        'id' => 'or_no',
                        'options' => \App\Core\Helpers\Arrays::spOR(),
                    ],$sp ?? null) !!}
                </div>
                <div class="row">

                    {!! \App\Core\Helpers\__form2::textbox('sp_remarks',[
                        'label' => 'Remarks:',
                        'cols' => 8,
                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::textbox('sp_amount',[
                        'label' => 'Amount:',
                        'cols' => 4,
                        'class' => 'autonum',
                    ],$sp ?? null) !!}
                </div>
                <div class="row">

                    {!! \App\Core\Helpers\__form2::textbox('sp_ref_sp_no',[
                        'label' => 'Ref SP No.:',
                        'cols' => 8,
                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::select('sp_status',[
                        'label' => 'Status:',
                        'options' => [
                            'PENDING' => 'PENDING',
                            'SHIPPED' => 'SHIPPED',
                            'CANCELLED' => 'CANCELLED'
                            ],
                        'cols' => 4,
                    ],$sp ?? null) !!}
                </div>
            </div>
        </div>
        <div class="modal-header">
            <h4 class="modal-title">Shipper</h4>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row">

                    {!! \App\Core\Helpers\__form2::textbox('sp_markings',[
                        'label' => 'Markings:',
                        'cols' => 12,
                    ],$sp ?? null) !!}
                </div>
                <div class="row">

                    {!! \App\Core\Helpers\__form2::textbox('sp_shipper',[
                        'label' => 'Shipper:',
                        'cols' => 5,
                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::textbox('sp_shipper_add',[
                        'label' => 'Shipper Address:',
                        'cols' => 5,
                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::textbox('sp_shipper_tin',[
                        'label' => 'Shipper Tin:',
                        'cols' => 2,
                    ],$sp ?? null) !!}
                </div>
                <div class="row">

                    {!! \App\Core\Helpers\__form2::textbox('sp_consignee',[
                        'label' => 'Consignee:',
                        'cols' => 5,
                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::textbox('sp_consignee_add',[
                        'label' => 'Consignee Address:',
                        'cols' => 5,
                    ],$sp ?? null) !!}
                    {!! \App\Core\Helpers\__form2::textbox('sp_consignee_tin',[
                        'label' => 'Consignee Tin:',
                        'cols' => 2,
                    ],$sp ?? null) !!}
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

</script>


