<form id="edit_user_form" data="<?php echo e($user->slug); ?>">

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><?php echo e($user->lastname); ?>, <?php echo e($user->firstname); ?></h4>
  </div>
  <div class="modal-body">
   <?php
      $this_user_has = [];
      foreach ($user->userSubmenu as $menu) {
          array_push($this_user_has, $menu->submenu_id);
       
      }
      //print_r($this_user_has);
      $this_user_has = collect($this_user_has);

    ?>

    <div class="box-body">                  
      

      <div class="row">
          <?php echo __form::textbox(
            '4 firstname', 'firstname', 'text', 'Firstname *', 'Firstname', $user->firstname, 'e_firstname', '', ''
          ); ?>


          <?php echo __form::textbox(
            '4 middlename', 'middlename', 'text', 'Middlename *', 'Middlename',  $user->middlename, 'e_middlename', '', ''
          ); ?>


          <?php echo __form::textbox(
            '4 lastname', 'lastname', 'text', 'Lastname *', 'Lastname',  $user->lastname, 'e_lastname', '', ''
          ); ?>


      </div>

      <div class="row">
          <?php echo __form::textbox(
            '6 email', 'email', 'email', 'Email *', 'Email', $user->email, 'e_email', '', ''
          ); ?>


          <?php echo __form::textbox(
            '6 position', 'position', 'text', 'Position *', 'Position',  $user->position, 'e_position', '', ''
          ); ?>

      </div>



      <div class="row">
        <div class="col-sm-12">
          <h4>User Menu 
            <span class="pull-right ">
              <small class="text-info">You can use CTRL & SHIFT keys for multiple selection. CTRL+A to select all.</small>
            </span>
           </h4>
          <hr style="margin: 0 0 10px 0">
        </div>

        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <i class="fa <?php echo e($sub->icon); ?>"></i>
              <?php echo e($sub->name); ?>

              <div class="pull-right">
                <button class="btn btn-xs btn-default clear_btn" type="button">Clear</button>
              </div>
            </div>
            <div class="panel-body" style="min-height: 180px">
              <div class="row">
                <div class="col-sm-12">
                  <?php if($sub->submenu->isEmpty()): ?>
                  <center>
                    <label>No submenu found for this Menu</label>
                  </center>
                    
                  <?php else: ?>
                    <select multiple name="submenus[]" class="form-control select_multiple" size="6">
                          <?php $__currentLoopData = $sub->submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($submenu->submenu_id); ?>".
                            <?php if($this_user_has->contains($submenu->submenu_id)): ?>
                              selected="" 
                            <?php endif; ?>
                            >
                            <?php echo e(str_replace($sub->name,'', $submenu->name)); ?>

                          </option>                            
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                               
                      
                    </select>
                    <span class="help-block">No module selected</span>
                  <?php endif; ?>
                </div>
              </div>
              <?php if($sub->submenu->isNotEmpty()): ?>
                <div class="progress xs" >
                  <div class="progress-bar <?php echo e(__static::bg_color(Auth::user()->color)); ?>" style="width: 0%;" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    <button type="submit" class="btn <?php echo __static::bg_color(Auth::user()->color); ?> update_user_btn"><i class="fa fa-save fa-fw"></i> Save</button>
  </div>
</form>