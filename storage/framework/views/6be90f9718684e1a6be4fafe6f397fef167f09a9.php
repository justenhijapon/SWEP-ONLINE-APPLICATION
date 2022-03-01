<form id="edit_participant_form" data="<?php echo e($participant->slug); ?>" autocomplete="on">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><?php echo e($participant->fullname); ?> - Edit</h4>
  </div>
  <div class="modal-body">

  <?php echo csrf_field(); ?>
    <div class="row">
      <?php echo __form::textbox(
       '5 fullname', 'fullname', 'text', 'Fullname *', 'Fullname', $participant->fullname, $errors->has('fullname'), $errors->first('fullname'), ''
       ); ?>


      <?php echo __form::textbox(
       '4 occupation', 'occupation', 'text', 'Occupation', 'Occupation', $participant->occupation, $errors->has('occupation'), $errors->first('occupation'), ''
       ); ?>


      <?php echo __form::textbox(
       '3 age', 'age', 'number', 'Age *', 'Age', $participant->age, $errors->has('age'), $errors->first('age'), ''
       ); ?>



      <?php echo __form::select_static(
        '4 civil_status', 'civil_status', 'Civil Status ', $participant->civil_status, [
          'Single' => 'Single',
          'Married' => 'Married',
          'Divorced' => 'Divorced',
          'Separated' => 'Separated',
          'Widowed' => 'Widowed'               
        ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
        ); ?>



      <?php echo __form::select_static(
        '5 educ_att', 'educ_att', 'Educational Attainment', $participant->educ_att, [
          'Elementary' => 'Elementary', 
          'High School' => 'High School', 
          'College' => 'College',
          'None' => 'None'

        ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
        ); ?>




      <?php echo __form::textbox(
       '3 no_children', 'no_children', 'number', 'No. of Children', 'No. of Children', $participant->no_children, $errors->has('no_children'), $errors->first('no_children'), ''
       ); ?> 

       <?php echo __form::select_static(
        '3 sex', 'sex', 'Sex *', $participant->sex, ['MALE' => 'MALE', 'FEMALE' => 'FEMALE'], $errors->has('sex'), $errors->first('sex'), '', ''
        ); ?>

        
      <?php echo __form::textbox(
       '4 contact_no', 'contact_no', 'text', 'Contact No.', 'Contact No.', $participant->contact_no, $errors->has('contact_no'), $errors->first('contact_no'), ''
       ); ?>


    </div>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="-1">Close</button>
    <button type="submit" class="btn <?php echo __static::bg_color(Auth::user()->color); ?> "> <i class="fa fa-save"></i> Save</button>
  </div>
</form>
 