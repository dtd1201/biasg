<?php if($block): ?>
<section id="banner-intro" class="position-relative">
    <img class="img-fluid w-100" src="<?php echo e($block->json_params->image->{$locale}??($block->image ?? '')); ?>" alt="<?php echo e($block->json_params->url_link_title->{$locale}??($block->url_link_title ?? '')); ?>">
    <div class="bottom d-flex align-items-center">
      <a href="/"><?php echo app('translator')->get('Home'); ?></a>
      <img class="mx-2" src="image/arrow.png" alt="arrow">
      <a href="<?php echo e($block->json_params->url_link->{$locale}??($block->url_link ?? '')); ?>" class="bold"><?php echo e($block->json_params->url_link_title->{$locale}??($block->url_link_title ?? '')); ?></a>
    </div>
</section>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/blocks/introduce/styles/default.blade.php ENDPATH**/ ?>