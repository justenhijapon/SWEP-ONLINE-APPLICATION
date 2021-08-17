<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo __html::check_img(Auth::user()->image); ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">

        <?php if(Auth::check()): ?>
          <p><?php echo e(Auth::user()->firstname); ?></p>
        <?php endif; ?>

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">

      <?php if(Auth::check()): ?>
        <?php if(count($global_menu_tree) > 0): ?>
          <li class="header">NAVIGATION</li>

            <li>
                <a href="<?php echo e(route('dashboard.home')); ?>">
                    <i class="fa fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
          <?php $__currentLoopData = $global_menu_tree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($user_menu['menu_obj']->is_dropdown == 0): ?>
              <li>
                <a href="">
                  <i class="fa <?php echo e($user_menu['menu_obj']->icon); ?>"></i>
                  <span><?php echo e($user_menu['menu_obj']->name); ?></span>
                </a>
              </li>
            <?php else: ?>
            <li class="treeview" style="height: auto;">
                <a href="#">
                    <i class="fa <?php echo e($user_menu['menu_obj']->icon); ?>"></i>
                    <span><?php echo e($user_menu['menu_obj']->name); ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <?php $__currentLoopData = $user_menu['submenus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route($submenu['submenu_obj']->route)); ?>"><i class="fa fa-circle-o"></i><?php echo e($submenu['submenu_obj']->nav_name); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>

            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      <?php endif; ?>

    </ul>
  </section>
</aside>

