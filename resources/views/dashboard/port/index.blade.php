@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Manage Ports</h1>
    </section>


    <section class="content">
        {{-- Table Grid --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Ports</h3>
                <div class="pull-right">
                    <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" data-toggle="modal" data-target="#add_port_modal"><i class="fa fa-plus"></i> New Port</button>
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
                                    <option value="Luzon/Mindanao">Luzon/Mindanao</option>
                                    <option value="Visayas">Visayas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div id="port_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="port_table" style="width: 100% !important">
                        <thead>
                        <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                            <th>SLUG</th>
                            <th>Origin</th>
                            <th>Port Name</th>
                            <th>Ship</th>
                            <th>Vessel</th>
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
    {!! __html::modal_delete('port_delete') !!}
    <!-- Add port Modal -->
    <div class="modal fade" id="add_port_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">New Port</h4>
                </div>
                <form autocomplete="off" id="form_add_port" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">

                                {!! \App\Core\Helpers\__form2::select('category',[
                                    'label' => 'Origin:',
                                    'options' => ['Luzon/Mindanao' => 'Luzon/Mindanao','Visayas' =>'Visayas' ],

                                    'cols' => 12,
                                ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('port_name',[
                                    'label' => 'Port Name:',
                                    'cols' => 12,
                                ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('ship',[
                                    'label' => 'Ship Name:',
                                    'cols' => 12,
                                ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('vessel',[
                                    'label' => 'Vessel Name:',
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
    
    {!! __html::modal_delete('port_delete') !!}
    
    <!-- Edit modal -->
    <div class="modal fade" id="edit_port_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div id="edit_port_modal_loader">
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
            port_table.columns(1).search(category).draw();
        });
    </script>

    <script type="text/javascript">

        $(document).ready(function(){
            active = '';
            edit_loader = $("#edit_port_modal .modal-content").html();

            $('#port_table')
                .on('preXhr.dt', function ( e, settings, data ) {
                    Pace.restart();
                } )


            //-----DATATABLES-----//
            //Initialize DataTable
            port_table = $("#port_table").DataTable({
                'dom' : 'lBfrtip',
                "processing": true,
                "serverSide": true,
                "ajax" : {
                    url : '{{ route("dashboard.port.index") }}',
                    type: 'GET',
                },
                "columns": [
                    {"data": "slug"},
                    {"data": "category"},
                    {"data": "port_name"},
                    {"data": "ship"},
                    {"data": "vessel"},
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
                        $("#port_table_container").fadeIn();
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
                        $("#port_table #"+active).addClass('success');
                    }
                }
            })

            //Search Bar Styling
            style_datatable('#port_table');

            //Need to press enter to search
            $('#port_table_filter input').unbind();
            $('#port_table_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    port_table.search(this.value).draw();
                }
            });

        })

        //-----port-----//
        //Submit Add port Form
        $("#form_add_port").submit(function(e){
            e.preventDefault();
            form = $(this);
            loading_btn(form);
            formData = new FormData(this);
            Pace.restart();
            $.ajax({
                url: "{{ route('dashboard.port.store') }}",
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

                    port_table.draw(false);
                    active = response.slug;

                    succeed(form,true,false);
                    $("#form_add_port input[name='port_name']").focus();
                    $("#table_body").html('');
                },
                error: function(response){
                    errored(form,response);
                }
            })
        })

        //Edit port button
        $("body").on("click", ".edit_port_btn", function(){
            $("#edit_port_modal .modal-content").html(edit_loader);
            id = $(this).attr('data');
            uri = "{{ route('dashboard.port.edit', 'slug') }}";
            uri = uri.replace('slug',id);
            Pace.restart();
            $.ajax({
                url : uri ,
                type : 'GET',
                success: function(response){

                    $("#edit_port_modal_loader").fadeOut(function(){
                        $("#edit_port_modal .modal-content").html(response);
                        
                    })
                },error: function(response){
                    notify("Error: "+JSON.stringify(response), 'danger');
                }
            })
        })



    </script>

@endsection

