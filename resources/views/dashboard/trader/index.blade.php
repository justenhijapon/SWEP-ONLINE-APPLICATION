@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Manage traders</h1>
    </section>
    {{-- Item Modal --}}
    <table hidden="">
        <tbody id="item_template">
        <tr>
            <td>
                {!! \App\Core\Helpers\__form2::textboxOnly('items[rand][tc_marking]',[
                    'label' => 'Marking Code:',
                ]) !!}
            </td>
            <td>{!! \App\Core\Helpers\__form2::textboxOnly('items[rand][tc_address]',[
                    'label' => 'Address:',
                 ]) !!}
            </td>
            <td><button type="button" class="btn btn-sm bg-red delete_row_item"><i class="fa fa-times"></i></button></td>
        </tr>
        </tbody>
    </table>
    <section class="content">
        {{-- Table Grid --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Traders</h3>
                <div class="pull-right">
                    <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" data-toggle="modal" data-target="#add_trader_modal"><i class="fa fa-plus"></i> New trader</button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="trader_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="trader_table" style="width: 100% !important">
                        <thead>
                        <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                            <th>SLUG</th>
                            <th>Trader ID</th>
                            <th>Trader Name</th>
                            <th>Business Address</th>
                            <th>TIN</th>
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
    {!! __html::modal_delete('trader_delete') !!}
    <!-- Add trader Modal -->
    <div class="modal fade" id="add_trader_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">New trader</h4>
                </div>
                <form autocomplete="off" id="form_add_trader" enctype="multipart/form-data">
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
{{--                                {!! \App\Core\Helpers\__form2::textbox('trader_id',[--}}
{{--                                    'label' => 'Trader ID:',--}}
{{--                                    'cols' => 6,--}}
{{--                                    'type' => 'number',--}}
{{--                                ]) !!}--}}
                                {!! \App\Core\Helpers\__form2::textbox('trader_name',[
                                    'label' => 'Name:',
                                    'cols' => 12,
                                ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('trader_address',[
                                    'label' => 'Business Address:',
                                    'cols' => 12,
                                ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('trader_tin',[
                                    'label' => 'TIN:',
                                    'cols' => 12,
//                                    'type' => 'number',
                                ]) !!}

                            </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="no-margin">
                                                            <b>Add Cluster trader</b>
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
                                                        <th style="width: 30%">Markings Code</th>
                                                        <th style="width: 60%">Cluster Address</th>
                                                        <th style="width: 10%"></th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    </tbody>
                                                </table>
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

                </form>
            </div>
        </div>
    </div>

    {!! __html::modal_delete('trader_delete') !!}

    <!-- Edit modal -->
    <div class="modal fade" id="edit_trader_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div id="edit_trader_modal_loader">
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

        $(document).ready(function(){
            active = '';
            edit_loader = $("#edit_trader_modal .modal-content").html();

            $('#trader_table')
                .on('preXhr.dt', function ( e, settings, data ) {
                    Pace.restart();
                } )

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


            //-----DATATABLES-----//
            //Initialize DataTable
            trader_table = $("#trader_table").DataTable({
                'dom' : 'lBfrtip',
                "processing": true,
                "serverSide": true,
                "ajax" : {
                    url : '{{ route("dashboard.trader.index") }}',
                    type: 'GET',
                },
                "columns": [
                    {"data": "slug"},
                    {"data": "trader_id"},
                    {"data": "trader_name"},
                    {"data": "trader_address"},
                    {"data": "trader_tin"},
                    {"data": "action"}

                ],

                buttons: [
                    {!! __js::dt_buttons() !!}
                ],
                "columnDefs":[
                    {
                        "targets" : [ 0 ],
                        "visible" : false
                    },
                    {
                        "targets" : 5,
                        "orderable" : false,
                        "class" : 'action-10p'
                    },
                ],
                "responsive": false,
                "initComplete": function( settings, json ) {
                    $('#tbl_loader').fadeOut(function(){
                        $("#trader_table_container").fadeIn();
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
                        $("#trader_table #"+active).addClass('success');
                    }
                }
            })

            //Search Bar Styling
            style_datatable('#trader_table');

            //Need to press enter to search
            $('#trader_table_filter input').unbind();
            $('#trader_table_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    trader_table.search(this.value).draw();
                }
            });





        })

        //-----trader-----//
        //Submit Add trader Form
        $("#form_add_trader").submit(function(e){
            e.preventDefault();
            form = $(this);
            loading_btn(form);
            formData = new FormData(this);
            Pace.restart();
            $.ajax({
                url: "{{ route('dashboard.trader.store') }}",
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

                    trader_table.draw(false);
                    active = response.slug;

                    succeed(form,true,false);
                    $("#form_add_trader input[name='trader_name']").focus();
                    $("#table_body").html('');
                },
                error: function(response){
                    errored(form,response);
                }
            })
        })

        //Edit trader button
        $("body").on("click", ".edit_trader_btn", function(){
            $("#edit_trader_modal .modal-content").html(edit_loader);
            id = $(this).attr('data');
            uri = "{{ route('dashboard.trader.edit', 'slug') }}";
            uri = uri.replace('slug',id);
            Pace.restart();
            $.ajax({
                url : uri ,
                type : 'GET',
                success: function(response){

                    $("#edit_trader_modal_loader").fadeOut(function(){
                        $("#edit_trader_modal .modal-content").html(response);

                    })
                },error: function(response){
                    notify("Error: "+JSON.stringify(response), 'danger');
                }
            })
        })



    </script>

@endsection

