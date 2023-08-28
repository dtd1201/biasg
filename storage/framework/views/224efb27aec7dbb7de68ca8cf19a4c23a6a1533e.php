

<?php
  $url = URL::to('/');
  $page_title = $taxonomy->title ?? ($page->title ?? ($page->name ?? ''));
  $image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');
?>


<?php $__env->startSection('content'); ?>
  
  

  

  
  <div id="contact">
    <div class="contact-banner position-relative">
      <img class="img-fluid w-100" src="<?php echo e($image_background); ?>" alt="banner contact">
      <div class="bottom d-flex align-items-center">
        <a href="/"><?php echo app('translator')->get('Home'); ?></a>
        <img class="mx-2" src="image/arrow.png" alt="arrow">
        <a href="" class="bold"><?php echo e($page_title); ?></a>
      </div>
    </div>
    
    <div class="container container-1160 mb-5">
      <div class="title"><?php echo e($web_information->information->site_name); ?></div>
      <p class="contact-more">Mọi thông tin chi tiết xin vui lòng liên hệ</p>
      <div class="row form-contact">
        <div class="col-lg-6 col-12">
          <form class="mb-0 form_ajax" method="post" action="<?php echo e(route('frontend.contact.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
              <input type="text" class=" required form-control" name="name"  placeholder="<?php echo app('translator')->get('Fullname'); ?> *" required>
            </div>
            <div class="form-group">
              <input type="email" pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$" class="required form-control" name="email"  placeholder="Email *" required>
            </div>
            <div class="form-group">
              <input type="text" class="required form-control" name="json_params[address]"  placeholder="<?php echo app('translator')->get('Address'); ?> *" required>
            </div>
            <div class="form-group">
              <input type="tel" pattern="^[0-9\-\+]{9,15}$" class="required form-control" name="phone"  placeholder="<?php echo app('translator')->get('phone'); ?> *" required>
            </div>
            
            <textarea name="content" id="" rows="7" class="w-100" placeholder="<?php echo app('translator')->get('Content'); ?>"></textarea>
            <input type="hidden" name="is_type" value="contact">
            <button type="submit" class="btn btn-submit w-100">Gửi</button>
          </form>
        </div>
        <div class="col-lg-6 col-12">
          <ul class="contact-infor p-0">
            
            <li class="d-flex align-items-center">
              <img src="image/web.png" alt="fax">
              <?php echo e($url); ?>

            </li>
            <li class="d-flex align-items-center">
              <img src="image/phone.png" alt="fax">
              <?php echo e($web_information->information->phone); ?>

            </li>
            <li class="d-flex align-items-center">
              <img src="image/email.png" alt="fax">
              <?php echo e($web_information->information->email); ?>

            </li>
            <li class="d-flex align-items-center">
              <img src="image/address.png" alt="fax">
              <?php echo e($web_information->information->address); ?>

            </li>
          </ul>
        </div>
      </div>
      <div class="map">
        <?php echo $web_information->source_code->map; ?>

      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/pages/contact/index.blade.php ENDPATH**/ ?>