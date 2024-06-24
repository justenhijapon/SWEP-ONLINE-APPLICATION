@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Manage Origins</h1>
    </section>

    <section class="content">
        {{-- Table Grid --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Origins</h3>
                <div class="pull-right">
                    <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" data-toggle="modal" data-target="#add_origin_modal"><i class="fa fa-plus"></i> New origin</button>
                </div>
            </div>
            <div class="panel">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#advanced_filters" aria-expanded="true" class="">
                            <i class="fa fa-filter"></i>  Advanced Filters <i class=" fa  fa-angle-down"></i>
                        </a>
                    </h4>
                </div>
                <div id="advanced_filters" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-1 col-sm-2 col-lg-2">
                                <label>Origin:</label>
                                <select id="category_filter" class="form-control">
                                    <option value="">All</option>
                                    <option value="LOCAL">Local</option>
                                    <option value="IMPORTED">Imported</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="origin_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="origin_table" style="width: 100% !important">
                        <thead>
                        <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                            <th>SLUG</th>
                            <th>Descriptive Name</th>
                            <th>Address</th>
                            <th>Origin</th>
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
    {!! __html::modal_delete('origin_delete') !!}
    <!-- Add origin Modal -->
    <div class="modal fade" id="add_origin_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">New origin</h4>
                </div>
                <form autocomplete="off" id="form_add_origin" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">

                                {!! \App\Core\Helpers\__form2::select('origin',[
                                     'label' => 'Origin:',
                                     'options' => ['LOCAL' => 'LOCAL','IMPORTED' => 'IMPORTED'],

                                     'cols' => 12,
                                 ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('source',[
                                    'label' => 'City Name:',
                                    'cols' => 12,
                                ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('name',[
                                    'label' => 'Name:(IF IMPORTED, INDICATE CONTROL NO. & DATE OF SRA CLEARANCE)',
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

    {!! __html::modal_delete('origin_delete') !!}

    <!-- Edit modal -->
    <div class="modal fade" id="edit_origin_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div id="edit_origin_modal_loader">
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
        $('#category_filter').on('change', function () {
            var category = $(this).val();
            origin_table.columns(3).search(category).draw();
        });
    </script>
    <script type="text/javascript">

        $(document).ready(function(){
            active = '';
            edit_loader = $("#edit_origin_modal .modal-content").html();

            $('#origin_table')
                .on('preXhr.dt', function ( e, settings, data ) {
                    Pace.restart();
                } )


            //-----DATATABLES-----//
            //Initialize DataTable
            origin_table = $("#origin_table").DataTable({
                'dom' : 'lBfrtip',
                "processing": true,
                "serverSide": true,
                "ajax" : {
                    url : '{{ route("dashboard.origin.index") }}',
                    type: 'GET',
                },
                "columns": [
                    {"data": "slug"},
                    {"data": "name"},
                    {"data": "source"},
                    {"data": "origin"},
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
                        "targets" : 4,
                        "orderable" : false,
                        "class" : 'action-10p'
                    },
                ],
                "responsive": false,
                "initComplete": function( settings, json ) {
                    $('#tbl_loader').fadeOut(function(){
                        $("#origin_table_container").fadeIn();
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
                        $("#origin_table #"+active).addClass('success');
                    }
                }
            })

            //Search Bar Styling
            style_datatable('#origin_table');

            //Need to press enter to search
            $('#origin_table_filter input').unbind();
            $('#origin_table_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    origin_table.search(this.value).draw();
                }
            });



        })

        //-----origin-----//
        //Submit Add origin Form
        $("#form_add_origin").submit(function(e){
            e.preventDefault();
            form = $(this);
            loading_btn(form);
            formData = new FormData(this);
            Pace.restart();
            $.ajax({
                url: "{{ route('dashboard.origin.store') }}",
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

                    origin_table.draw(false);
                    active = response.slug;

                    succeed(form,true,false);
                    $("#form_add_origin input[name='origin_name']").focus();
                    $("#table_body").html('');
                },
                error: function(response){
                    errored(form,response);
                }
            })
        })

        //Edit origin button
        $("body").on("click", ".edit_origin_btn", function(){
            $("#edit_origin_modal .modal-content").html(edit_loader);
            id = $(this).attr('data');
            uri = "{{ route('dashboard.origin.edit', 'slug') }}";
            uri = uri.replace('slug',id);
            Pace.restart();
            $.ajax({
                url : uri ,
                type : 'GET',
                success: function(response){

                    $("#edit_origin_modal_loader").fadeOut(function(){
                        $("#edit_origin_modal .modal-content").html(response);

                    })
                },error: function(response){
                    notify("Error: "+JSON.stringify(response), 'danger');
                }
            })
        })



    </script>

@endsection

