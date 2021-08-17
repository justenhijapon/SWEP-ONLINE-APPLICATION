<?php $__env->startSection('content'); ?>

  <section class="content-header">
    <h1>Manage Users</h1>
  </section>

  <section class="content">
    

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Users</h3>
        <div class="pull-right">
          <button type="button" class="btn <?php echo __static::bg_color(Auth::user()->color); ?>" data-toggle="modal" data-target="#add_user_modal"><i class="fa fa-plus"></i> New User</button>
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
                <label>Status:</label>
                <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm filter_status filters">
                  <option value="">All</option>
                  <option value="online">Online</option>
                  <option value="offline">Offline</option>
                </select>
              </div>
              <div class="col-md-1 col-sm-2 col-lg-2">
                <label>Account Status:</label>
                <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm filter_account filters">
                  <option value="">All</option>
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>



      <div class="box-body">
        <div id="users_table_container" style="display: none">
          <table class="table table-bordered table-striped table-hover" id="users_table" style="width: 100% !important">
            <thead>
            <tr class="<?php echo __static::bg_color(Auth::user()->color); ?>">
              <th class="th-20">Username</th>
              <th >Full Name</th>
              <th class="th-10">Status</th>
              <th class="th-10">Account</th>
              <th class="action">Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <div id="tbl_loader">
          <center>
            <img style="width: 100px" src="<?php echo __static::loader(Auth::user()->color); ?>">
          </center>
        </div>

      </div>
    </div>




    </div>
  </section>



<?php $__env->stopSection(); ?>






<?php $__env->startSection('modals'); ?>
  <div id="add_user_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <form id="add_user_form" autocomplete="off">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">New User</h4>
          </div>
          <div class="modal-body">


            <div class="box-body">
              <?php echo csrf_field(); ?>

              <div class="row">
                <?php echo __form::textbox(
                  '4 firstname', 'firstname', 'text', 'Firstname *', 'Firstname', '', 'firstname', '', ''
                ); ?>


                <?php echo __form::textbox(
                  '4 middlename', 'middlename', 'text', 'Middlename *', 'Middlename', '', 'middlename', '', ''
                ); ?>


                <?php echo __form::textbox(
                  '4 lastname', 'lastname', 'text', 'Lastname *', 'Lastname', '', 'lastname', '', ''
                ); ?>


              </div>
              <div class="row">
                <?php echo __form::textbox(
                  '6 email', 'email', 'email', 'Email *', 'Email', '', 'email', '', ''
                ); ?>


                <?php echo __form::textbox(
                  '6 position', 'position', 'text', 'Position *', 'Position', '', 'position', '', ''
                ); ?>

              </div>

              <div class="row">
                <?php echo __form::textbox(
                    '4 username', 'username', 'text', 'Username *', 'Username', '', 'username', '', ''
                ); ?>


                <?php echo __form::textbox_password_btn(
                    '4 password', 'password', 'Password *', 'Password', '', 'password', '', ''
                ); ?>


                <?php echo __form::textbox_password_btn(
                    '4 password_confirmation', 'password_confirmation', 'Confirm Password *', 'Confirm Password', '', 'password_confirmation', '', ''
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
                                  <option value="<?php echo e($submenu->submenu_id); ?>">
                                    <?php echo e(str_replace($sub->name,'', $submenu->name)); ?>

                                  </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              </select>
                              <span class="help-block">No module selected</span>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              
              <div class="col-md-12" style="padding-top:50px;">
                <div class="box box-solid">


                  <div class="box-body no-padding">



                  </div>

                </div>
              </div>

            </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn <?php echo __static::bg_color(Auth::user()->color); ?> add_user_btn"><i class="fa fa-save fa-fw"></i> Save</button>
          </div>
        </form>
      </div>

    </div>
  </div>

  <?php echo __html::blank_modal('view_user_modal','lg'); ?>


  <?php echo __html::blank_modal('edit_user_modal','lg'); ?>


  <?php echo __html::blank_modal('reset_password_modal','sm'); ?>




<?php $__env->stopSection(); ?>






<?php $__env->startSection('scripts'); ?>
  <script type="text/javascript">
    function dt_draw(){
      users_table.draw(false);
    }


    function filter_dt(){
      is_online = $(".filter_status").val();
      is_active = $(".filter_account").val();
      users_table.ajax.url("<?php echo e(route('dashboard.user.index')); ?>"+"?is_online="+is_online+"&is_active="+is_active).load();

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

    modal_loader = $("#modal_loader").parent('div').html();
    active = '';
    slug = "";
    //-----DATATABLES-----//
    //Initialize DataTable
    $('#users_table')
            .on('preXhr.dt', function ( e, settings, data ) {
              Pace.restart();
            } )


    users_table = $("#users_table").DataTable({
      'dom' : 'lBfrtip',
      "processing": true,
      "serverSide": true,
      "ajax" : '<?php echo e(route("dashboard.user.index")); ?>',
      "columns": [
        { "data": "username" },
        { "data": "fullname" },
        { "data": "online" },
        { "data": "active" },
        { "data": "action" }
      ],
      buttons: [
        <?php echo __js::dt_buttons(); ?>

      ],
      "columnDefs":[
        {
          "targets" : 0,
          "orderable" : false,
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
        $('#tbl_loader').fadeOut(function(){
          $("#users_table_container").fadeIn();
        });
      },
      "language":
              {
                "processing": "<center><img style='width: 70px' src='<?php echo __static::loader(Auth::user()->color); ?>'></center>",
              },
      "drawCallback": function(settings){
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="modal"]').tooltip();
        if(active != ''){
          $("#users_table #"+active).addClass('success');
        }
      }
    })

    style_datatable("#users_table");

    //Need to press enter to search
    $('#users_table_filter input').unbind();
    $('#users_table_filter input').bind('keyup', function (e) {
      if (e.keyCode == 13) {
        users_table.search(this.value).draw();
      }
    });

    $(".filters").change(function(event) {
      filter_dt();
    });

    //Show/Hide Password
    <?php echo __js::show_hide_password(); ?>


    //Submit add user form
    $("#add_user_form").submit(function(e){
      e.preventDefault();
      form = $(this);
      uri = "<?php echo e(route('dashboard.user.store')); ?>";
      loading_btn(form);
      Pace.restart();
      $.ajax({
        url: uri,
        data: $(this).serialize(),
        type: 'POST',
        dataType: 'json',
        success: function(response) {
          users_table.draw(false);
          active = response.slug;
          succeed(form,true,false);
        },
        error: function (response) {
          errored(form,response);
        }
      })
    })

    //Upon changing the multiple select
    $("body").on("change", ".select_multiple", function(e){
      selected = $(":selected",this).length;
      all = $(this).children('option').length;

      if(selected == 0){
        $(this).siblings('.help-block').html('No module selected');
      }else{
        was_were = 'were';
        module_s = 'modules';
        if(selected <= 1){
          was_were = 'was';
        }
        if(all <= 1){
          module_s = 'module';
        }
        $(this).siblings('.help-block').html( selected + ' out of ' + all +' '+module_s+' '+was_were+' selected.');
      }

      percentage = selected/all*100;
      console.log(percentage);
      panel_body = $(this).parents('.panel-body');

      panel_body.find('.progress-bar').css('width',percentage+'%');
    })

    //Clearing selection of modules
    $("body").on('click', '.clear_btn', function() {
      select_element = $(this).parent('div').parent('div').siblings('.panel-body').find('.select_multiple');

      select_element.children('option').prop("selected",false);
      select_element.change();
    });

    //Show user button
    $("body").on('click', '.view_user_btn', function() {
      id = $(this).attr('data');
      $("#view_user_modal .modal-content").html(modal_loader);
      uri  =" <?php echo e(route('dashboard.user.show','slug')); ?>";
      uri = uri.replace('slug',id);
      Pace.restart();
      $.ajax({
        url: uri,
        type: 'GET',
        success: function (response) {
          console.log(response);
          $("#view_user_modal #modal_loader").fadeOut(function() {
            $("#view_user_modal .modal-content").html(response);
          });
        },
        error: function (response) {
          console.log(response);
        }
      })

    });

    //Edit user button
    $("body").on('click', '.edit_user_btn', function() {
      id = $(this).attr('data');
      $("#edit_user_modal .modal-content").html(modal_loader);
      uri = " <?php echo e(route('dashboard.user.edit', 'slug')); ?>";
      uri = uri.replace("slug",id);
      slug = id;
      Pace.restart();
      $.ajax({
        url: uri,
        type: 'GET',
        success: function(response){
          $("#edit_user_modal #modal_loader").fadeOut(function() {
            $("#edit_user_modal .modal-content").html(response);
            $(".select_multiple").each(function(index, el) {
              $(this).change();
            });
          });
        },
        error: function(response){
          console.log(response);
        }
      })

    });

    //Activate and Deactivate
    $("body").on('click', '.ac_dc', function() {
      status = $(this).attr("status");
      id = $(this).attr('data');
      ask = "deactivate";
      btn_class = 'btn-red';
      to_do = 'deactivate';
      type = 'red';
      if(status == "inactive"){
        ask = "activate";
        btn_class = 'btn-blue';
        to_do = 'activate';
        type = 'blue';
      }
      name = $(this).attr('name');
      $.confirm({
        title: 'Do you wish to '+ask+' this account?' ,
        content: name,
        animation: 'fade',
        type: type,
        typeAnimated: true,
        buttons: {
          cancel: function () {
          },
          somethingElse: {
            text: ask.toUpperCase(),
            btnClass: btn_class,
            keys: ['enter', 'shift'],
            action: function(){
              Pace.restart();
              uri = "<?php echo e(route('dashboard.user.activate','slug')); ?>";
              uri = uri.replace('slug',id);
              uri = uri.replace('activate',to_do);
              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              })

              $.ajax({
                url: uri,
                type: 'POST',
                dataType: 'json',
                success: function(response){
                  if(response.result==1){
                    notify('Account successfully activated',"success");
                    active = response.slug;
                    users_table.draw(false);
                  }
                  if(response.result==2){
                    notify('Account successfully deactivated',"warning");
                    active = response.slug;
                    users_table.draw(false);
                  }
                },
                error: function(response){
                  console.log(response);
                }
              })
            }
          }
        }
      });
    });


    $("body").on("submit",'#edit_user_form', function(e){
      e.preventDefault();
      id = $(this).attr('data');
      uri = " <?php echo e(route('dashboard.user.update', 'slug')); ?> ";
      uri = uri.replace("slug",id);
      form = $(this);
      loading_btn(form);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url : uri,
        type: 'PUT',
        dataType: 'json',
        data : $(this).serialize(),
        success: function(response){
          active = response.slug;
          users_table.draw(false);
          $("#edit_user_modal").modal('hide');
          notify("Changes were saved successfully.", "success");
          succeed(form, true,true);
        },
        error: function(response){
          console.log(response);
          errored(form,response);
        }
      })
    })

    $("body").on("click",".reset_password_btn", function(){
      id = $(this).attr('data');
      $("#reset_password_modal .modal-content").html(modal_loader);
      uri = " <?php echo e(route('dashboard.user.reset_password', 'slug')); ?> ";
      uri = uri.replace("slug",id);
      $.ajax({
        url: uri,
        type: 'GET',
        success: function(response){
          $("#reset_password_modal #modal_loader").fadeOut(function() {
            $("#reset_password_modal .modal-content").html(response);
          });
        },
        error: function(response){
          console.log(response);
        }

      })
    })

    $("body").on("submit", "#reset_password_form", function(e){
      e.preventDefault();
      id = $(this).attr("data");
      uri = " <?php echo e(route('dashboard.user.reset_password_post', 'slug')); ?> ";
      uri = uri.replace("slug",id);
      wait_button("#reset_password_form");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        url: uri,
        data: $(this).serialize(),
        type: 'PATCH',
        dataType: 'json',
        success: function(response){

          console.log(response);
          $("#reset_password_form .has-error").each(function(){
            $(this).removeClass("has-error");
            $(this).children("span").remove();
          });
          if(response.result == -1){
            $("#reset_password_form ."+response.target).addClass('has-error');
            $("#reset_password_form ."+response.target).append('<span class="help-block">'+response.message+'</span>');
          }
          if(response.result == 0){
            notify(response.message,'warning');
          }
          if(response.result == 1){
            notify("Account successfully updated.",'success');
            $("#reset_password_modal").modal("hide");
            active = response.slug;
            users_table.draw(false);
          }
        },
        error: function(response){
          console.log(response);
          errored("#reset_password_form","save",response);
        }
      })
    })

    $("body").on("change", ".change_pass_chk", function(){
      prop = $(this).prop("checked");
      if(prop == true){
        $(".password_container input").each(function(index, el) {
          $(this).removeAttr('disabled');
        });
        $(".password_container .password input").attr("name","password");
        $(".password_container .password_confirmation input").attr("name","password_confirmation");
      }else{
        $(".password_container input").each(function(index, el) {
          $(this).attr('disabled','disabled');
          $(this).removeAttr('name');
        });
      }
    });

    $("body").on("click", ".delete_user_btn", function(){
      id = $(this).attr('data');
      confirm("<?php echo e(route('dashboard.user.destroy', 'slug')); ?>",id);
    })
  </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>