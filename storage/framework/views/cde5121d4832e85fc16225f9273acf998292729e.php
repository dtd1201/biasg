

<?php
    if (isset($menu)) {
        $main_menu = $menu->first(function ($item, $key) {
            return $item->menu_type == 'header' && ($item->parent_id == null || $item->parent_id == 0);
        });
    
        $menu_chil = $menu->filter(function ($item, $key) use ($main_menu) {
            return $item->parent_id == $main_menu->id;
        });
    }
    
?>     

<div id="header">
  <div class="header-main">
    <div class="container container-header d-flex justify-content-between">
      <div class="d-flex">
        <a href="<?php echo e(route('frontend.home')); ?>" class="header-logo">
          <img class="img-fluid w-100 h-100" src="<?php echo e($web_information->image->logo_header ?? ''); ?>" alt="logo header">
        </a>
        <div class="header-infor bold text-uppercase">
          <?php echo e($web_information->information->site_name); ?>

          <div><?php echo e($web_information->information->seo_title); ?></div>
        </div>
      </div>
      <?php if(isset($menu_chil)): ?>
      <div class="header-wrap">
        <div class="header-contact d-flex justify-content-end">
          <img src="image/icon-search.png" alt="search">
          <?php $__currentLoopData = $menu_chil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($item->sub <= 0): ?>
              <?php if(isset($item->json_params->image) && $item->json_params->image != ''): ?>
              <a href="<?php echo e($item->url_link); ?>">
                <img class="flag-vn" src="<?php echo e($item->json_params->image); ?>" alt="<?php echo e($item->json_params->name->{$locale} ?? ($item->name ?? '')); ?>">
              </a>
              <?php endif; ?>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
        </div>
        <ul class="header-menu bold d-flex list-unstyled m-0">
          <?php $__currentLoopData = $menu_chil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($item->json_params->image) && $item->json_params->image != ''): ?>
            <?php else: ?>
              <li class="menu-item">
                <a href="<?php echo e($item->url_link); ?>" class="menu-link"><?php echo e($item->json_params->name->{$locale} ?? ($item->name ?? '')); ?></a>
              </li>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
      <?php endif; ?>
      <div class="icon-menu d-md-none">
        <i class="fa-solid fa-bars"></i>
      </div>
    </div>
  </div>
  <div class="overlay">
    <div class="close">
      <i class="fa-solid fa-circle-xmark"></i>
    </div>
  </div>
  <div class="menu-mobile">
    <div class="text-center mb-5">
      <a href="<?php echo e(route('frontend.home')); ?>" class="header-logo py-3">
        <img class="img-fluid w-50" src="<?php echo e($web_information->image->logo_header ?? ''); ?>" alt="logo header">
      </a>
    </div>
    <div class="search-mobile">
      <input type="text" name="search" placeholder="Tìm kiếm sản phẩm">
    </div>
    <?php if(isset($menu_chil)): ?>
    <ul class=" list-unstyled bold m-0 mt-3">
      <?php $__currentLoopData = $menu_chil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($item->json_params->image) && $item->json_params->image != ''): ?>
        <?php else: ?>
        <li class="menu-item py-3">
          <a href="<?php echo e($item->url_link); ?>" class="menu-link"><?php echo e($item->json_params->name->{$locale} ?? ($item->name ?? '')); ?></a>
        </li>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <?php endif; ?>
  </div>
</div>

<?php if(!Auth::guard('web')->check()): ?>
  <?php echo $__env->make('frontend.components.popup.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\honey\resources\views/frontend/blocks/header/styles/default.blade.php ENDPATH**/ ?>