@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Office Activities</h1>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">List of Activities</h3>
        <div class="pull-right">
            <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" data-toggle="modal" data-target="#add_member_modal"><i class="fa fa-plus"></i> Add new</button>
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
                <label>Is menu:</label>
                <select name="committee_members_length" aria-controls="committee_members" class="form-control input-sm filter_menu filters">
                  <option value="">All</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
              </div>
              <div class="col-md-1 col-sm-2 col-lg-2">
                <label>Is dropdown:</label>
                <select name="committee_members_length" aria-controls="committee_members" class="form-control input-sm filter_dropdown filters">
                  <option value="">All</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="box-body">
        <div id="committee_members_table_container" style="display: none">
          <table class="table table-bordered table-striped table-hover" id="committee_members_table" style="width: 100% !important">
            <thead>
              <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                <th>Fullname</th>
                <th>Base</th>
                <th>Sex</th>
                <th class="action">Action</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
      <div id="tbl_loader">
        <center>
          <img style="width: 100px" src="{!! __static::loader(Auth::user()->color) !!}">
        </center>
      </div>
    </div>

 

  </div>
  </section>

@endsection





@section('modals')

{!! __html::blank_modal('show_menu_modal','lg') !!}
{!! __html::blank_modal('edit_menu_modal','sm') !!}
{!! __html::blank_modal('list_submenus','lg') !!}

<div class="modal fade" id="add_member_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form id= "add_member_form">
         @csrf
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Office Activity</h4>
        </div>
        <div class="modal-body">
          
          <div class="row">
            {!! __form::textbox(
              '12 title', 'title', 'text', 'Title*', 'Title*', '', '', '', ''
            ) !!}

            {!! __form::datepicker(
              '12 date', 'date',  'Date*', old('date_covered_from') ? old('date') : Carbon::now()->format('m/d/Y'), $errors->has('date'), $errors->first('date')
            ) !!}

            {!! __form::textbox(
              '12 venue', 'venue', 'text', 'Venue', 'Venue', '', '', '', ''
            ) !!}
          </div>
        </div>
        <div class="modal-footer">
          <button tabindex="-1" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!}"><i class="fa fa-save"></i> Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


{!! __html::blank_modal('show_committee_member_modal','') !!}
{!! __html::blank_modal('edit_committee_member_modal','') !!}

@endsection 





@section('scripts')
<script type="text/javascript">
  function dt_draw(){
    committee_members_tbl.draw(false);
  }

  function delete_submenu(slug){
    $.confirm({
      title: 'Confirm!',
      content: 'Are you sure you want to remove this submenu?',
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
            uri = "{{ route('dashboard.submenu.destroy', 'slug') }}";
            uri = uri.replace('slug', slug);
            Pace.restart();
            $.ajax({
              url : uri,
              type: 'DELETE',
              success: function(response){
                notify("Item successfully deleted.", "success");
                submenu_tbl.row("#"+slug).remove().draw();
                active = response.menu_id;
                menu_tbl.draw(false);
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

  function filter_dt(){
    is_menu = $(".filter_menu").val();
    is_dropdown = $(".filter_dropdown").val();
    menu_tbl.ajax.url(
      "{{ route('dashboard.menu.index') }}?is_menu="+is_menu+"&is_dropdown="+is_dropdown).load();
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
  committee_members_tbl = $("#committee_members_table").DataTable({
    'dom' : 'lBfrtip',
    "processing": true,
    "serverSide": true,
    "ajax" : {
      url : '{{ route("dashboard.committee_members.index") }}',
      type: 'GET',
    },
    "columns": [
        { "data": "fullname" },
        { "data": "based_on" },
        { "data": "sex" },
        { "data": "action" }
    ],
    "buttons": [
        {!! __js::dt_buttons() !!}
    ],
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    "columnDefs":[
      {
        "targets" : 0,
        "class" : "scholars_name"
      },
      {
        "targets" : 2,
        "class" : 'w-6p'
      },
      {
        "targets" : 3,
        "orderable" : false,
        "class" : 'action-8p'
      },
  
    ],
    "responsive": false,
    "initComplete": function( settings, json ) {
        $('#tbl_loader').fadeOut(function(){
          $("#committee_members_table_container").fadeIn();

  
          search_for = "{{$search}}";
          if(search_for != ''){
            scholars_tbl.search(search_for).draw();
            active = search_for;
            setTimeout(function(){
              active = '';
            },3000);
          }
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
         $("#committee_members_table #"+active).addClass('success');
      }
    },
    'rowGroup': {
        'dataSrc': 'mill_district'
    },
    "order": [[ 1, "asc" ], [0, 'asc']]
  })

  style_datatable("#committee_members_table");

  //Search Bar Styling
  $('#committee_members_table_filter input').css("width","300px");
  $("#committee_members_table_filter input").attr("placeholder","Press enter to search");

  //Need to press enter to search
  $('#committee_members_table_filter input').unbind();
  $('#committee_members_table_filter input').bind('keyup', function (e) {
      if (e.keyCode == 13) {
          committee_members_tbl.search(this.value).draw();
      }
  });

  $("#search_employee_input").change(function(){
    if($(this).val()== ""){
      $("#add_member_form input[name='slug_afd']").val('');
    }
  });

  $('#search_employee_input').typeahead({
    ajax : "{{ route('dashboard.committee_members.index') }}",
    onSelect:function (result) {
      $.ajax({
        url : '{{route("dashboard.committee_members.index")}}?find_employee='+result.value,
        type: 'GET',
        success :function(response){
          $("#add_member_form input[name='lname']").val(response.lastname);
          $("#add_member_form input[name='fname']").val(response.firstname);
          $("#add_member_form input[name='mname']").val(response.middlename);
          $("#add_member_form select[name='sex']").val(response.sex);
           $("#add_member_form input[name='slug_afd']").val(response.slug);

          $('#search_employee_input').parent('div').addClass('has-success');
          if(response.sex == null){
            $("#add_member_form select[name='sex']").focus();
          }else{
            $("#add_member_form select[name='based_on']").focus();
          }
        }
      });
    },
    items : 15
  });

  $("#add_member_form").submit(function(e){
    e.preventDefault();
    wait_button('#add_member_form');
    $.ajax({
      url: '{{route("dashboard.committee_members.store")}}',
      data: $(this).serialize(),
      type: 'POST',
      success: function(response){
        active = response.slug;
        succeed('#add_member_form','save', true);
        notify('Committee Member successfully added', 'success');
        $('#search_employee_input').parent('div').removeClass('has-success');
        $('#search_employee_input').focus();

        committee_members_tbl.draw(false);
      },
      error: function(response){
        errored('#add_member_form', 'save',response);
      }     
    })
  })

  $("body").on('click','.show_committe_member_btn', function(){
    slug = $(this).attr('data');
    url = '{{route("dashboard.committee_members.show","slug")}}';
    url = url.replace('slug', slug);
    load_modal('#show_committee_member_modal')
    $.ajax({
      url : url,
      type: 'GET',
      success: function(response){
        populate_modal('#show_committee_member_modal', response);
      },
      error: function(response){
        console.log(response);
      }
    })
  })


  $("body").on("click",".edit_committee_member_btn", function(){
    slug = $(this).attr('data');
    url = '{{route("dashboard.committee_members.edit","slug")}}',
    url = url.replace("slug",slug);
    load_modal('#edit_committee_member_modal');
    $.ajax({
      url : url,
      type: 'GET',
      success: function(response){
        populate_modal('#edit_committee_member_modal',response);
      },
      error: function(response){
        notify("Error: check console","warning");
        console.log(response);
      }
    })
  })

  $("body").on("submit","#edit_member_form", function(e){
    e.preventDefault();
    slug = $(this).attr('data');
    url = '{{route("dashboard.committee_members.update","slug")}}';
    url = url.replace('slug',slug);
    wait_button('#edit_member_form');
    $.ajax({
      url : url,
      data : $(this).serialize(),
      type: 'PUT',
      success : function(response){
        notify('Committee Member successfully updated', 'success');
        $('#edit_committee_member_modal').modal('hide');
        active = response.slug;
        committee_members_tbl.draw(false);
      },error: function(response){
        errored('#edit_member_form', 'save',response);
      }
    })
  })


  $("body").on("click",".delete_committee_member_btn", function(){
    id = $(this).attr('data');
    confirm("{{ route('dashboard.committee_members.destroy', 'slug') }}", id);
  })


</script>
@endsection
