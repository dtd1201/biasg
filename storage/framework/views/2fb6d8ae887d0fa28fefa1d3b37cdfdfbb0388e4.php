<?php if($block): ?>
  <?php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $background = $block->image_background != '' ? $block->image_background : '';
    $image = $block->image != '' ? $block->image : '';
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $icon = $block->icon ?? '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    $params_block['parent_id'] = $block->id;
    $params_block['block_code'] = 'introduce';
    $params_block['status'] = App\Consts::STATUS['active'];
    $params_block['order_by'] = [
        'iorder' => 'ASC',
        'id' => 'DESC'
    ];
    // $block_childs = $blocks->filter(function ($item, $key) use ($block) {
    //     return $item->parent_id == $block->id;
    // });
    $block_childs = App\Http\Services\PageBuilderService::getBlockContent($params_block)
    ->get();
  ?>
  
  <section id="certificate">
    <div class="container container-1160" id="<?php echo e($block->id); ?>">
      <div class="title-heading d-flex align-items-center justify-content-center">
        <div class="line-middle"></div>
        <h2><?php echo e($title); ?></h2>
        <div class="line-middle"></div>
      </div>
      <?php if(isset($block_childs)): ?>
      <div class="swiper_cer">
        <div class="swiper-wrapper">
          <?php $__currentLoopData = $block_childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($item->parent_id == $block->id): ?>
              <?php
                $image = $item->json_params->image->{$locale} ?? $item->image;
                $title = $item->json_params->title->{$locale} ?? $item->title;
              ?>
              <div class="swiper-slide">
                <img class="img-fluid w-100" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
              </div>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="swiper-pagination"></div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
      <?php endif; ?>
    </div>
  </section>
  
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/blocks/introduce/styles/certificate.blade.php ENDPATH**/ ?>