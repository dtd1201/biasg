<?php if($block): ?>
  <?php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $background = $block->image_background != '' ? $block->image_background : '';
    $image = $block->image != '' ? $block->image : '';
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $icon = $block->icon ?? '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    
  ?>
  <section id="intro-organization">
    <div class="title-heading d-flex align-items-center justify-content-center" id="<?php echo e($block->id); ?>">
      <div class="line-middle"></div>
      <h2><?php echo e($title); ?></h2>
      <div class="line-middle"></div>
    </div>
    <div class="diagram-img text-center">
      <img class="img-fluid w-75" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
    </div>
  </section>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/blocks/introduce/styles/company-chart.blade.php ENDPATH**/ ?>