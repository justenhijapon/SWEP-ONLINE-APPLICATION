@extends('layouts.admin-master')

@section('content')
                                                                                                                                                                                                                            
  <section class="content-header">
      <h1>Manage Block Farm</h1>
  </section>

  <section class="content">
      {{-- Table Grid --}}        
      <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">List of Block Farms</h3>
              <div class="pull-right">
                <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" data-toggle="modal" data-target="#add_block_farm_modal"><i class="fa fa-plus"></i> Add new</button>
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
                      <label>Mill District:</label>
                      <select aria-controls="scholars_table" class="form-control input-sm filter_mill filters">
                        <option value="">All</option>
                        @if(!empty($mill_districts_list))
                          @foreach($mill_districts_list as $key => $mill_district)
                            <option value="{{$mill_district}}">{{$key}}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="col-md-1 col-sm-2 col-lg-2">
                      <label>Group by:</label>
                      <select name="" class="form-control input-sm group_by">
                        <option value="">None</option>
                        <option value="mill_district">Mill District</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="block_farm_tbl_container" style="display: none">
                <table class="table table-bordered table-striped table-hover" id="block_farm_tbl" style="width: 100% !important; font-size: 14px">
                  <thead>
                    <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                      <th>Block Farm</th>
                      <th>Mill District</th>
                      <th>Date</th>
                      <th>Enrolee</th>
                      <th class="th-10">Source of Fund</th>
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
            <!-- /.box-body -->
          </div>

    </div>

  </section>

@endsection


<div style="display: none;" id="modal_loader"> 
  <div class="modal_loader">
    <center>
      <img style="width: 70px; margin: 40px 0;" src="{!! __static::loader(Auth::user()->color) !!}">
    </center>
  </div>
</div>




@section('modals')

  <!-- Add new block farm modal -->
<div id="add_block_farm_modal" class="modal fade "  role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <form id="add_block_farm_form" autocomplete="off">
        @csrf
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Block Farm</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            {!! __form::textbox(
              '6 block_farm_name', 'block_farm_name', 'text', 'Name of Block Farm', 'Name of Block Farm', old('title'), '', $errors->first('title'), ''
            ) !!}

            {!! __form::select_static(
              '3 mill_district', 'mill_district', 'Mill District*','', $mill_districts_list, $errors->has('is_menu'), $errors->first('is_menu'), '', ''
            ) !!}


            {!! __form::datepicker(
              '3 date', 'date',  'Date *', old('date_covered_from') ? old('date_covered_from') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_from'), $errors->first('date_covered_from')
            ) !!}
          </div>
          <hr>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Enrolee's Information</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Production Data</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="row">
                  {!! __form::textbox(
                    '6 enrolee_name', 'enrolee_name', 'text', 'Name of Enrolee', 'Name of Enrolee', old('title'), '' , $errors->first('title'), ''
                  ) !!}

                  {!! __form::textbox(
                    '6 fund_source', 'fund_source', 'text', 'Source of Fund', 'Source of Fund', old('title'), '', $errors->first('title'), ''
                  ) !!}

                  {!! __form::textbox(
                    '8 address', 'address', 'text', 'Address', 'Address', old('title'), '' , $errors->first('title'), ''
                  ) !!}

                 {!! __form::select_static(
                    '4 educ_att', 'educ_att', 'Educational Attainment*', old('is_menu'), [
                      'Doctoral Degree' => 'Doctoral Degree', 
                      'Masteral Degree' => 'Masteral Degree', 
                      'College Graduate' => 'College Graduate', 
                      'College Level' => 'College Level', 
                      'High School Graduate' => 'High School Graduate', 
                      'High School Level' => 'High School Level',
                      'Elementary Graduate' => 'Elementary Graduate',
                      'Pre-Elementary' => 'Pre-Elementary',
                      'None' => 'None'
                      
                    ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
                  ) !!}
                </div>
                <div class="row">
                  <div class="form-group col-md-3 sex">
                    <label for="sex">Sex</label>
                    <div class="radio">
                      <label>
                        <input type="radio" name="sex" value="MALE">
                        Male
                      </label>
                      <label style="margin-left: 15px">
                        <input type="radio" name="sex" value="FEMALE">
                        Female
                      </label>
                    </div>                    
                  </div>

                  {!! __form::textbox(
                    '2 age', 'age', 'number', 'Age', 'Age', old('title'), '' , $errors->first('title'), ''
                  ) !!}


                  {!! __form::select_static(
                    '3 civil_status', 'civil_status', 'Civil Status*', old('is_menu'), [
                      'Single' => 'Single',
                      'Married' => 'Married',
                      'Divorced' => 'Divorced',
                      'Separated' => 'Separated',
                      'Widowed' => 'Widowed'               
                    ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
                  ) !!}

                  {!! __form::textbox(
                    '4 religion', 'religion', 'text', 'Religion', 'Religion', old('title'), '' , $errors->first('title'), ''
                  ) !!}
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                    {!! __form::textbox(
                    '4 occupation', 'occupation', 'text', 'Occupation', 'Occupation *', old('title'),  '' , $errors->first('title'), ''
                    ) !!}

                    {!! __form::textbox(
                      '4 annual_income', 'annual_income', 'text', 'Annual Income', 'Annual Income', old('title'), 'annual_income', $errors->first('title'), ''
                    ) !!}

                    {!! __form::textbox(
                      '4 annual_expense', 'annual_expense', 'text', 'Annual Expense', 'Annual Expense', old('title'), 'annual_expense', $errors->first('title'), ''
                    ) !!}
                    </div>                      
                  </div>                  
                </div>
                <div class="row">
               
                    {!! __form::textbox(
                      '4 years_sugarcane_farming', 'years_sugarcane_farming', 'number', '# of Years in Sugarcane Farming', 'No. of Years in Sugarcane Farming', old('title'), $errors->has('title'), $errors->first('title'), ''
                    ) !!}

                    {!! __form::textbox(
                      '4 male_family', 'male_family', 'number', '# of Male Family Member', 'No. of Male Family Member', old('title'), $errors->has('title'), $errors->first('title'), ''
                    ) !!}

                    {!! __form::textbox(
                      '4 female_family', 'female_family', 'number', '# of Female Family Member', 'No. of Female Family Member', old('title'), $errors->has('title'), $errors->first('title'), ''
                    ) !!}
                </div>
              </div>
              <div class="tab-pane" id="tab_2">
                <div class="row">
                  <div class="col-md-6">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                            <p class="text-center no-margin"><b>
                            Production Data</b> </p>
                        </div>
                        <div class="panel-body">
                          <table class="table block_farm_table" style="background-color: white">
                          <thead>
                            <tr>
                              <th style="width: 40%"></th>
                              <th class="text-center">Plant</th>
                              <th class="text-center">Ratoon</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="text-center">
                                Total Area Planted (ha)
                              </td>
                              <td>
                                {!! __form::textbox_tbl_sm('plant_total_area','plant_total_area','number','','','step="0.00001"')!!}
                              </td>
                              <td>
                                {!! __form::textbox_tbl_sm('ratoon_total_area','ratoon_total_area','number','','','step="0.00001"')!!}
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" class="text-center">
                                Production per Hectare
                              </td>
                            </tr>
                            <tr>
                              <td class="text-center">
                                LKG/TC
                              </td>
                              <td>
                                {!! __form::textbox_tbl_sm('plant_lkg_tc','plant_lkg_tc','number','','','step="0.00001"')!!}
                              </td>
                              <td>
                                {!! __form::textbox_tbl_sm('ratoon_lkg_tc','ratoon_lkg_tc','number','','','step="0.00001"')!!}
                              </td>
                            </tr>

                            <tr>
                              <td class="text-center">
                                TC/ha
                              </td>
                              <td>
                                {!! __form::textbox_tbl_sm('plant_tc_ha','plant_tc_ha','number','','','step="0.00001"')!!}
                              </td>
                              <td>
                                {!! __form::textbox_tbl_sm('ratoon_tc_ha','ratoon_tc_ha','number','','','step="0.00001"')!!}
                              </td>
                            </tr>

                            <tr>
                              <td class="text-center">
                                LKg/ha
                              </td>
                              <td>
                                {!! __form::textbox_tbl_sm('plant_lkg_ha','plant_lkg_ha','number','','','step="0.00001"')!!}
                              </td>
                              <td>
                                {!! __form::textbox_tbl_sm('ratoon_lkg_ha','ratoon_lkg_ha','number','','','step="0.00001"')!!}
                              </td>
                            </tr>

                          </tbody>
                        </table>
                        </div>
                      </div>
                  </div>  
                  <div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <p class="text-center no-margin">
                          <b> PROBLEMS ENCOUNTERED </b>
                        </p>
                      </div>
                      <div class="panel-body">
                        @foreach ($data as $key => $value)
                        <div class="row">
                          <div class="col-md-6">
                            <p class="no-margin">
                              @if(is_numeric($key))
                                <b>Please select:</b>
                              @else
                                <b>{{ $key  }}</b>
                              @endif
                              
                            </p>
                          </div>
                          <div class="col-md-6">
                            <span class="pull-right">
                            <div class="checkbox no-margin">
                              <label><input class="all" type="checkbox" data="{{ $key }}">All</label>
                            </div>
                          </span>
                          </div>
                        </div>
                        
                        <hr style="margin: 0px">
                        <div class="row">
                        @foreach ($value as $problem)
                        <!-- {{ print("<pre>". print_r($value,true) ."</pre>") }} -->
                          <div class="col-md-6">
                            <div class="checkbox no-margin">
                              <label><input class="options" type="checkbox" value="{{ $problem['slug'] }}" data="{{ $problem['type'] }}" name="problem[]">{{ $problem['problem'] }}</label>
                            </div>
                          </div>

                        @endforeach
                        </div>

                      @endforeach
                        <p>
                          <b>OTHERS (Please specify):</b>
                        </p>
                        <div class="row"> 
                          {!! __form::textarea('12 specify_problem', 'specify_problem', '', '', '', '', 'style="width:100%; resize:none" rows="4"') !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} add_block_farm_btn"><i class="fa fa-save"> </i> Save</button>
        </div>
      </form>
    </div>

  </div>
</div>

{!! __html::blank_modal('show_block_farm_modal','lg') !!}
{!! __html::blank_modal('edit_block_farm_modal','lg') !!}


@endsection 




@section('scripts')
<script type="text/javascript">
  function dt_draw(){
    block_farm_tbl.draw(false);
  }



  function filter_dt(){
    mill = $(".filter_mill").val();
    block_farm_tbl.ajax.url('{{ route("dashboard.block_farm.index") }}?mill_district='+mill).load();

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
  // autonumeric
  autonum_settings = {
    currencySymbol : ' ₱',
    decimalCharacter : '.',
    digitGroupSeparator : ',',
  };

  new AutoNumeric('#annual_income', autonum_settings);
  new AutoNumeric('#annual_expense', autonum_settings);

  active = '';

  $('#block_farm_tbl')
    .on('preXhr.dt', function ( e, settings, data ) {
        Pace.restart();
    } )

  modal_loader = $("#modal_loader").html();
  //-----DATATABLES-----//
    //Initialize DataTable
    block_farm_tbl = $("#block_farm_tbl").DataTable({
      'dom' : 'lBfrtip',
      "processing": true,
      "serverSide": true,
      "ajax" : '{{ route("dashboard.block_farm.index") }}',
      "columns": [
          { "data": "block_farm_name" },
          { "data": "mill_district" },
          { "data": "date" },
          { "data": "enrolee_name" },
          { "data": "fund_source" },
          { "data": "action" }
      ],
      "buttons": [
          {!! __js::dt_buttons() !!}
      ],
      "columnDefs":[
        {
          "targets" : [ 0 , 1 , 2],
          "visible" : true
        },
        {
          "targets" : 5,
          "orderable" : false,
          "class" : 'action-8p'
        },
        {
          "targets": 3, 
          // "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
        }
      ],
      "responsive": false,
      "initComplete": function( settings, json ) {
          $('#tbl_loader').fadeOut(function(){
            $("#block_farm_tbl_container").fadeIn();
            search_for = "{{$search}}";
            if(search_for != ''){
              block_farm_tbl.search(search_for).draw();
              active = search_for;
              setTimeout(function(){
                active = '';
              },2000);
            }
          });
        },
      "language": 
        {          
          "processing": "<center><img style='width: 70px' src='{{ asset('images/loader.gif') }}'></center>",
        },
      "drawCallback": function(settings){
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="modal"]').tooltip();
        if(active != ''){
           $("#block_farm_tbl #"+active).addClass('success');
        }
      },
      'rowGroup': {
          'dataSrc': 'mill_district'
      },
      'order':[1,'asc']
    })

    $(".group_by").change(function(){
      c = $(this).val();
      p = $(this).parent('div');
      s = $(this).siblings('label');
 
      block_farm_tbl.rowGroup().dataSrc(c);

      block_farm_tbl.draw();
    })

    $(".filters").change(function(){
      filter_dt();
    })

    //Search Bar Styling
    style_datatable('#block_farm_tbl');

    //Need to press enter to search
    $('#my_payments_table_filter input[type="search"]').unbind();
    $('#my_payments_table_filter input[type="search"]').bind('keyup', function (e) {
        if (e.keyCode == 13) {
            block_farm_tbl.search(this.value).draw();
        }
    });

  //Submit Add Block Farm Form
  $("#add_block_farm_form").submit(function(e){
    form = $(this);
    loading_btn(form);
    e.preventDefault();
    Pace.restart();
    $.ajax({
      url : '{{ route("dashboard.block_farm.store") }}' ,
      data: $(this).serialize(),
      type: 'POST',
      dataType: 'json',
      success: function(response){
        console.log(response);
        if(response.result == 1){
          notify("Block farm successfully added.","success");
          succeed(form, true ,false);
          block_farm_tbl.draw(false);
          active = response.slug;
        }
      },
      error: function(response){
        error = 0;
        errored(form,response);
      }
    })
  })

  //Show BlockFarm
  $("body").on("click", ".show_block_farm_btn" , function(){
    $("#show_block_farm_modal .modal-content").html(modal_loader);
    id = $(this).attr("data");
    uri = " {{ route('dashboard.block_farm.show' , 'slug') }} ";
    uri = uri.replace("slug",id);
    Pace.restart();
    $.ajax({
      url: uri,
      type: "GET",
      success: function(response){
        $("#show_block_farm_modal .modal_loader").fadeOut(function(){
          $("#show_block_farm_modal .modal-content").html(response)
        })
      },
      error: function(response){
        console.log(response);
      }
    })
  })

  //Block farm edit button
  edit_block_farm_slug = '';
  $("body").on("click",".edit_block_farm_btn", function(e){
    id = $(this).attr('data');
    edit_block_farm_slug = id;
    uri = "{{ route('dashboard.block_farm.edit' , 'slug')  }}";
    uri = uri.replace("slug",id);
    Pace.restart();
    $("#edit_block_farm_modal .modal-content").html(modal_loader);
    $.ajax({
      url : uri,
      type: "GET",
      success: function(response){
        $("#edit_block_farm_modal .modal_loader").fadeOut(function(){
          $("#edit_block_farm_modal .modal-content").html(response);

          $('.datepicker').each(function(){
            $(this).datepicker({
                autoclose: true,
                dateFormat: "mm/dd/yy",
                orientation: "bottom"
            });
          });
          new AutoNumeric('#e_annual_income', autonum_settings);
          new AutoNumeric('#e_annual_expense', autonum_settings);
          $(".options").each(function(index, el) {
            $(this).change();          
          });
        });

        

      },error: function(response){
        console.log(response);
      }
    })
  })


  //Submit Edit block farm form
  $("body").on("submit","#edit_block_farm_form",function(e){
    form = $(this);
    e.preventDefault();
    uri = "{{ route('dashboard.block_farm.update', 'slug') }}";
    uri = uri.replace('slug',edit_block_farm_slug);
    data = $(this).serialize();
    wait_button("#edit_block_farm_form");
    Pace.restart();
    $.ajax({
      url : uri,
      data: data,
      type: 'PUT',
      dataType: 'json',
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response){
        if (response.result == 1) {
          notify("Block farm successfully updated","success");
          succeed(form,true,true);
          active = response.slug;
          block_farm_tbl.draw(false);
        }
      },
      error: function(response){
        errored(form,response);
      }
    })
    
  })

  //Delete block farm button
  $("body").on("click", ".delete_block_farm_btn", function(){
    id = $(this).attr('data');
    confirm("{{ route('dashboard.block_farm.destroy','slug') }}",id);
  })
  

  

  //Checkbox functionality
  $("#add_block_farm_modal").on("change",".all",function(){
    type = $(this).attr('data');
    if($(this).prop("checked")== true){
      $("input[data='"+type+"']").not(this).each(function(){
        $(this).prop("checked",true);
      })
    }else{
      $("input[data='"+type+"']").not(this).each(function(){
        $(this).prop("checked",false);
      })
    }
  })

  $("body").on("change","#edit_block_farm_modal .all",function(){
    type = $(this).attr('data');
    if($(this).prop("checked")== true){
      $("#edit_block_farm_modal input[data='"+type+"']").not(this).each(function(){
        $(this).prop("checked",true);
      })
    }else{
      $("#edit_block_farm_modal input[data='"+type+"']").not(this).each(function(){
        $(this).prop("checked",false);
      })
    }
  })


  $("#add_block_farm_modal").on("change",".options",function(){
    type = $(this).attr('data');
    no_for_this_type = $("#add_block_farm_modal .options[data='"+type+"']").length;
    no_of_checked = $("#add_block_farm_modal .options[data='"+type+"']:checked").length;
    if(no_for_this_type != no_of_checked){
      $("#add_block_farm_modal .all[data='"+type+"']").prop('indeterminate',true);
    }if(no_for_this_type == no_of_checked){
      $("#add_block_farm_modal .all[data='"+type+"']").prop('indeterminate',false);
      $("#add_block_farm_modal .all[data='"+type+"']").prop('checked',true);
    }if(no_of_checked == 0){
      $("#add_block_farm_modal .all[data='"+type+"']").prop('indeterminate',false);
      $("#add_block_farm_modal .all[data='"+type+"']").prop('checked',false);
    }
  })

  $("body").on("change","#edit_block_farm_modal .options",function(){
    type = $(this).attr('data');
    no_for_this_type = $("#edit_block_farm_modal .options[data='"+type+"']").length;
    no_of_checked = $("#edit_block_farm_modal .options[data='"+type+"']:checked").length;
    if(no_for_this_type != no_of_checked){
      $("#edit_block_farm_modal .all[data='"+type+"']").prop('indeterminate',true);
    }if(no_for_this_type == no_of_checked){
      $("#edit_block_farm_modal .all[data='"+type+"']").prop('indeterminate',false);
      $("#edit_block_farm_modal .all[data='"+type+"']").prop('checked',true);
    }if(no_of_checked == 0){
      $("#edit_block_farm_modal .all[data='"+type+"']").prop('indeterminate',false);
      $("#edit_block_farm_modal .all[data='"+type+"']").prop('checked',false);
    }
  })
</script>
    
@endsection