
<form id="edit_seminar_form" autocomplete="off">
  <?php echo csrf_field(); ?> 
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

  
    <?php echo method_field('PUT'); ?>

    <div class="row">
      <div class="col-md-7">
        <div class="row">
          <?php echo __form::textbox(
            '7 title', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $seminar->title, $errors->has('title'), $errors->first('title'), ''
          ); ?>


           <?php echo __form::select_static(
            '5 mill_district', 'mill_district', 'Mill District: *', $seminar->mill_district , $mill_districts_list , '', '', '', ''
          ); ?>



        </div>
        <div class="row">
          <?php echo __form::textbox(
            '6 sponsor', 'sponsor', 'text', 'Sponsor', 'Sponsor', old('sponsor') ? old('sponsor') : $seminar->sponsor, $errors->has('sponsor'), $errors->first('sponsor'), ''
          ); ?>


          <?php echo __form::textbox(
            '6 venue', 'venue', 'text', 'Venue *', 'Venue', old('venue') ? old('venue') : $seminar->venue, $errors->has('venue'), $errors->first('venue'), ''
          ); ?>

        </div>
        <div class="row">
          <?php echo __form::datepicker(
            '6 date_covered_from', 'date_covered_from',  'Date From *', old('date_covered_from') ? old('date_covered_from') : __dataType::date_parse($seminar->date_covered_from), $errors->has('date_covered_from'), $errors->first('date_covered_from')
            ); ?>


          <?php echo __form::datepicker(
            '6 date_covered_to', 'date_covered_to',  'Date To *', old('date_covered_to') ? old('date_covered_to') : __dataType::date_parse($seminar->date_covered_to), $errors->has('date_covered_to'), $errors->first('date_covered_to')
            ); ?> 
        </div>

      </div> 
      <div class="col-md-5">
        <?php echo __form::file(
          '12', 'doc_file', 'e_doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
        ); ?>

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
              <button id="add_row_edit" type="button" class="btn btn-xs <?php echo __static::bg_color(Auth::user()->color); ?> pull-right">Add Speaker &nbsp;<i class="fa fw fa-plus"></i></button>
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
            

              <?php $__currentLoopData = $seminar->seminarSpeaker; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                  <?php echo __form::textbox_for_dt('row['. $key .'][spkr_fullname]', 'Fullname', $data->fullname, ''); ?>

                </td>

                <td>
                  <?php echo __form::textbox_for_dt('row['. $key .'][spkr_topic]', 'Topic', $data->topic, ''); ?>

                </td>
                <td>
                  <button type="button" class="btn btn-sm bg-red delete_row_edit"><i class="fa fa-times"></i></button>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


  </div>


  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn <?php echo __static::bg_color(Auth::user()->color); ?> pull-right update_seminar_btn"> <i class="fa fa-fw fa-save"></i> Save</button>
  </div>
</form>     



<script type="text/javascript">
  <?php echo __js::pdf_upload(
    'e_doc_file', 'fa', route('dashboard.seminar.view_attendance_sheet', $seminar->slug)
  ); ?>

</script>
