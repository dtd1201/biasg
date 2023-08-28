<?php if($block): ?>
  <?php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $description = $block->json_params->description->{$locale} ?? $block->description;
    $background = $block->image_background != '' ? $block->image_background : '';
    $image = $block->image != '' ? $block->image : '';
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $icon = $block->icon ?? '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
  ?>
  <section id="technology">
    <div class="container container-1160" id="<?php echo e($block->id); ?>">
      <div class="title-heading d-flex align-items-center justify-content-center">
        <div class="line-middle"></div>
        <h2><?php echo e($title); ?></h2>
        <div class="line-middle"></div>
      </div>
      <div class="technology-img">
        <img class="img-fluid w-100 h-100" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
      </div>
      <div class="desc">
        <?php echo e($description); ?>

      </div>
    </div>
  </section>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/blocks/introduce/styles/technology.blade.php ENDPATH**/ ?>