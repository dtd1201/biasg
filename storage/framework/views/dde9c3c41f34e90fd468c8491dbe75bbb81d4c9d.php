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
  <?php $__currentLoopData = $block_childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($item->parent_id == $block->id): ?>
      <?php
          $image = $item->json_params->image->{$locale} ?? $item->image;
          $title = $item->json_params->title->{$locale} ?? $item->title;
          $description = $item->json_params->description->{$locale} ?? $item->description;
      ?>
      <?php if($item->id % 2 != 0): ?>
        <section id="intro-vision">
          <div class="container-fluid px-0" id="<?php echo e($block->id); ?>"> 
            <div class="row w-100">
              <div class="col-lg-6 col-12">
                <div class="vision-img">
                  <img class="img-fluid w-100" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
                </div>
              </div>
              <div class="col-lg-6 col-12 pr-0">
                <div class="vision-detail">
                  <div class="title-heading d-flex align-items-center">
                    <div class="line-middle"></div>
                    <h2><?php echo e($title); ?></h2>
                    <div class="line-middle"></div>
                  </div>
                  <div class="desc">
                    <?php echo e($description); ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      <?php else: ?>
        <section id="intro-mission">
          <div class="container-fluid px-0">
            <div class="row w-100">
              <div class="col-lg-6 col-12">
                <div class="mission-detail">
                  <div class="title-heading d-flex align-items-center">
                    <div class="line-middle"></div>
                    <h2><?php echo e($title); ?></h2>
                    <div class="line-middle"></div>
                  </div>
                  <div class="desc">
                    <?php echo e($description); ?>

                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="mission-img">
                  <img class="img-fluid w-100" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
                </div>
              </div>
            </div>
          </div>
        </section>
      <?php endif; ?>
    <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/blocks/introduce/styles/vission-mission.blade.php ENDPATH**/ ?>