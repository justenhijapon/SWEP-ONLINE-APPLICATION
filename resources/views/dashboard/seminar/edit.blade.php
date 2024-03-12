@php
    $rand = \Illuminate\Support\Str::random();
@endphp
<form id="edit_seminar_form_{{$rand}}" autocomplete="off">
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

          {!! \App\Core\Helpers\__form2::select('title',[
              'label' => 'Title:*',
              'cols' => 7,
              'options' => \App\Core\Helpers\Arrays::blockFarms()->toArray(),
          ],$seminar ?? null) !!}
          {!! \App\Core\Helpers\__form2::select('mill_district',[
              'label' => 'Mill District:',
              'cols' => 5,
              'options' => \App\Core\Helpers\Arrays::millDistricts(),
          ],$seminar ?? null) !!}


        </div>
        <div class="row">
          {!! \App\Core\Helpers\__form2::textbox('sponsor',[
              'label' => 'Sponsor:',
              'cols' => 6,
          ],$seminar ?? null) !!}

          {!! \App\Core\Helpers\__form2::textbox('venue',[
              'label' => 'Venue:',
              'cols' => 6,
          ],$seminar ?? null) !!}

        </div>
        <div class="row">
          {!! \App\Core\Helpers\__form2::textbox('date_covered_from',[
              'label' => 'Date from:',
              'cols' => 6,
              'type' => 'date',
          ],$seminar ?? null) !!}

          {!! \App\Core\Helpers\__form2::textbox('date_covered_to',[
              'label' => 'Date to:',
              'cols' => 6,
              'type' => 'date',
          ],$seminar ?? null) !!}

        </div>
        <div class="row">
          <div class="col-md-12">
            <p class="page-header-sm text-info">
              Utilization
            </p>
          </div>
        </div>

        <div class="row">
          {!! \App\Core\Helpers\__form2::select('block_farm',[
              'label' => 'Block Farm:',
              'cols' => 6,
              'options' => \App\Core\Helpers\Arrays::blockFarmsName(),
              'id' => 'block_farm',
          ],$seminar ?? null) !!}

          {!! \App\Core\Helpers\__form2::textbox('utilized_fund',[
              'label' => 'Utilized fund:',
              'cols' => 6,
              'class' => 'autonum',
          ],$seminar ?? null) !!}


        </div>

        <div class="row">
          {!! \App\Core\Helpers\__form2::select('project_code',[
              'label' => 'Project Code:',
              'cols' => 6,
              'options' => \App\Core\Helpers\Arrays::projectCodes(),
              'id' => 'project_code',
          ],$seminar ?? null) !!}
          {!! \App\Core\Helpers\__form2::textbox('item',[
              'label' => 'Item:',
              'cols' => 6,
          ],$seminar ?? null) !!}

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

  $("#edit_seminar_form_{{$rand}} .autonum").each(function(){
    new AutoNumeric(this, autonum_settings);
  })

  $('#edit_seminar_form_{{$rand}} .select2').select2();

  $("#edit_seminar_form_{{$rand}}").submit(function(e){
    let form = $(this);
    e.preventDefault();
    let uri = "{{ route('dashboard.seminar.update', 'slug') }}";
    uri = uri.replace('slug',id);
    let formData = new FormData(this);
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
      success: function(res){
        succeed(form,true,true);

        active = res.slug;
        seminars_table.draw(false);
        notify('Data successfully updated.','success');
      },
      error: function(res){
        errored(form,res);
      }
    })
  })
</script>
