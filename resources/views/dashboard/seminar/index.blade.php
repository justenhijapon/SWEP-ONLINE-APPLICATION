@extends('layouts.admin-master')

@section('content')
                                                                                                                                                                                                                            
  <section class="content-header">
      <h1>Manage GSTs</h1>
  </section>

  <section class="content">
     

      {{-- Table Grid --}}        
      <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">GSTs</h3>
              <div class="pull-right">
                <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" data-toggle="modal" data-target="#add_seminar_modal"><i class="fa fa-plus"></i> New GST</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="seminars_table_container" style="display: none">
                <table class="table table-bordered table-striped table-hover" id="seminars_table" style="width: 100% !important">
                  <thead>
                    <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                      <th>SLUG</th>
                      <th>SEMINAR ID</th>
                      <th>Title</th>
                      <th>Mill District</th>
                      <th>Sponsor</th>
                      <th>Venue</th>
                      <th>Date Covered</th>
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

    </div>

  </section>

@endsection


@section('modals')

  {!! __html::modal_delete('seminar_delete') !!}

  <!-- Add Seminar Modal -->
  <div class="modal fade" id="add_seminar_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">New Seminar</h4>
        </div>
        <form autocomplete="off" id="form_add_seminar" enctype="multipart/form-data">  
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                 
                    <div class="box-body">
                      <div class="col-md-12">
                              
                        @csrf    

                        <div class="row">
                          <div class="col-md-7">
                            <div class="row">

                              {!! __form::select_static(
                                '7 title', 'title', 'Title: *', '' , \App\Core\Helpers\Arrays::blockFarms() , '', '', '', ''
                              ) !!}

                              {!! __form::select_static(
                                '5 mill_district', 'mill_district', 'Mill District: *', '' , $mill_districts_list , '', '', '', ''
                              ) !!}

                            </div>
                            <div class="row">
                              {!! __form::textbox(
                                '6 sponsor', 'sponsor', 'text', 'Sponsor', 'Sponsor', old('sponsor'), $errors->has('sponsor'), $errors->first('sponsor'), ''
                              ) !!}

                              {!! __form::textbox(
                                '6 venue', 'venue', 'text', 'Venue *', 'Venue', old('venue'), $errors->has('venue'), $errors->first('venue'), ''
                              ) !!}
                            </div>
                            <div class="row">
                              {!! __form::datepicker(
                                '6 date_from', 'date_covered_from',  'Date From *', old('date_covered_from') ? old('date_covered_from') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_from'), $errors->first('date_covered_from')
                              ) !!}

                              {!! __form::datepicker(
                                '6 date_to', 'date_covered_to',  'Date To *', old('date_covered_to') ? old('date_covered_to') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_to'), $errors->first('date_covered_to')
                              ) !!}
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <p class="page-header-sm text-info">
                                  Utilization
                                </p>
                              </div>
                            </div>
                            <div class="row">
                              @php
                                $project_code = \App\Models\Projects::select(['project_code','activity'])->get();
                              @endphp
                              {!! __form::select_object_project_code(
                                '6 project_code', 'project_code', 'Project Code', '', $project_code, '' ,''
                              ) !!}

                              {!! __form::textbox(
                                '6 utilized_fund', 'utilized_fund', 'text', 'Utilized Fund *', 'Utilized Fund', '', '', '', '','autonum'
                              ) !!}
                            </div>
                          </div>
                          <div class="col-md-5">
                            {!! __form::file(
                             '12', 'doc_file','doc_file', 'Attendance Sheet', $errors->has('doc_file'), $errors->first('doc_file'), ''
                            ) !!}   
                          </div>

                        </div>
                      </div>

                      

                      {{-- SPEAKERS DYNAMIC TABLE GRID --}}
                      <div class="col-md-12" style="padding-top:30px;">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="no-margin">
                              <b>Add Speakers</b>
                            </p>
                              </div>
                              <div class="col-md-6">
                                <button id="add_row" type="button" class="btn btn-xs btn-success pull-right">Add Speaker &nbsp;<i class="fa fw fa-plus"></i></button>
                              </div>
                            </div>

                          </div>    
                          <div class="panel-body">
                            <table class="table table-bordered">
                              
                              <tr>
                                <th>Fullname *</th>
                                <th>Topic</th>
                                <th style="width: 40px"></th>
                              </tr>

                              <tbody id="table_body">
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>                  
              </div>              
            </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} submit_add_seminar"><i class="fa fa-save"></i> Save</button>
          </div>

        </form>
      </div>
    </div>
  </div>

  <!-- Edit modal -->
  <div class="modal fade" id="edit_seminar_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        
          <div id="edit_seminar_modal_loader">
            <center>
              <img style="width: 70px; margin: 40px 0;" src="{!! __static::loader(Auth::user()->color) !!}">
            </center>
          </div>
        </div>
    </div>
  </div>

{!! __html::blank_modal('participant_modal','80') !!}

{!! __html::blank_modal('edit_participant_modal','','100px') !!}


<!-- Modal -->
<form id="add_participant_form">
  <div class="modal fade" id="add_participant_modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document" style="padding-top: 100px">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Participant</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            {!! __form::textbox(
             '5 fullname', 'fullname', 'text', 'Fullname *', 'Fullname', '', $errors->has('fullname'), $errors->first('fullname'), ''
             ) !!}

            {!! __form::textbox(
             '4 occupation', 'occupation', 'text', 'Occupation', 'Occupation', '', $errors->has('occupation'), $errors->first('occupation'), ''
             ) !!}

            {!! __form::textbox(
             '3 age', 'age', 'number', 'Age *', 'Age', '', $errors->has('age'), $errors->first('age'), ''
             ) !!}


            {!! __form::select_static(
              '4 civil_status', 'civil_status', 'Civil Status ', '', [
                'Single' => 'Single',
                'Married' => 'Married',
                'Divorced' => 'Divorced',
                'Separated' => 'Separated',
                'Widowed' => 'Widowed'               
              ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ) !!}


            {!! __form::select_static(
              '5 educ_att', 'educ_att', 'Educational Attainment', '', [
                'Elementary' => 'Elementary', 
                'High School' => 'High School', 
                'College' => 'College',
                'None' => 'None'

              ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ) !!}



            {!! __form::textbox(
             '3 no_children', 'no_children', 'number', 'No. of Children', 'No. of Children', '', $errors->has('no_children'), $errors->first('no_children'), ''
             ) !!} 


             {!! __form::select_static(
              '3 sex', 'sex', 'Sex *', '', ['MALE' => 'MALE', 'FEMALE' => 'FEMALE'], $errors->has('sex'), $errors->first('sex'), '', ''
              ) !!}



            {!! __form::textbox(
             '4 contact_no', 'contact_no', 'text', 'Contact No.', 'Contact No.', '', $errors->has('contact_no'), $errors->first('contact_no'), ''
             ) !!}


            


          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="-1">Close</button>
          <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!}">
            <i class="fa fa-save"> </i> Save
          </button>
        </div>
      </div>
    </div>
  </div>

</form>


{!! __html::blank_modal('view_seminar_modal','80') !!}



@endsection 


@section('scripts')

<script type="text/javascript">
{!! __js::modal_loader() !!}

  
function delete_participant(slug){
  $.confirm({
    title: 'Confirm!',
    content: 'Are you sure you want to remove this participant?',
    type: 'red',
    typeAnimated: true,
    buttons: {
        confirm:{
            btnClass: 'btn-danger',
           action: function(){
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            })

            uri = "{{ route('dashboard.seminar.participant_destroy', 'slug') }}";
            uri = uri.replace('slug', slug);
            Pace.restart();
            $.ajax({
                url : uri,
                type: 'DELETE',
                success: function(response){
                  notify("Item successfully deleted.", "success");
                  participant_tbl.row("#"+slug).remove().draw();
                },
                error: function(response){
                  notify("An error occured while deteling the item.", "danger");
                  console.log(response)
                }

            })
             
           }

        },
        cancel: function () {
            
        }
    }
}); 
}

function dt_draw(){
  seminars_table.draw(false);
}
</script>

<script type="text/javascript">
    function rows_add(element){
      start = 0;
        $(element+" tr .speaker").each(function(){
          $(this).attr('name','row['+start+'][spkr_fullname]');
          $(this).parent('div').addClass('row-'+start+'-spkr_fullname');
          start++;
        })

        start = 0;
        $(element+" tr .topic").each(function(){
          $(this).attr('name','row['+start+'][spkr_topic]');
          $(this).parent('div').addClass('row-'+start+'-spkr_topic');
          start++;
        })
    }
    function append_speakers(element){

      if(element == '#form_add_seminar #table_body'){
        btn = 'delete_row';
      }else{
        btn = 'delete_row_edit';
      }
      var i = $(element).children().length;
        var content ='<tr>' +
                        '<td>' +
                          '<div class="form-group row-'+i+'-spkr_fullname">' +
                              '<input type="text" name="row[' + i + '][spkr_fullname]" class="form-control speaker" placeholder="Fullname">' +
                          '</div>' +
                        '</td>' +
                        '<td>' +
                            '<input type="text" name="row[' + i + '][spkr_topic]" class="form-control topic" placeholder="Topic">' +
                        '</td>' +

                        '<td>' +
                            '<button type="button" class="btn btn-sm bg-red '+btn+'"><i class="fa fa-times"></i></button>' +
                        '</td>' +
                      '</tr>';
        $(element).append($(content));
    }

    $(document).ready(function(){
      active = '';
      edit_loader = $("#edit_seminar_modal .modal-content").html();



      $('#seminars_table')
        .on('preXhr.dt', function ( e, settings, data ) {
            Pace.restart();
        } )


    //-----DATATABLES-----//
      //Initialize DataTable
      seminars_table = $("#seminars_table").DataTable({
        'dom' : 'lBfrtip',
        "processing": true,
        "serverSide": true,
        "ajax" : '{{ route("dashboard.seminar.index") }}',
        "columns": [
            { "data": "slug" },
            { "data": "seminar_id" },
            { "data": "title" },
            { "data": "mill_district" },
            { "data": "sponsor" },
            { "data": "venue" },
            { "data": "date_covered" },
            { "data": "action" }
        ],
        buttons: [
            {!! __js::dt_buttons() !!}
        ],
        "columnDefs":[
          {
            "targets" : [ 0 , 1 ],
            "visible" : false
          },
          {
            "targets" : 7,
            "orderable" : false,
            "class" : 'action-10p'
          },
          {
            "targets": 6, 
           // "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
          }
        ],
        "responsive": false,
        "initComplete": function( settings, json ) {
            $('#tbl_loader').fadeOut(function(){
              $("#seminars_table_container").fadeIn();
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
             $("#seminars_table #"+active).addClass('success');
          }
        }
      })

      //Search Bar Styling
      style_datatable('#seminars_table');

      //Need to press enter to search
      $('#seminars_table_filter input').unbind();
      $('#seminars_table_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
              seminars_table.search(this.value).draw();
          }
      });

    //-----SEMINAR-----//
      //Submit Add Seminar Form
      $("#form_add_seminar").submit(function(e){
        e.preventDefault();
        form = $(this);
        loading_btn(form);
        formData = new FormData(this);
        Pace.restart();
        $.ajax({
          url: "{{ route('dashboard.seminar.store') }}",
          data: formData,
          type: "POST",
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function(response){

            console.log(response);
            notify("Your data was successfully saved", "success");

            seminars_table.draw(false);
            active = response.slug;

            succeed(form,true,false);
            $("#form_add_seminar input[name='title']").focus();
            $("#table_body").html('');
          },
          error: function(response){
            errored(form,response);
          }
        })
      })
      
      //Edit seminar button
      $("body").on("click", ".edit_seminar_btn", function(){
        $("#edit_seminar_modal .modal-content").html(edit_loader);
        id = $(this).attr('data');
        uri = "{{ route('dashboard.seminar.edit', 'slug') }}";
        uri = uri.replace('slug',id);
        Pace.restart();
        $.ajax({
          url : uri ,
          type : 'GET',
          success: function(response){

            $("#edit_seminar_modal_loader").fadeOut(function(){
              $("#edit_seminar_modal .modal-content").html(response);

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
                append_speakers('#edit_seminar_form #table_body');
                rows_add('#edit_seminar_form #table_body');
              })

              //delete row button from edit modal
              $("body").on("click", ".delete_row_edit", function(){
                $(this).parent('td').parent('tr').remove();
                rows_add('#edit_seminar_form #table_body');
              })

              //Submit Edit Seminar Form
              $("#edit_seminar_form").submit(function(e){
                default_update_seminar_btn = $("#edit_seminar_form .update_seminar_btn").html();
                update_seminar_btn = $("#edit_seminar_form .update_seminar_btn");
                update_seminar_btn.html("<i class='fa fa-spinner fa-spin'> </i> Please wait");
                update_seminar_btn.attr("disabled","disabled");

                e.preventDefault();
                uri = "{{ route('dashboard.seminar.update', 'slug') }}";
                uri = uri.replace('slug',id);
                formData = new FormData(this);
                Pace.restart();
                $.ajax({
                  url: uri,
                  data: formData,
                  type: 'POST',
                  dataType: 'json',
                  processData: false,
                  contentType: false, 
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response){
                    //console.log(response)
                    if(response.result == 1){
                      notify("Changes were successfully saved.", "success");
                      seminars_table.draw(false);
                      active = response.slug;
                      $("#edit_seminar_modal").modal('hide');
                      update_seminar_btn.html(default_update_seminar_btn);
                      update_seminar_btn.removeAttr("disabled");
                    
                    }
                  },
                  error: function(response){
                    //console.log(response);
                    parsed = JSON.parse(response.responseText);
                    $("#edit_seminar_form .has-error").each(function(){
                      $(this).removeClass("has-error");
                      $(this).children("span").remove();
                    });

                    $.each(parsed.errors, function(i, item){
                      i = i.replace('.','-');
                      i = i.replace('.','-');
                      parent = $("#edit_seminar_form ."+i);
                      parent.addClass("has-error");
                      parent.append('<span class="help-block">'+item+'</span>');
                    });

                    update_seminar_btn.html(default_update_seminar_btn);
                    update_seminar_btn.removeAttr("disabled");
                  }
                })
              })

            })
          },error: function(response){
            notify("Error: "+JSON.stringify(response), 'danger');
          }
        })
      })
      
       //Delete seminar button
      $("body").on("click", ".delete_seminar_btn", function(){
        id = $(this).attr('data');
        confirm("{{ route('dashboard.seminar.destroy', 'slug') }}", id);
      })

      //Show seminar button
      $("body").on("click", ".view_seminar_btn", function(){
        $("#view_seminar_modal .modal-content").html(edit_loader);
        id = $(this).attr("data");
        uri = '{{ route("dashboard.seminar.show", "slug") }}';
        uri = uri.replace('slug',id);
        Pace.restart();
        $.ajax({
          url : uri,
          type : 'GET',
          success: function(response){
            $("#view_seminar_modal #edit_seminar_modal_loader").fadeOut(function(){
              $("#view_seminar_modal .modal-content").html(response);
            })
          }
        })
      })

    //-----SEMINAR SPEAKERS-----//
      //Add speaker button
      $("#add_row").click(function(){
        append_speakers('#form_add_seminar #table_body');
        rows_add('#form_add_seminar #table_body');
      });

      //Delete speaker button
      $("body").on("click",".delete_row",function(){
        $(this).parent('td').parent('tr').remove();
        rows_add('#form_add_seminar #table_body');
      });

     

      
    //-----SEMINAR PARTICIPANTS-----//
      //Participants
      seminar_slug = '';
      //On Click of Participant Button
      $("body").on("click", ".participant_btn",function(){
        id = $(this).attr('data');
        uri = "{{ route('dashboard.seminar.participant', 'slug') }}";
        uri = uri.replace('slug',id);
        $("#participant_modal .modal-content").html(edit_loader);
        Pace.restart();
        $.ajax({
          url: uri,
          type: "GET",
          success: function(response){
            seminar_slug = id;
            $("#participant_modal #edit_seminar_modal_loader").fadeOut(function(){
              $("#participant_modal .modal-content").html(response);      
              participant_tbl = $("#participant_tbl").DataTable({
                'dom' : 'lBfrtip',
                "columnDefs":[
                  {
                    "targets" : 5,
                    "orderable" : false
                  } 
                ],
                "buttons": [
                  {
                    'extend': 'excel',
                    'exportOptions':{
                      'columns' : [0,1,2,3,4,5,6,7]
                    },
                    'text': '<i class="fa fa-file-excel-o fa-fw"></i> Export as Excel'
                  }
                ]
              });  


              $("#participant_tbl_filter").addClass('col-md-3 pull-right');
              $("#participant_tbl_wrapper .dataTables_length").addClass('col-md-3');

              $("#participant_tbl_wrapper .buttons-html5").each(function(index, el) {
                $(this).addClass('btn-sm');
              });
            });
            
          }
        })
      });


      //Add Participants
      $("body").on("submit","#add_participant_form", function(e){
          default_add_participant_btn = $("#add_participant_form .add_participant_btn").html();
          add_participant_btn = $("#add_participant_form .add_participant_btn");
          add_participant_btn.html("<i class='fa fa-spin fa-spinner'> </i> Please wait ");
          add_participant_btn.attr("disabled","disabled");

          e.preventDefault();
          uri = "{{ route('dashboard.seminar.participant_store' ,'slug') }}";
          uri = uri.replace('slug',seminar_slug);
          Pace.restart();
          $.ajax({
            url : uri,
            type: 'POST',
            data: $(this).serialize()+"&slug="+seminar_slug,
            dataType: 'json',
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){

              console.log(response);
                $("#add_participant_form").get(0).reset();
                notify("Participant successfully added.","success");
                $("#add_participant_form .has-error").each(function(){
                  $(this).removeClass('has-error');
                  $(this).children('span').remove();
                });
                participant_tbl.row.add([
                  response.fullname,
                  response.occupation,
                  response.age,
                  response.civil_status,
                  response.educ_att,
                  response.contact_no,
                  response.no_children,
                  response.sex,
                  '<div class="btn-group">'+
                  '<button data-toggle="modal" data-target="#edit_participant_modal"  data="'+response.slug+'" class="btn btn-sm btn-default edit_participant_btn">'+
                    '<i class="fa fa-pencil-square-o"></i>'+
                  '</button>'+
                  '<button data="'+response.slug+'" class="btn btn-sm btn-danger delete_participant_btn">'+
                    '<i class="fa  fa-trash-o"></i>'+
                  '</button>'+
                '</div>'
                ]).node().id= response.slug;
                participant_tbl.draw();

                $("#participant_tbl .success").each(function(){
                  $(this).removeClass('success');
                })
                $("#"+response.slug).addClass('success');

                add_participant_btn.html(default_add_participant_btn);
                add_participant_btn.removeAttr("disabled");

                $("#add_participant_form input[name='fullname']").focus();
            },
            error: function(response){
              console.log(response);
              $("#add_participant_form .has-error").each(function(){
                $(this).removeClass('has-error');
                $(this).children('span').remove();
              })
              $.each(response.responseJSON.errors, function(i, item){
                $("#add_participant_form ."+i).addClass('has-error');
                $("#add_participant_form ."+i).addClass('has-error');
                $("#add_participant_form ."+i).append('<span class="help-block">'+item+'</span>');
              });
              add_participant_btn.html(default_add_participant_btn);
              notify("Please fill out the required fields","warning");
              add_participant_btn.removeAttr("disabled");
            }
          })
      })

      //Delete participant button
      $("body").on("click",".delete_participant_btn", function(e){
        id = $(this).attr('data');
        delete_participant(id);
      })

      $("body").on("click",".edit_participant_btn", function(){

        load_modal('#edit_participant_modal');
        participant_slug = $(this).attr('data');

        $.ajax({
          url : "{{ route('dashboard.seminar.participant_edit', 'slug') }}?slug="+participant_slug,
          type: 'GET',
          success: function(response){
            populate_modal("#edit_participant_modal",response);
          },
          error: function(response){
            console.log(response);
          }
        })

      })


      $("body").on("submit","#edit_participant_form", function(e){
        e.preventDefault();
        slug = $(this).attr('data');
        uri = "{{ route('dashboard.seminar.participant_update' , 'slug') }}";
        uri = uri.replace('slug',slug);
        wait_button('#edit_participant_form');

        $.ajax({
          url : uri,
          data: $(this).serialize(),
          type: 'PUT',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response){
            console.log(response);
            notify("Participant has been updated successfully","success");
            $("#edit_participant_modal").modal('hide');
            r = response;
            tbl = $("#participant_tbl").dataTable();
            tbl.fnUpdate(r.fullname,'#'+r.slug, 0,false);
            tbl.fnUpdate(r.occupation,'#'+r.slug, 1, false);
            tbl.fnUpdate(r.age,'#'+r.slug, 2, false);
            tbl.fnUpdate(r.civil_status,'#'+r.slug, 3, false);
            tbl.fnUpdate(r.educ_att,'#'+r.slug, 4, false);
            tbl.fnUpdate(r.contact_no,'#'+r.slug, 5, false);
            tbl.fnUpdate(r.no_children,'#'+r.slug, 6, false);
            tbl.fnUpdate(r.sex,'#'+r.slug, 7, false);
            $("#participant_tbl .success").each(function(){
              $(this).removeClass('success');
            });
            $("#participant_tbl #"+r.slug).addClass('success');

            //ptcpt_btn.html(default_edit_ptcpt_btn);
            //ptcpt_btn.removeAttr("disabled");


          },
          error: function(response){
            console.log(response);
            errored("#edit_participant_form","save",response);
          }
        })
      })

      //Update Participant
      participant_slug = '';
      // $("body").on("submit","#edit_participant_form", function(e){
      //   e.preventDefault();
      //   ptcpt_btn = $("#edit_participant_form .update_participant_btn");
      //   default_edit_ptcpt_btn = $("#edit_participant_form .update_participant_btn").html();

      //   ptcpt_btn.html("<i class='fa fa-spinner fa-spin'> </i> Please wait");
      //   ptcpt_btn.attr("disabled","disabled");
      //   uri = "{{ route('dashboard.seminar.participant_update' , 'slug') }}";
      //   uri = uri.replace('slug',participant_slug);
      //   Pace.restart();
      //   $.ajax({
      //     url: uri,
      //     data: $(this).serialize(),
      //     type: 'PUT',
      //     dataType: 'json',
      //     headers: {
      //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //     },
      //     success: function(response){
      //       r = response;
      //       if(r.result == 1){
      //         notify("Participant successfully updated.",'success');
      //         edit_dialog.close();
      //         tbl = $("#participant_tbl").dataTable();
      //         tbl.fnUpdate(r.e_fullname,'#'+r.slug, 0,false);
      //         tbl.fnUpdate(r.e_address,'#'+r.slug, 1, false);
      //         tbl.fnUpdate(r.e_sex,'#'+r.slug, 2, false);
      //         tbl.fnUpdate(r.e_contact_no,'#'+r.slug, 3, false);
      //         tbl.fnUpdate(r.e_email,'#'+r.slug, 4, false);
      //         $("#participant_tbl .success").each(function(){
      //           $(this).removeClass('success');
      //         });
      //         $("#participant_tbl #"+r.slug).addClass('success');

      //         ptcpt_btn.html(default_edit_ptcpt_btn);
      //         ptcpt_btn.removeAttr("disabled");
      //       }
      //     },
      //     error: function(response){
      //       console.log(response);
      //       ptcpt_btn.html(default_edit_ptcpt_btn);
      //       ptcpt_btn.removeAttr("disabled");

      //       $("#edit_participant_form .has-error").each(function(){
      //         $(this).removeClass("has-error");
      //         $(this).children("span").remove();
      //       })

      //       $.each(response.responseJSON.errors, function(i, item){
      //         $("#edit_participant_form ."+i).addClass('has-error');
      //         $("#edit_participant_form ."+i).append('<span class="help-block">'+item+'</span>')
      //       })
      //     }
      //   })
      // })


    })
    
  </script>
    
@endsection