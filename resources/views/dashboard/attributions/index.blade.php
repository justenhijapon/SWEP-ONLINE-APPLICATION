@extends('layouts.admin-master')
@section('content')
    <section class="content-header">
        <h1>Attributions</h1>
    </section>
    <section class="content">

        {{-- Table Grid --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Attributions Table</h3>
                <div class="pull-right">
                    <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" data-toggle="modal" data-target="#add_attributions_modal"><i class="fa fa-plus"></i> New GST</button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="attributions_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="attributions_table" style="width: 100% !important">
                        <thead>
                        <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                            <th>Slug</th>
                            <th>Activity</th>
                            <th>Date</th>
                            <th>Venue</th>
                            <th>Project Code</th>
                            <th>Item</th>
                            <th>Utilized Fund</th>
                            <th>Details</th>
                            <th class="">Action</th>
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

        </div>

    </section>

@endsection
@section('modals')
    {!! __html::modal_delete('attributions_delete') !!}
    <!-- Add attributions Modal -->
    <div class="modal fade" id="add_attributions_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">New attributions</h4>
                </div>
                <form autocomplete="off" id="form_add_attributions" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">

                                {!! \App\Core\Helpers\__form2::textbox('activity',[
                                    'label' => 'Activity:',
                                    'cols' => 9,
                                ]) !!}

                                {!! \App\Core\Helpers\__form2::textbox('date',[
                                'label' => 'Date:',
                                'cols' => 3,
                                'type' => 'date',
                                ]) !!}

                            </div>
                            <div class="row">

                                {!! \App\Core\Helpers\__form2::select('project_code',[
                                    'label' => 'Project Code:',
                                    'cols' => 3,
                                    'options' => \App\Core\Helpers\Arrays::projectCodes(),
                                    'id' => 'project_code',
                                ]) !!}

                                {!! \App\Core\Helpers\__form2::textbox('utilized_fund',[
                                    'label' => 'Utilized fund:',
                                    'cols' => 3,
                                    'class' => 'autonum',
                                ]) !!}

                                {!! \App\Core\Helpers\__form2::textbox('item',[
                                    'label' => 'Item:',
                                    'cols' => 3,
                                ]) !!}

                                {!! \App\Core\Helpers\__form2::textbox('venue',[
                                    'label' => 'Venue:',
                                    'cols' => 3,
                                ]) !!}

                            </div>
                            <div class="row">

                                {!! \App\Core\Helpers\__form2::textarea('details',[
                                    'label' => 'Details:',
                                    'cols' => 12,
                                    'rows' => 2,

                                ]) !!}
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="has_participants" value="1"> This activity involves participants
                                </label>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} submit_add_attributions"><i class="fa fa-save"></i> Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Edit modal -->
    <div class="modal fade" id="edit_attributions_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div id="edit_attributions_modal_loader">
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

        function dt_draw(){
            attributions_table.draw();
        }
    </script>

    <script type="text/javascript">

        $(document).ready(function(){
            active = '';
            edit_loader = $("#edit_attributions_modal .modal-content").html();



            $('#attributions_table')
                .on('preXhr.dt', function ( e, settings, data ) {
                    Pace.restart();
                } )


            //-----DATATABLES-----//
            //Initialize DataTable
            attributions_table = $("#attributions_table").DataTable({
                'dom' : 'lBfrtip',
                "processing": true,
                "serverSide": true,
                "ajax" : {
                    url : '{{ route("dashboard.attributions.index") }}',
                    type: 'GET',
                },
                "columns": [
                    {"data": "slug"},
                    {"data": "activity"},
                    {"data": "date"},
                    {"data": "venue"},
                    {"data": "project_code"},
                    {"data": "item"},
                    {"data": "utilized_fund"},
                    {"data": "details"},
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
                        "targets" : 8,
                        "orderable" : false,
                        "class" : 'action-10p'
                    },
                ],
                "responsive": false,
                "initComplete": function( settings, json ) {
                    $('#tbl_loader').fadeOut(function(){
                        $("#attributions_table_container").fadeIn();
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
                        $("#attributions_table #"+active).addClass('success');
                    }
                }
            })

            //Search Bar Styling
            style_datatable('#attributions_table');

            //Need to press enter to search
            $('#attributions_table_filter input').unbind();
            $('#attributions_table_filter input').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    attributions_table.search(this.value).draw();
                }
            });

            //-----attributions-----//
            //Submit Add attributions Form
            $("#form_add_attributions").submit(function(e){
                e.preventDefault();
                form = $(this);
                loading_btn(form);
                formData = new FormData(this);
                Pace.restart();
                $.ajax({
                    url: "{{ route('dashboard.attributions.store') }}",
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

                        attributions_table.draw(false);
                        active = response.slug;

                        succeed(form,true,false);
                        $("#form_add_attributions input[name='activity']").focus();
                        $("#table_body").html('');
                    },
                    error: function(response){
                        errored(form,response);
                    }
                })
            })



            //Edit attributions button
            $("body").on("click", ".edit_attributions_btn", function(){
                $("#edit_attributions_modal .modal-content").html(edit_loader);
                id = $(this).attr('data');
                uri = "{{ route('dashboard.attributions.edit', 'slug') }}";
                uri = uri.replace('slug',id);
                Pace.restart();
                $.ajax({
                    url : uri ,
                    type : 'GET',
                    success: function(response){

                        $("#edit_attributions_modal_loader").fadeOut(function(){
                            $("#edit_attributions_modal .modal-content").html(response);

                            //Initialize datepicker for Edit Modal
                            $('.datepicker').each(function(){
                                $(this).datepicker({
                                    autoclose: true,
                                    dateFormat: "mm/dd/yy",
                                    orientation: "bottom"
                                });
                            });

                            //Add row button from edit modal
                            $("#add_row_edit").click(function(){
                                append_speakers('#edit_attributions_form #table_body');
                                rows_add('#edit_attributions_form #table_body');
                            })

                            //delete row button from edit modal
                            $("body").on("click", ".delete_row_edit", function(){
                                $(this).parent('td').parent('tr').remove();
                                rows_add('#edit_attributions_form #table_body');
                            })



                        })
                    },error: function(response){
                        notify("Error: "+JSON.stringify(response), 'danger');
                    }
                })
            })



            //Show attributions button
            $("body").on("click", ".view_attributions_btn", function(){
                $("#view_attributions_modal .modal-content").html(edit_loader);
                id = $(this).attr("data");
                uri = '{{ route("dashboard.attributions.show", "slug") }}';
                uri = uri.replace('slug',id);
                Pace.restart();
                $.ajax({
                    url : uri,
                    type : 'GET',
                    success: function(response){
                        $("#view_attributions_modal #edit_attributions_modal_loader").fadeOut(function(){
                            $("#view_attributions_modal .modal-content").html(response);
                        })
                    }
                })
            })



        })

        //Edit attributions button
        $("body").on("click", ".edit_attributions_btn", function(){
            $("#edit_attributions_modal .modal-content").html(edit_loader);
            id = $(this).attr('data');
            uri = "{{ route('dashboard.attributions.edit', 'slug') }}";
            uri = uri.replace('slug',id);
            Pace.restart();
            $.ajax({
                url : uri ,
                type : 'GET',
                success: function(response){

                    $("#edit_attributions_modal_loader").fadeOut(function(){
                        $("#edit_attributions_modal .modal-content").html(response);

                        //Initialize datepicker for Edit Modal
                        $('.datepicker').each(function(){
                            $(this).datepicker({
                                autoclose: true,
                                dateFormat: "mm/dd/yy",
                                orientation: "bottom"
                            });
                        });

                        //Add row button from edit modal
                        $("#add_row_edit").click(function(){
                            append_speakers('#edit_attributions_form #table_body');
                            rows_add('#edit_attributions_form #table_body');
                        })

                        //delete row button from edit modal
                        $("body").on("click", ".delete_row_edit", function(){
                            $(this).parent('td').parent('tr').remove();
                            rows_add('#edit_attributions_form #table_body');
                        })



                    })
                },error: function(response){
                    notify("Error: "+JSON.stringify(response), 'danger');
                }
            })
        })

    </script>

@endsection








