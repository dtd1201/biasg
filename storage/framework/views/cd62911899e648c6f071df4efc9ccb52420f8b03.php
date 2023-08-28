<?php if($block): ?>
    <?php
        $title = $block->json_params->title->{$locale} ?? $block->title;
        $description = $block->json_params->description->{$locale} ?? $block->description;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        
        $params['status'] = App\Consts::TAXONOMY_STATUS['active'];
        $params['taxonomy'] = App\Consts::TAXONOMY['product'];
        // $params['is_featured'] = true;
        $params['is_type'] = App\Consts::TAXONOMY['product'];
        
        $taxonomys = App\Http\Services\ContentService::getCmsTaxonomy($params)->get();
        foreach($taxonomys as $item){
          if($item->alias == $block->url_link){
            $main_taxonomy = $item;
          }
        }
        $params['taxonomy_id'] = $main_taxonomy->id;
        $rows = App\Http\Services\ContentService::getCmsPost($params)
            ->get();
        
    ?>
  <?php if(isset($main_taxonomy)): ?>
    <?php
        $i = 1;
    ?>
    
    <section id="product">
        <div class="container container-1160">
          <div class="section-title">
            <?php echo e($brief); ?>

            <div><?php echo e($description); ?> <span><?php echo e($title); ?></span></div>
          </div>
          <div class="tab-heading d-flex justify-content-center">
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
                <?php if($loop->first): ?>
                <div class="tab-item active" data-id="<?php echo e($i++); ?>">
                  <img class="img-fluid" src="<?php echo e($row->json_params->image->{$locale}??($row->image_thumb ?? '')); ?>" alt="<?php echo e($row->json_params->image->{$locale}??($row->image_thumb ?? '')); ?>">
                </div>
                <?php else: ?>
                <div class="tab-item" data-id="<?php echo e($i++); ?>">
                  <img class="img-fluid" src="<?php echo e($row->json_params->image->{$locale}??($row->image_thumb ?? '')); ?>" alt="<?php echo e($row->json_params->image->{$locale}??($row->image_thumb ?? '')); ?>">
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <div class="tab-content">
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $category = App\Models\CmsTaxonomy::where('id', $row->taxonomy_id)->first();
                $alias_child = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $row->alias ?? $title, $row->id, 'detail', $category->title);
              ?>
                <?php if($loop->first): ?>
                <div class="tab-detail active">
                  <div class="row">
                    <div class="col-lg-6 col-12 bg-content">
                      <img class="img-fluid w-100" src="<?php echo e($row->json_params->image->{$locale}??($row->image ?? '')); ?>" alt="<?php echo e($row->json_params->title->{$locale}??($row->image ?? '')); ?>">
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="detail-content">
                        <div class="detail-img">
                          <img src="<?php echo e($row->json_params->image_logo->{$locale}??($row->image_logo ?? '')); ?>" alt="<?php echo e($row->json_params->title->{$locale}??($row->image ?? '')); ?>">
                        </div>
                        <div class="detail-title">
                          "<?php echo e($row->json_params->description->{$locale}??($row->description ?? '')); ?>"
                        </div>
                        <div class="desc">
                          <?php echo e($row->json_params->brief->{$locale}??($row->brief ?? '')); ?>

                        </div>
                        
                        <a href="<?php echo e($alias_child); ?>" class="btn btn-more"><?php echo e($block->json_params->url_link_title->{$locale}??($block->url_link_title ?? '')); ?></a>
                      </div>
                    </div>
                  </div>
                </div>
                <?php else: ?>
                <div class="tab-detail">
                  <div class="row">
                    <div class="col-lg-6 col-12 bg-content">
                      <img class="img-fluid w-100" src="<?php echo e($row->json_params->image->{$locale}??($row->image ?? '')); ?>" alt="<?php echo e($row->json_params->title->{$locale}??($row->image ?? '')); ?>">
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="detail-content">
                        <div class="detail-img">
                          <img src="<?php echo e($row->json_params->image->{$locale}??($row->image_logo ?? '')); ?>" alt="<?php echo e($row->json_params->title->{$locale}??($row->image ?? '')); ?>">
                        </div>
                        <div class="detail-title">
                          "<?php echo e($row->json_params->description->{$locale}??($row->description ?? '')); ?>"
                        </div>
                        <div class="desc">
                          <?php echo e($row->json_params->brief->{$locale}??($row->brief ?? '')); ?>

                        </div>
                        <a href="<?php echo e($alias_child); ?>" class="btn btn-more"><?php echo e($block->json_params->url_link_title->{$locale}??($block->url_link_title ?? '')); ?></a>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
    </section>
  <?php endif; ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/blocks/custom/styles/product.blade.php ENDPATH**/ ?>