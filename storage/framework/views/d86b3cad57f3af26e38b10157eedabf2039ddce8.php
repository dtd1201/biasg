<?php if($block): ?>
  <?php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $background = $block->image_background != '' ? $block->image_background : '';
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $icon = $block->icon ?? '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    
    $block_childs = $blocks->filter(function ($item, $key) use ($block) {
        return $item->parent_id == $block->id;
    });
  ?>

  <section id="shareholder" style="background-image: url(<?php echo e(asset($background)); ?>)">
    <div class="container">
      <div class="title"><?php echo e($title); ?></div>
      <?php if(isset($block_childs)): ?>
      <ul class="p-0">
        <?php $__currentLoopData = $block_childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <li>
          <div class="wrap-img">
            <img src="<?php echo e($item->json_params->image??($item->image ?? '')); ?>" alt="<?php echo e($item->json_params->title->{$locale}??($item->title ?? '')); ?>">
          </div>
          <div class="shareholder-title">
            <span><?php echo e($item->json_params->title->{$locale}??($item->title ?? '')); ?></span>
          </div>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/blocks/custom/styles/for-shareholders.blade.php ENDPATH**/ ?>