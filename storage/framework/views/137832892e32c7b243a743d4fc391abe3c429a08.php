

<?php
$page_title = $taxonomy->title ?? ($page->title ?? ($page->name ?? ''));
$image_background = $web_information->image->background_breadcrumbs ?? ($taxonomy->json_params->image_background ?? '');
$data = session('cart');
?>

<?php $__env->startSection('content'); ?>
  

  <section id="page-title" style="background-image: url('<?php echo e($image_background); ?>'); background-size: cover;"
    data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">
    <div id="particles-line"></div>
    <div class="container clearfix">
      <h1 class="text-center"><?php echo e($page_title); ?></h1>
    </div>
  </section>

  <section id="content">
    <div class="content-wrap">
      <div class="container py-5">
        <?php if(session('cart')): ?>
          <?php echo $__env->make('frontend.components.cart.cart-components',[
          ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          
          <div class="row col-mb-30">
            <div class="col-lg-12">
              <h4 class="text-uppercase mb-4"><?php echo app('translator')->get('Submit Order Cart'); ?></h4>
              <form class="row" method="POST" action="<?php echo e(route('frontend.order.store.product')); ?>">
                <?php echo csrf_field(); ?>
                <div class="col-md-4 form-group">
                  <label for="name"><?php echo app('translator')->get('Fullname'); ?> <small class="text-danger">*</small></label>
                  <input type="text" class="sm-form-control" placeholder="<?php echo app('translator')->get('Fullname'); ?> *" id="name"
                    name="name" required value="<?php echo e($user_auth->name ?? old('name')); ?>" />
                </div>
                <div class="col-md-4 form-group">
                  <label for="email"><?php echo app('translator')->get('Email'); ?></label>
                  <input type="email" class="sm-form-control" placeholder="<?php echo app('translator')->get('Email'); ?>" id="email"
                    name="email" value="<?php echo e($user_auth->email ?? old('email')); ?>" />
                </div>
                <div class="col-md-4 form-group">
                  <label for="phone"><?php echo app('translator')->get('Phone'); ?> <small class="text-danger">*</small></label>
                  <input type="text" class="sm-form-control" placeholder="<?php echo app('translator')->get('Phone'); ?> *" id="phone"
                    name="phone" required value="<?php echo e($user_auth->phone ?? old('phone')); ?>" />
                </div>
                <div class="col-md-4 form-group mt-4">
                  <label for="affiliate_code"><?php echo app('translator')->get('Affiliate code'); ?></label>
                  <input type="text" id="affiliate_code" name="affiliate_code"
                    value="<?php echo e($user_auth->affiliate_code ?? old('affiliate_code')); ?>" class="sm-form-control"
                    placeholder="<?php echo app('translator')->get('Affiliate code'); ?>" />
                </div>
                <div class="col-md-8 form-group mt-4">
                  <label for="address"><?php echo app('translator')->get('Address'); ?></label>
                  <input type="text" class="sm-form-control" placeholder="<?php echo app('translator')->get('Address'); ?>" id="address"
                    name="address" value="<?php echo e(old('address')); ?>" />
                </div>

                <div class="col-md-12 form-group mt-4">
                  <label for="customer_note"><?php echo app('translator')->get('Content note'); ?></label>
                  <textarea id="customer_note" name="customer_note" rows="5" cols="30"
                    placeholder="<?php echo app('translator')->get('Content note'); ?>" autocomplete="off"><?php echo e(old('customer_note')); ?></textarea>
                </div>
                <div class="col-12 form-group">
                  <button type="submit" class="button btn-update mt-5"><?php echo app('translator')->get('Submit Order'); ?></button>
                </div>
              </form>
            </div>
          </div>
        <?php else: ?>
          <div class="row">
            <div class="col-lg-12">
              <div class="style-msg alertmsg">
                <div class="sb-msg">
                  <i class="icon-warning-sign"></i>
                  <strong><?php echo app('translator')->get('Warning!'); ?></strong>
                  <?php echo app('translator')->get('Cart is empty!'); ?>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\honey\resources\views/frontend/pages/cart/index.blade.php ENDPATH**/ ?>