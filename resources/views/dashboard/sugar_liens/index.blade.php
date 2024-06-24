@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Manage Sugar Liens Factor</h1>
    </section>

    <section class="content">
        {{-- Table Grid --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Sugar Liens Factor</h3>
                <div class="pull-right">
                    <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" data-toggle="modal" data-target="#add_sugar_liens_modal"><i class="fa fa-plus"></i> New sugar_liens</button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="sugar_liens_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="sugar_liens_table" style="width: 100% !important">
                        <thead>
                        <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                            <th>SLUG</th>
                            <th>Description</th>
                            <th>Factor</th>
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
    {!! __html::modal_delete('sugar_liens_delete') !!}
    <!-- Add sugar_liens Modal -->
    <div class="modal fade" id="add_sugar_liens_modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add</h4>
                </div>
                <form autocomplete="off" id="form_add_sugar_liens" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                {!! \App\Core\Helpers\__form2::textbox('sl_description',[
                                    'label' => 'Description:',
                                    'cols' => 12,
                                ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('sl_factor',[
                                    'label' => 'Factor:',
                                    'cols' => 12,
                                    'type' => 'number'
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

    {!! __html::modal_delete('sugar_liens_delete') !!}

    <!-- Edit modal -->
    <div class="modal fade" id="edit_sugar_liens_modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div id="edit_sugar_liens_modal_loader">
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
            edit_loader = $("#edit_sugar_liens_modal .modal-content").html();

            $('#sugar_liens_table')
                .on('preXhr.dt', function ( e, settings, data ) {
                    Pace.restart();
                } )


            //-----DATATABLES-----//
            //Initialize DataTable
            sugar_liens_table = $("#sugar_liens_table").DataTable({
                'dom' : 'lBfrtip',
                "processing": true,
                "serverSide": true,
                "ajax" : {
                    url : '{{ route("dashboard.sugar_liens.index") }}',
                    type: 'GET',
                },
                "columns": [
                    {"data": "slug"},
                    {"data": "sl_description"},
                    {"data": "sl_factor"},
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
                        $("#sugar_liens_table_container").fadeIn();
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
                        $("#sugar_liens_table #"+active).addClass('success');
                    }
                }
            })

            //Search Bar Styling
            style_datatable('#sugar_liens_table');

            //Need to press enter to search
            $('#sugar_liens_table_filter input').unbind();
            $('#sugar_liens_table_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    sugar_liens_table.search(this.value).draw();
                }
            });



        })

        //-----sugar_liens-----//
        //Submit Add sugar_liens Form
        $("#form_add_sugar_liens").submit(function(e){
            e.preventDefault();
            form = $(this);
            loading_btn(form);
            formData = new FormData(this);
            Pace.restart();
            $.ajax({
                url: "{{ route('dashboard.sugar_liens.store') }}",
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

                    sugar_liens_table.draw(false);
                    active = response.slug;

                    succeed(form,true,false);
                    $("#form_add_sugar_liens input[name='sugar_liens_name']").focus();
                    $("#table_body").html('');
                },
                error: function(response){
                    errored(form,response);
                }
            })
        })

        //Edit sugar_liens button
        $("body").on("click", ".edit_sugar_liens_btn", function(){
            $("#edit_sugar_liens_modal .modal-content").html(edit_loader);
            id = $(this).attr('data');
            uri = "{{ route('dashboard.sugar_liens.edit', 'slug') }}";
            uri = uri.replace('slug',id);
            Pace.restart();
            $.ajax({
                url : uri ,
                type : 'GET',
                success: function(response){

                    $("#edit_sugar_liens_modal_loader").fadeOut(function(){
                        $("#edit_sugar_liens_modal .modal-content").html(response);

                    })
                },error: function(response){
                    notify("Error: "+JSON.stringify(response), 'danger');
                }
            })
        })



    </script>

@endsection

