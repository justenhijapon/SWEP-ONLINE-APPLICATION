@extends('layouts.admin-master')

@section('content')

    {{-- Item Modal --}}
    <table hidden="">
        <tbody id="item_template">
        <tr>
            <td>
                {!! \App\Core\Helpers\__form2::selectOnly('items[rand][oru_txn_type]',[
                    'options' => \App\Core\Helpers\Arrays::TXNType(),
                ]) !!}
            </td>
            <td>{!! \App\Core\Helpers\__form2::textboxOnly('items[rand][oru_sp_no]',[
                        'label' => 'S.P. No.:',
                        'type' => 'number',
                     ]) !!}
            </td>
            <td>{!! \App\Core\Helpers\__form2::textboxOnly('items[rand][oru_volume]',[
                        'label' => 'Volume:',
                        'type' => 'number',
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

    <section class="content-header">
        <h1>Add Official Receipts - Shipping Permit</h1>
    </section>

    <section class="content">
        {{-- Table Grid --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title text-strong">Receipt Details</h3>
                <div class="pull-right">
                    <button type="button" class="btn btn-default" data-toggle="modal" onclick="window.location='{{ url("dashboard/official_reciepts") }}'" > Back</button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form autocomplete="off" id="form_add_official_reciepts" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-strong">O.R. Details</h4>
                                    </div>
                                    <div class="row">

                                        {!! \App\Core\Helpers\__form2::textbox('or_no',[
                                             'label' => 'O.R. No.:',
                                             'cols' => 6,
                                             'type' => 'number',
                                             'class' => 'autonum_init',
                                        ]) !!}
                                        {!! \App\Core\Helpers\__form2::textbox('or_date',[
                                            'label' => 'O.R. Date:',
                                            'type' => 'date',
                                            'cols' => 6,
                                        ]) !!}
                                    </div>
                                    <div class="row">

                                        {!! \App\Core\Helpers\__form2::select('or_mill',[
                                            'label' => 'Mill:',
                                            'cols' => 6,
                                            'options' => \App\Core\Helpers\Arrays::millarray(),
                                        ]) !!}
                                        {!! \App\Core\Helpers\__form2::select('or_sugar_class',[
                                            'label' => 'Sugar Class:',
                                            'cols' => 6,
                                            'options' => \App\Core\Helpers\Arrays::SugarClass(),
                                        ]) !!}
                                    </div>
                                    <div class="row">

                                        {!! \App\Core\Helpers\__form2::select('or_payor',[
                                            'label' => 'Payor:',
                                            'cols' => 8,
                                            'options' => \App\Core\Helpers\Arrays::orPayor(),
                                        ]) !!}
                                        {!! \App\Core\Helpers\__form2::select('or_crop_year',[
                                            'label' => 'Crop Year:',
                                            'options' => \App\Core\Helpers\Arrays::cropYear(),
                                            'cols' => 4,
                                        ]) !!}
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
                                                        <button id="add_row_item" type="button" class="btn btn-xs btn-success pull-right">Add Item &nbsp;<i class="fa fw fa-plus"></i></button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="panel-body">
                                                <table class="table table-bordered" id="utilization_table">

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
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="modal-header">
                                            <h4 class="modal-title text-strong">Payment Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <div class="row">

                                                    {!! \App\Core\Helpers\__form2::textbox('or_drawee_bank',[
                                                        'label' => 'Drawee Bank:',

                                                        'cols' => 6,
                                                    ]) !!}
                                                    {!! \App\Core\Helpers\__form2::textbox('or_cash_amount',[
                                                        'label' => 'Cash Amount:',
                                                        'class' => 'autonum',
                                                        'cols' => 6,
                                                    ]) !!}
                                                </div>
                                                <div class="row">

                                                    {!! \App\Core\Helpers\__form2::textbox('or_chk_acct_no',[
                                                        'label' => 'Chk. Acct No.:',
                                                        'type' => 'number',
                                                        'cols' => 6,
                                                    ]) !!}
                                                    {!! \App\Core\Helpers\__form2::textbox('or_check_amount',[
                                                        'label' => 'Check Amount:',
                                                        'class' => 'autonum',
                                                        'cols' => 6,
                                                    ]) !!}


                                                </div>
                                                <div class="row">
                                                    {!! \App\Core\Helpers\__form2::textbox('or_chk_no',[
                                                        'label' => 'Check No.:',
                                                        'type' => 'number',
                                                        'cols' => 6,
                                                    ]) !!}
                                                    {!! \App\Core\Helpers\__form2::textbox('or_money_order',[
                                                        'label' => 'Money Order:',
                                                        'class' => 'autonum',
                                                        'cols' => 6,
                                                    ]) !!}

                                                </div>
                                                <div class="row">
                                                    {!! \App\Core\Helpers\__form2::textbox('or_chk_date',[
                                                        'label' => 'Check Date:',
                                                        'type' => 'date',
                                                        'cols' => 6,
                                                    ]) !!}
                                                    {!! \App\Core\Helpers\__form2::textbox('or_total_paid',[
                                                        'label' => 'Total Paid:',
                                                         'class' => 'autonum',
                                                        'readonly' => 'readonly',
                                                        'cols' => 6,
                                                    ]) !!}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="modal-header">
                                            <h4 class="modal-title text-strong">Nature of Payment</h4>
                                        </div>

                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <div class="row">

                                                    {!! \App\Core\Helpers\__form2::textbox('or_cancellation',[
                                                        'label' => 'Cancellation:',
                                                        'cols' => 6,
                                                    ]) !!}
                                                    {!! \App\Core\Helpers\__form2::textbox('or_shut_out',[
                                                        'label' => 'Shut-out:',
                                                        'cols' => 6,
                                                    ]) !!}
                                                    {!! \App\Core\Helpers\__form2::textbox('or_transhipment',[
                                                        'label' => 'Transhipment:',
                                                        'cols' => 6,
                                                    ]) !!}
                                                    {!! \App\Core\Helpers\__form2::textbox('or_shipping_permit',[
                                                        'label' => 'Shipping Permit:',
                                                        'cols' => 6,
                                                    ]) !!}
                                                    {!! \App\Core\Helpers\__form2::textbox('or_other_fees',[
                                                        'label' => 'Other Fees:',
                                                        'cols' => 6,
                                                    ]) !!}
                                                    {!! \App\Core\Helpers\__form2::textbox('or_other_fees_2',[
                                                        'label' => 'Other Fees:',
                                                        'cols' => 6,
                                                    ]) !!}
                                                </div>
                                                <div class="row">
                                                    {!! \App\Core\Helpers\__form2::textbox('or_total_amount',[
                                                        'label' => 'Total Amount:',
                                                        'cols' => 12,
                                                        'readonly' => 'readonly'
                                                    ]) !!}
                                                    {!! \App\Core\Helpers\__form2::textbox('or_report_no',[
                                                        'label' => 'Report No.:',
                                                        'cols' => 12,
                                                    ]) !!}
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

            </div>
            <!-- /.box-body -->
        </div>


</div>

@endsection

@section('scripts')
    <script type="text/javascript">

        $(document).ready(function(){
            active = '';


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
                    } else if (result.isDenied) {
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
                                var slug = response.slug;
                                printOfficialReceipt(slug);
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
                    }
                });

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


        })



    </script>

@endsection