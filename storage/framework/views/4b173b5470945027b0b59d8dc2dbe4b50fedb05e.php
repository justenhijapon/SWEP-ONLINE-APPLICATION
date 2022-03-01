<?php echo $__env->yieldContent('form-open'); ?>
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">
      <?php echo $__env->yieldContent('title'); ?>
    </h4>
  </div>
  <div class="modal-body">
    <?php echo $__env->yieldContent('body'); ?>
  </div>
  <div class="modal-footer">
    <?php echo $__env->yieldContent('footer'); ?>
  </div>
</div>

<?php echo $__env->yieldContent('form-close'); ?>

<?php echo $__env->yieldContent('script'); ?>