@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Manage vessels</h1>
    </section>

    <section class="content">
        {{-- Table Grid --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Vessels</h3>
                <div class="pull-right">
                    <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" data-toggle="modal" data-target="#add_vessel_modal"><i class="fa fa-plus"></i> New Vessel</button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="vessel_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="vessel_table" style="width: 100% !important">
                        <thead>
                        <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                            <th>SLUG</th>
                            <th>Vessel</th>
                            <th>Ship Operator</th>
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
    {!! __html::modal_delete('vessel_delete') !!}
    <!-- Add vessel Modal -->
    <div class="modal fade" id="add_vessel_modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">New Vessel</h4>
                </div>
                <form autocomplete="off" id="form_add_vessel" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
{{--                                ADD VESSEL MODAL LOUIS--}}

{{--                                {!! \App\Core\Helpers\__form2::textbox('vessel_id',[--}}
{{--                                    'label' => 'Vessel:',--}}
{{--                                    'cols' => 6,--}}
{{--                                    'type' => 'number'--}}
{{--                                ]) !!}--}}
                                {!! \App\Core\Helpers\__form2::textbox('vessel_description',[
                                    'label' => 'Vessel:',
                                    'cols' => 12,
                                ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('vessel_ship_operator',[
                                    'label' => 'Ship Operator:',
                                    'cols' => 12,
                                ]) !!}
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

    {!! __html::modal_delete('vessel_delete') !!}

    <!-- Edit modal -->
    <div class="modal fade" id="edit_vessel_modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div id="edit_vessel_modal_loader">
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
            edit_loader = $("#edit_vessel_modal .modal-content").html();

            $('#vessel_table')
                .on('preXhr.dt', function ( e, settings, data ) {
                    Pace.restart();
                } )


            //-----DATATABLES-----//
            //Initialize DataTable
            vessel_table = $("#vessel_table").DataTable({
                'dom' : 'lBfrtip',
                "processing": true,
                "serverSide": true,
                "ajax" : {
                    url : '{{ route("dashboard.vessel.index") }}',
                    type: 'GET',
                },
                "columns": [
                    {"data": "slug"},
                    {"data": "vessel_description"},
                    {"data": "vessel_ship_operator"},
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
                        "targets" : 3,
                        "orderable" : false,
                        "class" : 'action-10p'
                    },
                ],
                "responsive": false,
                "initComplete": function( settings, json ) {
                    $('#tbl_loader').fadeOut(function(){
                        $("#vessel_table_container").fadeIn();
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
                        $("#vessel_table #"+active).addClass('success');
                    }
                }
            })

            //Search Bar Styling
            style_datatable('#vessel_table');

            //Need to press enter to search
            $('#vessel_table_filter input').unbind();
            $('#vessel_table_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    vessel_table.search(this.value).draw();
                }
            });



        })

        //-----vessel-----//
        //Submit Add vessel Form
        $("#form_add_vessel").submit(function(e){
            e.preventDefault();
            form = $(this);
            loading_btn(form);
            formData = new FormData(this);
            Pace.restart();
            $.ajax({
                url: "{{ route('dashboard.vessel.store') }}",
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

                    vessel_table.draw(false);
                    active = response.slug;

                    succeed(form,true,false);
                    $("#form_add_vessel input[name='vessel_name']").focus();
                    $("#table_body").html('');
                },
                error: function(response){
                    errored(form,response);
                }
            })
        })

        //Edit vessel button
        $("body").on("click", ".edit_vessel_btn", function(){
            $("#edit_vessel_modal .modal-content").html(edit_loader);
            id = $(this).attr('data');
            uri = "{{ route('dashboard.vessel.edit', 'slug') }}";
            uri = uri.replace('slug',id);
            Pace.restart();
            $.ajax({
                url : uri ,
                type : 'GET',
                success: function(response){

                    $("#edit_vessel_modal_loader").fadeOut(function(){
                        $("#edit_vessel_modal .modal-content").html(response);

                    })
                },error: function(response){
                    notify("Error: "+JSON.stringify(response), 'danger');
                }
            })
        })



    </script>

@endsection

