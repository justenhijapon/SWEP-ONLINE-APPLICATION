<?php $__env->startSection('content'); ?>
	                                                                                                                                                                                                  
  <section class="content-header">
      <h1>Mill Districts</h1>
  </section>

  <section class="content">
    <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">List of Menus</h3>
              <div class="pull-right">
                 <button type="button" class="btn <?php echo __static::bg_color(Auth::user()->color); ?>" data-toggle="modal" data-target="#add_mill_district_modal" data-original-title="" title=""><i class="fa fa-plus"></i> Add new</button>
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
                      <label>Location:</label>
                      <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm filter_location filters">
                        <option value="">All</option>
                        <?php if(count($regions_array) > 0): ?>
                          <?php $__currentLoopData = $regions_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" ><?php echo e($key); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </select>
                    </div>
                    <div class="col-md-1 col-sm-2 col-lg-2">
                      <label>Region:</label>
                      
                      <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm filter_region filters">
                        <option value="">All</option>
                        <?php if(count($regions_array) > 0): ?>
                          <?php $__currentLoopData = $regions_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <optgroup label="<?php echo e($key); ?>">
                              <?php $__currentLoopData = $location; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($region); ?>"><?php echo e($region); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </select>
                    </div>
                    <div class="col-md-1 col-sm-2 col-lg-2">
                      <label>Group by:</label>
                      <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm group_by">
                        <option value="">None</option>
                        <option value="location">Location</option>
                        <option value="region">Region</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-body">
	             <div id="mill_district_table_container" style="display: none">
	                
	              
	                <table class="table table-bordered table-striped table-hover" id="mill_district_table" style="width: 100% !important; font-size: 14px">
	                  <thead>
	                    <tr class="<?php echo __static::bg_color(Auth::user()->color); ?>">
                        <th>Mill District</th>
	                      <th>Location</th>
	                      <th>Region</th>
	                      <th>Chairman</th>
	                      <th>Address</th>
	                      <th>Mill District Officer</th>
	                      <th>Phone</th>
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
	                <img style="width: 100px" src="<?php echo __static::loader(Auth::user()->color); ?>">
	            </center>
	        </div>
            <!-- /.box-body -->
          </div>
    </div>

  </section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('modals'); ?>

  <?php echo __html::modal_delete('seminar_delete'); ?>


  <!-- Add Seminar Modal -->
  <div class="modal fade" id="add_mill_district_modal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      	<form id="add_mill_district_form" autocomplete="off">
      		<?php echo csrf_field(); ?>
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span></button>
	          <h4 class="modal-title">Add Mill District</h4>
	        </div>
	        <div class="modal-body">
	        	<div class="row">
              <?php
                
                $locs = [];
                foreach ($regions_array as $key => $value) {
                  $locs[$key] = $key;
                }
            
              ?>
	        		<?php echo __form::select_static(
                      '12 location', 'location', 'Location *', old('is_menu'),$locs, $errors->has('is_menu'), $errors->first('is_menu'), '', ''
                    ); ?>


                    <?php echo __form::select_static(
                      '12 region', 'region', 'Region *', old('is_menu'), [
                      ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
                    ); ?>




	        		<?php echo __form::textbox(
                      '12 mill_district', 'mill_district', 'text', 'Mill District *', 'Mill District', old('title'), '', $errors->first('title'), 'style="text-transform: uppercase"'
                    ); ?>


                    <?php echo __form::textbox(
                      '12 chairman', 'chairman', 'text', 'Chairman *', 'Chairman', old('title'), '', $errors->first('title'), ''
                    ); ?>


                    <?php echo __form::textbox(
                      '12 address', 'address', 'text', 'Address *', 'Address', old('title'), '', $errors->first('title'), ''
                    ); ?>


                    <?php echo __form::textbox(
                      '12 mdo', 'mdo', 'text', 'Mill District Officer *', 'Mill District Officer', old('title'), '', $errors->first('title'), ''
                    ); ?>


                    <?php echo __form::textbox(
                      '12 phone', 'phone', 'text', 'Contact number *', 'Contact number', old('title'), '', $errors->first('title'), ''
                    ); ?>


	        	</div>
	        </div>
	        <div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          		<button type="submit" class="btn <?php echo __static::bg_color(Auth::user()->color); ?> add_block_farm_btn"><i class="fa fa-save"> </i> Save</button>
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
              <img style="width: 70px; margin: 40px 0;" src="<?php echo e(asset('images/loader.gif')); ?>">
            </center>
          </div>
        </div>
    </div>
  </div>

<?php echo __html::blank_modal('edit_mill_district_modal','sm'); ?>

<?php echo __html::blank_modal('show_mill_district_modal','xl'); ?>




<?php $__env->stopSection(); ?> 


<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
	function dt_draw(){
		mill_district_tbl.draw(false);
	}

  function filter_dt(){
    loc = $(".filter_location").val();
    region = $(".filter_region").val();

    mill_district_tbl.ajax.url(
      "<?php echo e(route('dashboard.mill_district.index')); ?>?location="+loc+"&region="+region).load();

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

	 active = '';

  $('#mill_district_table')
    .on('preXhr.dt', function ( e, settings, data ) {
        Pace.restart();
    } )

  modal_loader = $("#modal_loader").parent('div').html();
  //-----DATATABLES-----//
  //Initialize DataTable
  mill_district_tbl = $("#mill_district_table").DataTable({
    'dom' : 'lBfrtip',
    "processing": true,
    "serverSide": true,
    "ajax" : '<?php echo e(route("dashboard.mill_district.index")); ?>',
    "columns": [
        { "data": "mill_district" },
        { "data": "location" },
        { "data": "region" },
        { "data": "chairman" },
        { "data": "address" },
        { "data": "mdo" },
        { "data": "phone" },
        { "data": "action" }
    ],
    "buttons": [
        <?php echo __js::dt_buttons(); ?>

    ],
    "columnDefs":[
      {
        "targets" : 1,
        "visible" : false
      },
      {
        "targets" : 1,
        "class" : 'sex-th'
      },
      {
        "targets" : 7,
        "orderable" : false,
        "class" : 'action-120'
      },

      {
        "targets": 3, 
        // "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
      }
    ],
    "responsive": false,
    "initComplete": function( settings, json ) {
        $('#tbl_loader').fadeOut(function(){
          $("#mill_district_table_container").fadeIn();
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
         $("#mill_district_table #"+active).addClass('success');
      }
    },
    'rowGroup': {
        'dataSrc': 'location'
    },
    'order':[1,'asc']

  })

  $(".group_by").change(function(){
    c = $(this).val();
    p = $(this).parent('div');
    s = $(this).siblings('label');
    mill_district_tbl.rowGroup().dataSrc(c);

    if(c == 'region'){
      mill_district_tbl.column(2).visible(false);
      mill_district_tbl.column(1).visible(true);
      mill_district_tbl.order([2,'asc']).draw();
      p.addClass('has-success');
      s.addClass('text-green');
    }

    if(c == 'location'){
      mill_district_tbl.column(1).visible(false);
      mill_district_tbl.column(2).visible(true);
      mill_district_tbl.order([1,'asc']).draw();
      p.addClass('has-success');
      s.addClass('text-green');
    }

    if(c == ''){
      mill_district_tbl.rowGroup().dataSrc('');
      mill_district_tbl.column(1).visible(true);
      mill_district_tbl.column(2).visible(true);
      mill_district_tbl.order([0,'asc']).draw();
      p.removeClass('has-success');
      s.removeClass('text-green');
    }
  });


  //Search Bar Styling
  style_datatable('#mill_district_table');

  //Need to press enter to search
  $('#mill_district_table_filter input').unbind();
  $('#mill_district_table_filter input').bind('keyup', function (e) {
      if (e.keyCode == 13) {
          mill_district_tbl.search(this.value).draw();
      }
  });




  regions = <?php echo json_encode($regions_array); ?>;

  $(".filters").change(function(){
    filter_dt();
  });

	$.each(regions, function (a, item) {
		$("#add_mill_district_form #location").append('<option value="'+a+'">'+a+'</option>');
	});


  $("body").on("change","select[name='location']", function(){
    

    mod = $(this).parents('.modal-content');
    reg = $(mod).find("select[name='region']");
    reg.html('<option value="">Select</option>');
    chosen = $(this).val();
    
    $.each(regions[chosen], function(i , item){
      reg.append('<option value="'+item+'">'+item+'</option>');
    })

  })

	$("body").on('submit','#edit_mill_district_form', function(e){
		e.preventDefault();
	    id = $(this).attr('data');
	    form  = $(this);
	    loading_btn(form);
	    uri = "<?php echo e(route('dashboard.mill_district.update','slug')); ?>";
	    uri = uri.replace('slug',id);
      t = $(this);
	    $.ajax({
	      url: uri,
	      data: $(this).serialize(),
	      type: 'PUT',
	      dataType: 'json',
	      success: function(response){
	        succeed(form,true,true);
	        notify("Mill District successfully updated",'success');
	        active = response.slug
	        mill_district_tbl.draw(false);
          
	      },
	      error: function(response){
	        console.log(response);
	        errored(form,response);
	      }

	    })
	});



	$("#add_mill_district_form").submit(function(e){
		e.preventDefault();
		form = $(this);
		loading_btn(form);
		$.ajax({
			url: "<?php echo e(route('dashboard.mill_district.store')); ?>",
			data: $(this).serialize(),
			type: 'POST',
			success: function(response){
				succeed(form,true,false);
				notify("Mill District successfully added",'success');
				active = response.slug
	       mill_district_tbl.draw(false);
        $("#add_mill_district_form select[name='region']").html('<option value="">Select</option>');
			},
			error: function(response){
				errored(form,response)
			}
		});
	});

	$("body").on("click",".edit_mill_district_btn", function(){

		load_modal("#edit_mill_district_modal");
		uri = "<?php echo e(route('dashboard.mill_district.edit','slug')); ?>";
		uri = uri.replace('slug', $(this).attr('data'));
		$.ajax({
			url : uri,
			type: 'GET',
			success: function(response){
				populate_modal('#edit_mill_district_modal',response);
			},
			error: function(response){
				notify("Error: Check console.", 'danger');
				console.log(response)
			}
		});
	});

	$("body").on("click",".delete_mill_district_btn", function(){
    id = $(this).attr('data');
    confirm("<?php echo e(route('dashboard.mill_district.destroy', 'slug')); ?>", id);
  })

  $("body").on("click",".show_mill_district_btn", function(){
    id = $(this).attr('data');
    uri = "<?php echo e(route('dashboard.mill_district.show', 'slug')); ?>";
    uri = uri.replace('slug',id);
    load_modal("#show_mill_district_modal");
    $.ajax({
      url : uri,
      type : 'GET',
      success: function(response){
        populate_modal('#show_mill_district_modal',response);
      },
      error: function(response){
        notify("Error: check console.",'danger');
        console.log(response);
      }
    });
  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>