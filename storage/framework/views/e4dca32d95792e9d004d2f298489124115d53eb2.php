<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title"> <b><i class="fa <?php echo e($menu->icon); ?>"></i> <?php echo e($menu->name); ?></b> | <?php echo e($menu->route); ?></h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<div class="row">
					<form id="add_submenu_form" data="<?php echo e($menu->slug); ?>" autocomplete="off">
						<?php echo csrf_field(); ?>
						<p class="page-header-sm text-center">Add submenu to <?php echo e($menu->name); ?> </p>
						<?php echo __form::textbox(
				            '3 name', 'name', 'text', 'Name: *', 'Name','', '', '', ''
				        ); ?>




				        <?php echo __form::textbox(
				            '4 route', 'route', 'text', 'Route: *', $menu->route.'.example','', '', '', ''
				        ); ?>


				        <?php echo __form::textbox(
				            '3 nav_name', 'nav_name', 'text', 'Nav name:', 'Nav name','', '', '', ''
				        ); ?>


				        <?php echo __form::select_static(
							'2 is_nav', 'is_nav', 'Is nav: *', '', [
							'No' => '0',
							'Yes' => '1',
							], '', '', '', ''
			            ); ?>


			            <div class="col-md-12">
			            	<button type="submit" class="btn <?php echo __static::bg_color(Auth::user()->color); ?> pull-right">
				            	<i class="fa fa-save"></i> Save
				            </button>
			            </div>
		            </form>
				</div>
			</div>
		</div>

	</div>
	<hr>
	<center>
		<label><?php echo e($menu->name); ?> Submenus</label>
	</center>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered submenu_table" style="width: 100% !important">
				<thead>
					<tr class="<?php echo __static::bg_color(Auth::user()->color); ?>">
						<th>Name</th>
						<th>Route</th>
						<th>Nav name</th>
						<th>Nav</th>
						<th style="width: 70px !important">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $menu->submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr id="<?php echo e($submenu->slug); ?>">
						<td><?php echo e($submenu->name); ?></td>
						<td><?php echo e($submenu->route); ?></td>
						<td><?php echo e($submenu->nav_name); ?></td>
						<td>
							<?php if($submenu->is_nav == 1): ?>
								<center><span class="bg-green badge"><i class="fa fa-check"></i></span></center>
							<?php else: ?>
								<center><span class="bg-red badge"><i class="fa fa-times"></i></span></center>
							<?php endif; ?>
						</td>
						<td>
						  <div class="btn-group">
			                  <button data="<?php echo e($submenu->slug); ?>" class="btn btn-sm btn-default edit_submenu_btn">
			                    <i class="fa fa-pencil-square-o"></i>
			                  </button>
			                  <button data="<?php echo e($submenu->slug); ?>" class="btn btn-sm btn-danger delete_submenu_btn">
			                    <i class="fa  fa-trash-o"></i>
			                  </button>
			                </div>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal-footer">
	<div class="row">
		<?php echo __html::timestamp($menu ,"4"); ?>

	    <div class="col-md-4">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>

	</div>

</div>