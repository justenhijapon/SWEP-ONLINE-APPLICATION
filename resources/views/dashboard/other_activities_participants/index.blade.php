@php($rand = \Illuminate\Support\Str::random(10))
@extends('layouts.modal-content')

@section('title')
    {{$oa->activity}}
@endsection

@section('body')
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary pull-right btn-sm" style="margin-bottom: 5px" data-toggle="modal" data-target="#add_participant_modal"><i class="fa fa-plus"></i> Add</button>

        </div>
    </div>

    <div id="oa_participants_table_container" style="display: none">
        <table class="table table-bordered table-striped table-hover" id="oa_participants_table" style="width: 100% !important">
            <thead>
            <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                <th>Fullname</th>
                <th>Sex</th>
                <th>Age</th>
                <th>Group</th>
                <th class="">Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>


    <div id="tbl_loader_{{$rand}}">
        <center>
            <img style="width: 100px"
                 src="{!! __static::loader(Auth::user()->color) !!}">
        </center>
    </div>
@endsection

@section('footer')

@endsection

@section('script')
    <script type="text/javascript">
        $("#add_participant_form").attr('data','{{$oa->slug}}');

        //-----DATATABLES-----//
        modal_loader = $("#modal_loader").parent('div').html();
        //Initialize DataTable
        oa_participants_active = '';
        oa_participants_tbl = $("#oa_participants_table").DataTable({
          'dom' : 'lBfrtip',
          "processing": true,
          "serverSide": true,
          "ajax" : '{{route("dashboard.other_activities_participants.index")}}?activity={{$oa->slug}}',
          "columns": [
            { "data": "fullname" },
            { "data": "sex" },
            { "data": "age" },
            { "data": "group" },
            { "data": "action" }
          ],
          "buttons": [
            {!! __js::dt_buttons() !!}
          ],
          "columnDefs":[
            {
              "targets" : 1,
              "orderable" : true,
              "class" : 'w-10p'
            },
            {
              "targets" : [2,3],
              "orderable" : false,
              "class" : 'w-6p'
            },
            {
              "targets" : 4,
              "orderable" : false,
              "class" : 'action-10p'
            },
          ],
          "responsive": false,
          "initComplete": function( settings, json ) {
            $('#tbl_loader_{{$rand}}').fadeOut(function(){
              $("#oa_participants_table_container").fadeIn();
            });
          },
          "language":
                  {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                  },
          "drawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="modal"]').tooltip();
            if(oa_participants_active != ''){
              $("#oa_participants_table #"+oa_participants_active).addClass('success');
            }
          }
        })
        
        style_datatable("#oa_participants_table");
        
        //Need to press enter to search
        $('#oa_participants_table_filter input').unbind();
        $('#oa_participants_table_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
            oa_participants_tbl.search(this.value).draw();
          }
        });

        $("body").on('click','.edit_oap_btn',function () {
            btn = $(this);
            let uri  ='{{route("dashboard.other_activities_participants.edit","slug")}}';
            uri = uri.replace('slug',btn.attr('data'));
            load_modal2(btn);
            $.ajax({
                url : uri,
                data : '',
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    populate_modal2(btn,res);
                },
                error: function (res) {
                    notify('Ajax error','danger');
                    console.log(res);
                }
            })
        })


    </script>
@endsection

