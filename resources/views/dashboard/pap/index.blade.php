@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>GAD PAP Codes</h1>
    </section>
@endsection
@section('content2')

    <section class="content">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">PAP Codes</h3>
            </div>
            <div class="box-body">
                <table id="pap_table" class="table table-striped table-condensed table-bordered" style="width: 100%">
                    <thead>
                    <tr>
                        <th>PAP Code</th>
                        <th>Description</th>
                        <th>MOOE</th>
                        <th>CO</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>

@endsection


@section('modals')

@endsection

@section('scripts')
    <script type="text/javascript">
        active = '';
        pap_tbl = $("#pap_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{\Illuminate\Support\Facades\Request::getUri()}}',
            "columns": [
                { "data": "pap_code" },
                { "data": "pap_title" },
                { "data": "mooe" },
                { "data": "co" },
                { "data": "action" },
            ],
            "buttons": [

            ],
            "columnDefs":[
                {
                    targets : 4,
                    orderable : false,
                    searchable: false,
                    class : 'action4'
                },
                {
                    targets : [2,3],
                    class : 'text-right w-10p',
                    render: $.fn.dataTable.render.number(',', '.', 3, ''),
                },
                {
                    targets : 0,
                    class : 'w-8p',
                },

            ],
            "responsive": true,
            "initComplete": function( settings, json ) {
                // console.log(settings);
                setTimeout(function () {
                    $("#filter_form select[name='is_active']").val('ACTIVE');
                    $("#filter_form select[name='is_active']").trigger('change');
                },100);

                setTimeout(function () {
                    // $('a[href="#advanced_filters"]').trigger('click');
                    $('.advanced_filters_toggler').trigger('click');
                },1000);

                $('#tbl_loader').fadeOut(function(){
                    $("#pap_table_container").fadeIn();
                    if(find != ''){
                        pap_tbl.search(find).draw();
                        setTimeout(function(){
                            active = '';
                        },3000);
                        window.history.pushState({}, document.title, "/dashboard/employee");
                    }
                });
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='http://hrrs.sra.gov.ph/images/loader.gif'></center>",
                },
            "drawCallback": function(settings){
                // console.log(pap_tbl.page.info().page);
                $("#pap_table a[for='linkToEdit']").each(function () {
                    let orig_uri = $(this).attr('href');
                    $(this).attr('href',orig_uri+'?page='+pap_tbl.page.info().page);
                });

                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active != ''){
                    $("#pap_table #"+active).addClass('success');
                }
            }
        })

        style_datatable("#pap_table");

        //Need to press enter to search
        $('#pap_table_filter input').unbind();
        $('#pap_table_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                pap_tbl.search(this.value).draw();
            }
        });
    </script>
@endsection