
<?php
    if (isset($menu)) {
      $footer_menu_left = $menu->first(function ($item, $key) {
          return $item->menu_type == 'footer' && ($item->parent_id == null || $item->parent_id == 0);
      });
      $footer_menu_child_left = $menu->filter(function ($item, $key) use ($footer_menu_left) {
          return $item->parent_id == $footer_menu_left->id;
      });

      $footer_menu_right = $menu->last(function ($item, $key) {
          return $item->menu_type == 'footer' && ($item->parent_id == null || $item->parent_id == 0);
      });
      $footer_menu_child_right = $menu->filter(function ($item, $key) use ($footer_menu_right) {
          return $item->parent_id == $footer_menu_right->id;
      });
    
        // $menu_chil = $menu->filter(function ($item, $key) use ($footer_menu) {
        //     return $item->parent_id == $footer_menu->id;
        // });
    }
?>    

<div id="footer">
  <div class="container container-1160">
    <div class="row">
      <div class="col-lg-5 col-md-5 col-12">
        <div class="row">
          <?php $__currentLoopData = $footer_menu_child_left; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $title = isset($items->json_params->name->{$locale}) && $items->json_params->name->{$locale} != '' ? $items->json_params->name->{$locale} : $items->name;
                $footer_menu_child = $menu->filter(function ($item, $key) use ($items) {
                    return $item->parent_id == $items->id;
                });
            ?>
            <div class="col-lg-6 col-12">
              <div class="footer-title">
                <?php echo e($title); ?>

              </div>
              <div class="line"></div>
              <?php if(isset($footer_menu_child)): ?>
              <ul class="list-unstyled p-0 mb-0">
                <?php $__currentLoopData = $footer_menu_child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <a href="<?php echo e($item_child->url_link??'#'); ?>"><?php echo e($item_child->json_params->name->{$locale}??$item_child->name); ?></a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
              <?php endif; ?>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 logo-social">
        <div class="logo-footer text-center">
          <img class="img-fluid" src="<?php echo e($web_information->image->logo_footer ?? ''); ?>" alt="logo">
        </div>
        <div class="social d-flex justify-content-between">
          <a href="<?php echo e($web_information->social->facebook); ?>">
            <i class="fa-brands fa-facebook"></i>
          </a>
          <a href="<?php echo e($web_information->social->twitter); ?>">
            <i class="fa-brands fa-twitter"></i>
          </a>
          <a href="<?php echo e($web_information->social->instagram); ?>">
            <i class="fa-brands fa-instagram"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-5 col-md-5 col-12">
        <div class="row">
          <?php $__currentLoopData = $footer_menu_child_right; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $title = isset($items->json_params->name->{$locale}) && $items->json_params->name->{$locale} != '' ? $items->json_params->name->{$locale} : $items->name;
                $footer_menu_child = $menu->filter(function ($item, $key) use ($items) {
                    return $item->parent_id == $items->id;
                });
            ?>
            <div class="col-lg-6 col-12">
              <div class="footer-title">
                <?php echo e($title); ?>

              </div>
              <div class="line"></div>
              <?php if(isset($footer_menu_child)): ?>
              <ul class="list-unstyled p-0 mb-0">
                <?php $__currentLoopData = $footer_menu_child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <a href="<?php echo e($item_child->url_link??'#'); ?>"><?php echo e($item_child->json_params->name->{$locale}??$item_child->name); ?></a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
              <?php endif; ?>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="copyright text-center">
    <div class="line mx-auto"></div>
    <div class="copyright-title bold"><?php echo e($web_information->information->site_name); ?></div>
    <div class="address">
      Địa chỉ: <?php echo e($web_information->information->address); ?> 
    </div>
    <div class="phone">Điện thoại: <?php echo e($web_information->information->phone); ?>  - Email: <?php echo e($web_information->information->email); ?> </div>
    <div class="copyright-text">2023 © Copyright. All Right Reserved.</div>
  </div>
</div><?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/blocks/footer/styles/default.blade.php ENDPATH**/ ?>