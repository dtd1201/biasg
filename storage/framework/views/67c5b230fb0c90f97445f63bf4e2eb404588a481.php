
<?php if($block): ?>

<?php
  // dd($block);
  $title = $block->json_params->title->{$locale} ?? $block->title;
  $description = $block->json_params->description->{$locale} ?? $block->description;
  $brief = $block->json_params->brief->{$locale} ?? $block->brief;
  $content = $block->json_params->content->{$locale} ?? $block->content;
  $background = $block->image_background != '' ? $block->image_background : url('assets/img/banner.jpg');
  $url_link = $block->url_link != '' ? $block->url_link : '';
  $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
  $params_block['parent_id'] = null;
  $params_block['block_code'] = 'introduce';
  $params_block['status'] = App\Consts::STATUS['active'];
  $params_block['order_by'] = [
      'iorder' => 'ASC',
      'id' => 'DESC'
  ];
  
  $list_block_introduce = App\Http\Services\PageBuilderService::getBlockContent($params_block)
    ->get();
  $params_block['parent_id'] = $block->id;
  $block_childs = App\Http\Services\PageBuilderService::getBlockContent($params_block)
    ->get();
?>
<div class="wrap-timeline" >
  <?php if(isset($list_block_introduce) && $list_block_introduce->count()>0): ?>
  <ul class="time-line list-unstyled container-1160 mx-auto d-flex justify-content-between">
    <?php $__currentLoopData = $list_block_introduce; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($loop->first): ?>
        <a href="#<?php echo e($item->id); ?>">
          <li class="link-scroll active" data-id="<?php echo e($item->id); ?>"><?php echo e($item->json_params->title->{$locale}??($item->title ?? '')); ?></li>
        </a>
      <?php else: ?>
        <a href="#<?php echo e($item->id); ?>">
          <li class="link-scroll" data-id="<?php echo e($item->id); ?>"><?php echo e($item->json_params->title->{$locale}??($item->title ?? '')); ?></li>
        </a>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
  <?php endif; ?>
</div>
<section id="intro-company">
  <div class="container container-1160" id="<?php echo e($block->id); ?>">
    <h2 class="title text-center">
      <?php echo e($title); ?>

      <div><?php echo e($description); ?> <span><?php echo e($brief); ?></span></div>
    </h2>
    <div class="desc text-center">
      <?php echo $content; ?>

    </div>
    
  </div>
</section>
<section id="intro-business">
  <div class="container container-1160" >
   
    <?php $__currentLoopData = $block_childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($item->parent_id == $block->id): ?>
        <?php
          $image = $item->json_params->image->{$locale} ?? $item->image;
          $title = $item->json_params->title->{$locale} ?? $item->title;
          $description = $item->json_params->description->{$locale} ?? $item->description;
          
          $params_block['block_code'] = 'introduce';
          $params_block['status'] = App\Consts::STATUS['active'];
          $params_block['order_by'] = [
              'iorder' => 'ASC',
              'id' => 'DESC'
          ];
          $params_block['parent_id'] = $item->id;
          
          $block_Childs = $block_childs->filter(function ($item_child, $key) use ($item) {
            return $item_child->parent_id == $item->id;
          });
          
        ?>
       
        <?php if($key % 2 != 0): ?>
          <div class="row align-items-center">
            <div class="col-lg-6 col-12">
              <div class="company-img">
                <img src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
              </div>
            </div>
            <?php if(isset($block_Childs)): ?>
            <div class="col-lg-6 col-12">
              <ul class="company-infor right list-unstyled p-0">
                <?php $__currentLoopData = $block_Childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <span class="bold"><?php echo e($item_child->json_params->title->{$locale} ?? $item_child->title); ?>: </span><?php echo e($item_child->json_params->description->{$locale} ?? $item_child->description); ?>

                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <?php echo e($description); ?>

                </li>
              </ul>
            </div>
            <?php endif; ?>
          </div>
        <?php else: ?>
          <div class="row align-items-center">
            <div class="col-lg-6 col-12">
              <?php if(isset($block_Childs)): ?>
              <ul class="company-infor list-unstyled p-0">
                <?php $__currentLoopData = $block_Childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <span class="bold"><?php echo e($item_child->json_params->title->{$locale} ?? $item_child->title); ?>: </span><?php echo e($item_child->json_params->description->{$locale} ?? $item_child->description); ?>

                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
              <?php endif; ?>
            </div>
            <div class="col-lg-6 col-12 bg-content">
              <div class="company-img">
                <img class="img-fluid w-100" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/blocks/introduce/styles/power-up.blade.php ENDPATH**/ ?>