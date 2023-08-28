

<?php $__env->startSection('title'); ?>
  <?php echo e($module_name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo e($module_name); ?>

      <a class="btn btn-sm btn-warning pull-right" href="<?php echo e(route(Request::segment(2) . '.create')); ?>"><i
          class="fa fa-plus"></i> <?php echo app('translator')->get('Add'); ?></a>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php if(session('errorMessage')): ?>
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo e(session('errorMessage')); ?>

      </div>
    <?php endif; ?>
    <?php if(session('successMessage')): ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo e(session('successMessage')); ?>

      </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <p><?php echo e($error); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
    <?php endif; ?>

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo app('translator')->get('Create form'); ?></h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="<?php echo e(route(Request::segment(2) . '.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="box-body">
          <div class="col-md-6">

            <div class="form-group">
              <label>
                <?php echo app('translator')->get('Language name'); ?>:
              </label> <small class="text-red">*</small>
              <input type="text" class="form-control" name="lang_name" placeholder="<?php echo app('translator')->get('Language name'); ?>"
                value="<?php echo e(old('lang_name')); ?>" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>
                <?php echo app('translator')->get('Locale'); ?>:
              </label> <small class="text-red">*</small>
              <input type="text" class="form-control" name="lang_locale" placeholder="<?php echo app('translator')->get('Locale'); ?>"
                value="<?php echo e(old('lang_locale')); ?>" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>
                <?php echo app('translator')->get('Language code'); ?>:
              </label> <small class="text-red">*</small>
              <input type="text" class="form-control" name="lang_code" placeholder="<?php echo app('translator')->get('Language code'); ?>"
                value="<?php echo e(old('lang_code')); ?>" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label><?php echo app('translator')->get('iorder'); ?></label>
              <input type="number" class="form-control" name="iorder" placeholder="<?php echo app('translator')->get('iorder'); ?>"
                value="<?php echo e(old('iorder')); ?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group box_img_right">
              <label>
                <?php echo app('translator')->get('Flag image'); ?>:
              </label>
              <div id="image-holder" class="box_image <?php echo e(isset($detail->flag) ? 'active' : ''); ?>">
                <img class="img-width" src="<?php echo e($detail->flag ?? url('themes/admin/img/no_image.jpg')); ?>">
                <input id="flag" class="form-control hidden list_image" type="text" name="flag"
                  value="<?php echo e($detail->flag ?? ''); ?>">
                <span class="btn btn-sm btn-danger btn-remove" style="display: none"><i class="fa fa-trash"></i></span>
              </div>
              <span class="input-group-btn">
                <a data-input="flag" class="btn btn-primary lfm" data-type="cms-image">
                  <i class="fa fa-picture-o"></i> <?php echo app('translator')->get('choose'); ?>
                </a>
              </span>
            </div>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <a class="btn btn-success btn-sm" href="<?php echo e(route(Request::segment(2) . '.index')); ?>">
            <i class="fa fa-bars"></i> <?php echo app('translator')->get('List'); ?>
          </a>
          <button type="submit" class="btn btn-primary pull-right btn-sm"><i class="fa fa-floppy-o"></i>
            <?php echo app('translator')->get('Save'); ?></button>
        </div>
      </form>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
  <script>
    var no_image_link = '<?php echo e(url('themes/admin/img/no_image.jpg')); ?>';
    $(document).ready(function() {
      $('.list_image').on('change', function() {
        var img_path = $(this).val();
        $(this).parents('.box_image').addClass('active');
        $(this).parents('.box_image').find('img').attr('src', img_path);
      });
      $('.img-width, .btn-remove').on('mouseover', function(e) {
        $(this).parents('.active').find('.btn-remove').show();
      });
      $('.img-width, .btn-remove').on('mouseout', function(e) {
        $(this).parents('.active').find('.btn-remove').hide();
      });
      $('.box_image').on('click', '.btn-remove', function() {
        $(this).hide();
        let par = $(this).parents('.box_image');
        par.removeClass('active');
        par.find('img').attr('src', no_image_link);
        par.find('.list_image').val('');
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\honey\resources\views/admin/pages/languages/create.blade.php ENDPATH**/ ?>