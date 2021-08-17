@extends('layouts.admin-master')
@section('content')
    <section class="content-header">
        <h1>Project Listing</h1>
    </section>
    <section class="content">
        {{-- Table Grid --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Projects</h3>
                <div class="pull-right">
                    <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" data-toggle="modal" data-target="#add_project_modal"><i class="fa fa-plus"></i> Add Project</button>
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
                <div id="advanced_filters" class="panel-collapse collapse" aria-expanded="true">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-1 col-sm-2 col-lg-2">
                                <label>Sex:</label>
                                <select name="projects_table_length" aria-controls="projects_table" class="form-control input-sm filter_sex filters">
                                    <option value="">All</option>
                                    <option value="MALE">Male</option>
                                    <option value="FEMALE">Female</option>
                                </select>
                            </div>
                            <div class="col-md-1 col-sm-2 col-lg-2">
                                <label>Scholarship:</label>
                                <select name="projects_table_length" aria-controls="projects_table" class="form-control input-sm filter_scholarship filters">
                                    <option value="">All</option>
                                    <option value="TESDA">TESDA</option>
                                    <option value="CHED">CHED</option>
                                    <option value="SRA">SRA</option>
                                </select>
                            </div>
                            {{-- @php
                            print('<pre>'.print_r($mill_districts,true).'</pre>')
                            @endphp --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div id="projects_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="projects_table" style="width: 100% !important">
                        <thead>
                            <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                                <th>Project Code</th>
                                <th>Year</th>
                                <th>Activity</th>
                                <th>Budget Allocated</th>
                                <th>Balance</th>
                                <th>%</th>
                                <th class="action">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>


                <div id="tbl_loader">
                    <center>
                        <img style="width: 100px"
                             src="{!! __static::loader(Auth::user()->color) !!}">
                    </center>
                </div>
            </div>
            <!-- /.box-body -->
        </div>

        </div>
    </section>

@endsection


@section('modals')
    <div class="modal fade" id="add_project_modal" tabindex="-1" role="dialog" aria-labelledby="add_project_modalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="add_project_form">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="add_project_modalLabel">Add new project</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {!! __form::textbox(
                              '4 project_code', 'project_code', 'text', 'Project Code *', 'Project Code', '', '', '', ''
                            ) !!}

                            {!! __form::textbox(
                              '5 budget', 'budget', 'text', 'GAD Budget *', 'GAD Budget', '', '', '', '','autonum'
                            ) !!}

                            {!! __form::select_year('3','Year','year','','','') !!}


                            {!! __form::textbox(
                              '12 activity', 'activity', 'text', 'GAD Activity *', 'GAD Activity', '', '', '', ''
                            ) !!}
                        </div>
                        <p class="page-header-sm text-info">
                            Project Details
                        </p>

                        <div class="row">
                            {!! __form::textbox(
                              '6 issue_mandate', 'issue_mandate', 'text', 'Gender Issue/GAD Mandate', 'Gender Issue/GAD Mandate', '', '', '', ''
                            ) !!}

                            {!! __form::textbox(
                              '6 cause', 'cause', 'text', 'Cause of Gender Issue', 'Cause of Gender Issue', '', '', '', ''
                            ) !!}

                            {!! __form::textbox(
                              '6 result_statement', 'result_statement', 'text', 'GAD Result Statement/GAD Objective', 'GAD Result Statement/GAD Objective', '', '', '', ''
                            ) !!}

                            {!! __form::textbox(
                              '6 relevant_org', 'relevant_org', 'text', 'Relevant Oraganization MFO/PAP or PPA', 'Relevant Oraganization MFO/PAP or PPA', '', '', '', ''
                            ) !!}

                            {!! __form::textbox(
                              '6 performance_indicators', 'performance_indicators', 'text', 'Performance Indicators/Targets', 'Performance Indicators/Targets', '', '', '', ''
                            ) !!}

                            {!! __form::textbox(
                              '6 source_budget', 'source_budget', 'text', 'Source of Budget', 'Source of Budget', '', '', '', ''
                            ) !!}

                            {!! __form::textbox(
                              '6 responsible', 'responsible', 'text', 'Responsible Unit/Office', 'Responsible Unit/Office', '', '', '', ''
                            ) !!}
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {!! __html::blank_modal('show_project_modal',80) !!}
    {!! __html::blank_modal('edit_project_modal','') !!}

@endsection


@section('scripts')
    <script type="text/javascript">
        function dt_draw(){
            projects_tbl.draw();
        }

        function filter_dt(){
            sex = $(".filter_sex").val();
            scholarship_type = $(".filter_scholarship").val();
            mill_district = $(".filter_mill_district").val();
            course = $(".filter_course").val();
            projects_tbl.ajax.url(
                "{{ route('dashboard.scholars.index') }}?sex="+sex+"&scholarship_type="+scholarship_type+"&mill_district="+mill_district+"&course="+course).load();

            $(".filters").each(function(index, el) {
                if($(this).val() != ''){
                    $(this).parent("div").addClass('has-success');
                    $(this).siblings('label').addClass('text-green');
                }else{
                    $(this).parent("div").removeClass('has-success');
                    $(this).siblings('label').removeClass('text-green');
                }
            });
        }


    </script>
    <script type="text/javascript">
        {!! __js::modal_loader() !!}
            active = '';



        //-----DATATABLES-----//
        //Initialize DataTable
        projects_tbl = $("#projects_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : {
                url : '{{ route("dashboard.projects.index") }}',
                type: 'GET',
            },
            "columns": [
                { "data": "project_code" },
                { "data": "year" },
                { "data": "activity" },
                { "data": "budget" },
                { "data": "balance" },
                { "data": "percentage" },
                { "data": "action" }
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columnDefs":[

                {
                    "targets" : 4,
                    "orderable" : false,
                },
                {
                    "targets" : [3,4,5],
                    "class" : 'text-right',
                },
                {
                    "targets" : 6,
                    "orderable" : false,
                    "class" : 'action'
                },

            ],
            "responsive": false,
            "initComplete": function( settings, json ) {
                $('#tbl_loader').fadeOut(function(){
                    $("#projects_table_container").fadeIn();
                    // projects_tbl.search(search_for).draw();
                    // active = search_for;
                    // setTimeout(function(){
                    //     active = '';
                    // },3000);
                });
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{!! __static::loader(Auth::user()->color) !!}'></center>",
                },
            "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active != ''){
                    $("#projects_table #"+active).addClass('success');
                }

                $("tr[is_excess='1']").each(function(i,item){
                    $(this).children('td').eq(4).addClass('danger');
                })

            },
            'rowGroup': {
                'dataSrc': 'year'
            },
            "order": [[ 1, "asc" ], [0, 'asc']]
        })




        style_datatable("#projects_table");


        //Search Bar Styling
        $('#projects_table_filter input').css("width","300px");
        $("#projects_table_filter input").attr("placeholder","Press enter to search");

        //Need to press enter to search
        $('#projects_table_filter input').unbind();
        $('#projects_table_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                projects_tbl.search(this.value).draw();
            }
        });


        $("body").on("change",".filters",function(){
            filter_dt();
        })

        $("#add_project_form").submit(function (e) {
            e.preventDefault();
            form = $(this);
            loading_btn(form);
            $.ajax({
                url : "{{ route('dashboard.projects.store') }}",
                data : $(this).serialize(),
                type: 'POST',
                success: function (response) {
                    notify("Scholar has been added successfully","success");
                    active = response.slug;
                    projects_tbl.draw(false);
                    succeed(form, true ,false);
                },
                error: function (response) {
                    console.log(response);
                    errored(form,response);
                }
            })
        })



        $("body").on("click",".show_project_btn",function(){
            btn = $(this);
            var id = btn.attr('data');
            load_modal2(btn);
            uri = "{{ route('dashboard.projects.show','slug') }}";
            uri = uri.replace('slug',id);
            $.ajax({
                url :  uri,
                type: 'GET',
                success: function(response){

                    populate_modal2(btn,response);
                },
                errors: function(response){
                    console.log(response);
                }
            })
        });

        $("body").on("click",".edit_project_btn", function(){
            btn = $(this);
            id = $(this).attr('data');
            load_modal2(btn);

            uri = " {{ route('dashboard.projects.edit', 'slug') }} ";
            uri = uri.replace('slug',id);

            $.ajax({
                url : uri,
                type: 'GET',
                success: function(response){
                    populate_modal2(btn,response);
                },
                error: function(response){
                    console.log(response);
                }
            })

        });

        $("body").on("submit","#edit_project_form", function(e){
            e.preventDefault();
            form = $(this);
            id = $(this).attr('data');
            loading_btn(form);
            uri = "{{ route('dashboard.projects.update','slug') }}";
            uri = uri.replace('slug',id);

            $.ajax({
                url: uri,
                data: $(this).serialize(),
                type: 'PUT',
                dataType: 'json',
                success: function(response){
                    succeed(form,true,true);
                    notify("Project successfully updated",'success');
                    active = response.slug
                    projects_tbl.draw(false);
                },
                error: function(response){
                    errored(form,response);
                }

            })
        })


        $("body").on("click",".delete_scholars_btn", function(){
            id = $(this).attr('data');
            confirm("{{ route('dashboard.scholars.destroy', 'slug') }}", id);
        })


    </script>
@endsection