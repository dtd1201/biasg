<?php $__env->startSection('title'); ?>
  <?php echo e($module_name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo e($module_name); ?>

      <a class="btn btn-sm btn-warning pull-right" href="<?php echo e(route(Request::segment(2) . '.create')); ?>"><i
          class="fa fa-plus"></i> <?php echo app('translator')->get('Add'); ?></a>
    </h1>
  </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
  <style>
    tr .set-language-default {
      display: none;
    }

    tr:hover .set-language-default {
      display: block;
    }
  </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

  <!-- Main content -->
  <section class="content">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"><?php echo app('translator')->get('Widget list'); ?></h3>
      </div>

      <div class="box-body table-responsive">
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
        <?php if(count($rows) == 0): ?>
          <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo app('translator')->get('No record found'); ?>
          </div>
        <?php else: ?>
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th><?php echo app('translator')->get('Name'); ?></th>
                <th><?php echo app('translator')->get('Locale'); ?></th>
                <th><?php echo app('translator')->get('Code'); ?></th>
                <th><?php echo app('translator')->get('Is default'); ?></th>
                <th><?php echo app('translator')->get('Order'); ?></th>
                <th><?php echo app('translator')->get('Updated at'); ?></th>
                <th><?php echo app('translator')->get('Status'); ?></th>
                <th><?php echo app('translator')->get('Action'); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <form action="<?php echo e(route(Request::segment(2) . '.destroy', $row->id)); ?>" method="POST"
                  onsubmit="return confirm('<?php echo app('translator')->get('confirm_action'); ?>')">
                  <tr class="valign-middle">
                    <td>
                      <a href="<?php echo e(route(Request::segment(2) . '.edit', $row->id)); ?>">
                        <strong style="font-size: 14px"><?php echo e($row->lang_name); ?></strong>
                      </a>
                    </td>
                    <td>
                      <?php echo e($row->lang_locale); ?>

                    </td>
                    <td>
                      <?php echo e($row->lang_code); ?>

                    </td>
                    <td>
                      <?php if(!$row->is_default): ?>
                        <a class="set-language-default" data-toggle="tooltip"
                          data-original-title="<?php echo e(__('Choose') . ' ' . $row->lang_name . ' ' . __('as default language')); ?>"
                          href="javascript:void(0);" style="font-size: 20px;" data-id="<?php echo e($row->id); ?>" data-name="<?php echo e($row->lang_name); ?>">
                          <i class="fa fa-star"></i>
                        </a>
                      <?php else: ?>
                        <i class="fa fa-star text-success" data-id="<?php echo e($row->id); ?>"
                          data-name="<?php echo e($row->lang_name); ?>" style="font-size: 20px;"></i>
                      <?php endif; ?>

                    </td>
                    <td>
                      <?php echo e($row->iorder); ?>

                    </td>
                    <td>
                      <?php echo e($row->updated_at); ?>

                    </td>
                    <td>
                      <?php echo app('translator')->get($row->status); ?>
                    </td>
                     <td>
                      <a class="btn btn-sm btn-warning" data-toggle="tooltip" title="<?php echo app('translator')->get('Update'); ?>"
                        data-original-title="<?php echo app('translator')->get('update'); ?>"
                        href="<?php echo e(route(Request::segment(2) . '.edit', $row->id)); ?>">
                        <i class="fa fa-pencil-square-o"></i>
                      </a>
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('DELETE'); ?>
                      <button class="btn btn-sm btn-danger" type="submit" data-toggle="tooltip"
                        title="<?php echo app('translator')->get('Delete'); ?>" data-original-title="<?php echo app('translator')->get('delete'); ?>">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </form>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>

      <?php if($rows->hasPages()): ?>
        <div class="box-footer clearfix">
          <?php echo e($rows->withQueryString()->links('pagination.default')); ?>

        </div>
      <?php endif; ?>

    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script>
    $('.set-language-default').click(function() {
      $('#loading').show();
      let _id = $(this).data('id');
      $.ajax({
          url: '<?php echo e(route('languages.set_default')); ?>',
          type: 'POST',
          data: {
            _token: '<?php echo e(csrf_token()); ?>',
            id: _id
          },
        })
        .done(function(data) {
          $('#loading').hide();
          if (data.error == 0) {
            location.reload();
          } else {
            alert(data.msg);
            location.reload();
          }
        });
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\honey\resources\views/admin/pages/languages/index.blade.php ENDPATH**/ ?>