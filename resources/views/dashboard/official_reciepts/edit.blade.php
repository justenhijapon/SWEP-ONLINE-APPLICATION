@php
    $rand = \Illuminate\Support\Str::random();
@endphp
<form id="edit_official_reciepts_form_{{$rand}}" autocomplete="off">
    @csrf
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Reciept Details</h4>
    </div>

    <div class="modal-body">
        @method('PUT')

        <div class="box-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="modal-header">
                        <h4 class="modal-title">O.R. Details</h4>
                    </div>
                    <div class="row">

                        {!! \App\Core\Helpers\__form2::textbox('or_no',[
                            'label' => 'O.R. No.:',
                            'cols' => 6,
                             'type' => 'number',
                             'class' => 'autonum_init',
                        ],$or ?? null) !!}
                        {!! \App\Core\Helpers\__form2::textbox('or_date',[
                            'label' => 'O.R. Date:',
                            'type' => 'date',
                            'cols' => 6,
                        ],$or ?? null) !!}

                    </div>
                    <div class="row">
                        {!! \App\Core\Helpers\__form2::select('or_mill',[
                            'label' => 'Mill:',
                            'cols' => 6,
                            'options' => \App\Core\Helpers\Arrays::millarray(),
                        ],$or ?? null) !!}
                        {!! \App\Core\Helpers\__form2::select('or_sugar_class',[
                            'label' => 'Sugar Class:',
                            'cols' => 6,
                            'options' => \App\Core\Helpers\Arrays::SugarClass(),
                        ],$or ?? null) !!}
                    </div>
                    <div class="row">
                        {!! \App\Core\Helpers\__form2::select('or_payor',[
                           'label' => 'Payor:',
                           'cols' => 12,
                           'options' => \App\Core\Helpers\Arrays::orPayor(),
                        ],$or ?? null) !!}

                    </div>
                    <div class="row">

                        {!! \App\Core\Helpers\__form2::select('or_crop_year',[
                            'label' => 'Crop Year:',
                            'options' => \App\Core\Helpers\Arrays::cropYear(),
                            'cols' => 12,
                        ],$or ?? null) !!}

                    </div>
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="no-margin">
                                            <b>Add Item</b>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <button id="add_row_item_edit_{{$rand}}" type="button" class="btn btn-xs btn-success pull-right">Add Item &nbsp;<i class="fa fw fa-plus"></i></button>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered" id="edit_utilization_table_{{$rand}}">

                                    <thead>
                                    <tr>
                                        <th>TXN TYPE</th>
                                        <th>SP NO.</th>
                                        <th>VOLUME</th>
                                        <th>AMOUNT</th>
                                        <th style="width: 40px"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($or->orUtilization as $key => $orShippingPermit)
                                        <tr>
                                            <td style="display: none;">
                                                {!! \App\Core\Helpers\__form2::textboxOnly('items['.$orShippingPermit->slug.'][slug]',[
                                                ],$orShippingPermit->slug ?? null) !!}
                                            </td>
                                            <td>
                                                {!! \App\Core\Helpers\__form2::selectOnly('items['.$orShippingPermit->slug.'][oru_txn_type]',[
                                                  'options' => \App\Core\Helpers\Arrays::spStatus(),
                                                ],$orShippingPermit->oru_txn_type ?? null) !!}
                                            </td>
                                            <td>{!! \App\Core\Helpers\__form2::textboxOnly('items['.$orShippingPermit->slug.'][oru_sp_no]',[
                                                'label' => 'S.P. No.:',
                                             ],$orShippingPermit->oru_sp_no ?? null) !!}
                                            </td>
                                            <td>{!! \App\Core\Helpers\__form2::textboxOnly('items['.$orShippingPermit->slug.'][oru_volume]',[
                                                'label' => 'Volume:',
                                             ],$orShippingPermit->oru_volume ?? null) !!}
                                            </td>
                                            <td>{!! \App\Core\Helpers\__form2::textboxOnly('items['.$orShippingPermit->slug.'][oru_amount]',[
                                                'label' => 'Amount:',
                                                'class' => 'autonum_rand',
                                             ],$orShippingPermit->oru_amount ?? null) !!}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm bg-red delete_row_item">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-header">
                            <h4 class="modal-title">Payment Details</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row">

                                    {!! \App\Core\Helpers\__form2::textbox('or_drawee_bank',[
                                        'label' => 'Drawee Bank:',

                                        'cols' => 6,
                                    ],$or ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('or_cash_amount',[
                                        'label' => 'Cash Amount:',
                                        'cols' => 6,
                                    ],$or ?? null) !!}
                                </div>
                                <div class="row">

                                    {!! \App\Core\Helpers\__form2::textbox('or_chk_acct_no',[
                                        'label' => 'Chk. Acct No.:',
                                        'cols' => 6,
                                         'type' => 'number',
                                    ],$or ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('or_check_amount',[
                                        'label' => 'Check Amount:',
                                        'cols' => 6,
                                    ],$or ?? null) !!}


                                </div>
                                <div class="row">
                                    {!! \App\Core\Helpers\__form2::textbox('or_chk_no',[
                                        'label' => 'Check No.:',
                                        'cols' => 6,
                                         'type' => 'number',
                                    ],$or ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('or_money_order',[
                                        'label' => 'Money Order:',
                                        'cols' => 6,
                                    ],$or ?? null) !!}

                                </div>
                                <div class="row">
                                    {!! \App\Core\Helpers\__form2::textbox('or_chk_date',[
                                        'label' => 'Check Date:',
                                        'cols' => 6,
                                    ],$or ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('or_total_paid',[
                                        'label' => 'Total Paid:',
                                        'cols' => 6,
                                        'readonly' => 'readonly',
                                    ],$or ?? null) !!}

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="modal-header">
                            <h4 class="modal-title">Nature of Payment</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row">

                                    {!! \App\Core\Helpers\__form2::textbox('or_cancellation',[
                                        'label' => 'Cancellation:',
                                        'cols' => 12,
                                    ],$or ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('or_shut_out',[
                                        'label' => 'Shut-out:',
                                        'cols' => 12,
                                    ],$or ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('or_transhipment',[
                                        'label' => 'Transhipment:',
                                        'cols' => 12,
                                    ],$or ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('or_shipping_permit',[
                                        'label' => 'Shipping Permit:',
                                        'cols' => 12,
                                    ],$or ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('or_other_fees',[
                                        'label' => 'Other Fees:',
                                        'cols' => 12,
                                    ],$or ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('or_other_fees_2',[
                                        'label' => 'Other Fees:',
                                        'cols' => 12,
                                    ],$or ?? null) !!}
                                </div>
                                <div class="row">

                                    {!! \App\Core\Helpers\__form2::textbox('or_total_amount',[
                                        'label' => 'Total Amount:',
                                        'cols' => 12,
                                        'readonly' => 'readonly'
                                    ],$total ?? null) !!}
                                    {!! \App\Core\Helpers\__form2::textbox('or_report_no',[
                                        'label' => 'Report No.:',
                                        'cols' => 12,
                                    ],$or ?? null) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!}"><i class="fa fa-save"></i> Save</button>
        </div>
    </div>
</form>




<script type="text/javascript">

    autonum_settings = {
        currencySymbol : ' ₱',
        decimalCharacter : '.',
        digitGroupSeparator : ',',
    };

    $("#edit_official_reciepts_form_{{$rand}} .autonum").each(function(){
        new AutoNumeric(this, autonum_settings);
    })

    $('#edit_official_reciepts_form_{{$rand}} .select2').select2();

    $("#edit_official_reciepts_form_{{$rand}}").submit(function(e){
        let form = $(this);
        e.preventDefault();
        let uri = "{{ route('dashboard.official_reciepts.update', 'slug') }}";
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
                official_reciepts_table.draw(false);
                notify('Data successfully updated.','success');
            },
            error: function(res){
                errored(form,res);
            }
        })
    })

    $("#add_row_item_edit_{{$rand}}").click(function(){
        console.log(1);
        let rowTemplate = $("#item_template").html();
        let random = makeId(10);
        rowTemplate = rowTemplate.replaceAll('rand',random);

        $("#edit_utilization_table_{{$rand}} tbody").append(rowTemplate);
        $(".autonum_"+ random).each(function(){
            $(this).attr('autocomplete','off');
            new AutoNumeric(this, autonum_settings);
        });
    })

</script>




