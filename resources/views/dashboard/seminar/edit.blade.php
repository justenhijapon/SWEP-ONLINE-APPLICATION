
<form id="edit_seminar_form" autocomplete="off">
  @csrf 
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Edit</h4>
  </div>

  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
          <code class="pull-right">Fields with asterisks(*) are required</code>
      </div>
    </div>

  
    @method('PUT')

    <div class="row">
      <div class="col-md-7">
        <div class="row">
          {!! __form::select_static(
            '7 title', 'title', 'Title: *', $seminar->title , \App\Core\Helpers\Arrays::blockFarms() , '', '', '', ''
          ) !!}

           {!! __form::select_static(
            '5 mill_district', 'mill_district', 'Mill District: *', $seminar->mill_district , $mill_districts_list , '', '', '', ''
          ) !!}


        </div>
        <div class="row">
          {!! __form::textbox(
            '6 sponsor', 'sponsor', 'text', 'Sponsor', 'Sponsor', old('sponsor') ? old('sponsor') : $seminar->sponsor, $errors->has('sponsor'), $errors->first('sponsor'), ''
          ) !!}

          {!! __form::textbox(
            '6 venue', 'venue', 'text', 'Venue *', 'Venue', old('venue') ? old('venue') : $seminar->venue, $errors->has('venue'), $errors->first('venue'), ''
          ) !!}
        </div>
        <div class="row">
          {!! __form::datepicker(
            '6 date_covered_from', 'date_covered_from',  'Date From *', old('date_covered_from') ? old('date_covered_from') : __dataType::date_parse($seminar->date_covered_from), $errors->has('date_covered_from'), $errors->first('date_covered_from')
            ) !!}

          {!! __form::datepicker(
            '6 date_covered_to', 'date_covered_to',  'Date To *', old('date_covered_to') ? old('date_covered_to') : __dataType::date_parse($seminar->date_covered_to), $errors->has('date_covered_to'), $errors->first('date_covered_to')
            ) !!} 
        </div>
        <div class="row">
          <div class="col-md-12">
            <p class="page-header-sm text-info">
              Utilization
            </p>
          </div>
          @php
            $project_code = \App\Models\Projects::select(['project_code','activity'])->get();
          @endphp
          {!! __form::select_object_project_code(
            '6 project_code', 'project_code', 'Project Code', '', $project_code, $seminar->project_code ,''
          ) !!}


          {!! __form::textbox(
            '6 utilized_fund', 'utilized_fund', 'text', 'Utilized Fund *', 'Utilized Fund', $seminar->utilized_fund, '', '', '','autonum'
          ) !!}
        </div>
      </div> 
      <div class="col-md-5">
        {!! __form::file(
          '12', 'doc_file', 'e_doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
        ) !!}
      </div>
    </div>

    

    <div class="col-md-12" style="padding-top:30px;">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
            <div class="col-md-6">
              <p>
                <b>Add Speakers</b>
              </p>
            </div>
            <div class="col-md-6">
              <button id="add_row_edit" type="button" class="btn btn-xs {!! __static::bg_color(Auth::user()->color) !!} pull-right">Add Speaker &nbsp;<i class="fa fw fa-plus"></i></button>
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
            

              @foreach($seminar->seminarSpeaker as $key => $data)
              <tr>
                <td>
                  {!! __form::textbox_for_dt('row['. $key .'][spkr_fullname]', 'Fullname', $data->fullname, '') !!}
                </td>

                <td>
                  {!! __form::textbox_for_dt('row['. $key .'][spkr_topic]', 'Topic', $data->topic, '') !!}
                </td>
                <td>
                  <button type="button" class="btn btn-sm bg-red delete_row_edit"><i class="fa fa-times"></i></button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>


  </div>


  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} pull-right update_seminar_btn"> <i class="fa fa-fw fa-save"></i> Save</button>
  </div>
</form>     



<script type="text/javascript">
  {!! __js::pdf_upload(
    'e_doc_file', 'fa', route('dashboard.seminar.view_attendance_sheet', $seminar->slug)
  ) !!}
    autonum_settings = {
    currencySymbol : ' ₱',
    decimalCharacter : '.',
    digitGroupSeparator : ',',
  };

  $("#edit_seminar_form .autonum").each(function(){
    new AutoNumeric(this, autonum_settings);
  })

  $('#edit_seminar_form .select2').select2();
</script>
