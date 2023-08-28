

<?php
  $page_title = $taxonomy->title ?? ($page->title ?? $page->name);
  $image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');
  
  $title = $taxonomy->json_params->title->{$locale} ?? ($taxonomy->title ?? null);
  $title_parent = $taxonomy->parent->json_params->title->{$locale} ?? ($taxonomy->title ?? null);
  // $alias_parent = App\Helpers::generateRoute(App\Consts::TAXONOMY['service'], $taxonomy->parent->alias ?? $taxonomy->parent->json_params->title->{$locale}, $taxonomy->parent_id);
  $image = $taxonomy->json_params->image ?? null;
  $seo_title = $taxonomy->json_params->seo_title ?? $title;
  $seo_keyword = $taxonomy->json_params->seo_keyword ?? null;
  $seo_description = $taxonomy->json_params->seo_description ?? null;
  $seo_image = $image ?? null;

  $params_taxonomy['status'] = App\Consts::STATUS['active'];
  $params_taxonomy['taxonomy'] = App\Consts::TAXONOMY['service'];
  $params_taxonomy['order_by'] = 'iorder';
  $params_taxonomy['parent_id'] = $taxonomy->id;
  $row = App\Http\Services\ContentService::getCmsTaxonomy($params_taxonomy)
      ->get();
?>

<?php $__env->startSection('content'); ?>
  
  
  
  <div id="content">
    <?php if($taxonomy->parent_id==null): ?>
      <?php if(isset($row)): ?>
      <section id="banner-shareholder" class="position-relative">
        <img class="img-fluid w-100" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
        <div class="bottom d-flex align-items-center">
          <a href="<?php echo e(route('frontend.home')); ?>"><?php echo app('translator')->get('home'); ?></a>
          <img class="mx-2" src="image/arrow.png" alt="arrow">
          <a href="#" class="bold"><?php echo e($title); ?></a>
        </div>
      </section>
      <section id="shareholder-list">
        <div class="container container-1160">
          <div class="row">
            <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $title = $item->json_params->title->{$locale} ?? $item->title;
                $description = $item->json_params->description->{$locale} ?? $item->description;
                $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                // Viet ham xu ly lay slug

                $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['service'], $item->alias ?? $item->title, $item->id);
                // $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['service'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
                $poster = App\Models\Admin::where('status', 'active')->where('id', $item->admin_created_id)->first()->name;
              ?>
              <div class="col-lg-6 col-12">
                <div class="shareholder-item">
                  <div class="new-item">
                    <div class="new-border">
                      <div class="sub-border"></div>
                      <div class="main-border"></div>
                    </div>
                    <div class="new-title text-uppercase">New</div>
                  </div>
                  <h3 class="title"><?php echo e($title); ?></h3>
                  <p class="desc">
                    <?php echo e($description); ?>

                  </p>
                  <a href="<?php echo e($alias_category); ?>" class="btn btn-more"><?php echo app('translator')->get('View detail'); ?></a>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </section>
      <?php endif; ?>
    <?php else: ?>
    
      <?php if(isset($row)): ?>
      <section id="banner-shareholder" class="position-relative">
        <img class="img-fluid w-100" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
        <div class="bottom d-flex align-items-center">
          <a href="<?php echo e(route('frontend.home')); ?>"><?php echo app('translator')->get('home'); ?></a>
          <img class="mx-2" src="image/arrow.png" alt="arrow">
          <a href="<?php echo e($alias_parent); ?>"><?php echo e($title_parent); ?></a>
          <img class="mx-2" src="image/arrow.png" alt="arrow">
          <a href="#" class="bold"><?php echo e($title); ?></a>
        </div>
      </section>
      <section id="shareholder-detail">
        <div class="container container-1160">
          <h2 class="title blod text-uppercase position-relative">
            <div class="arrow-img">
              <img src="image/left.png" alt="arrow">
            </div>
            <?php echo e($title); ?>

          </h2>
          <ul class="time-line list-unstyled m-0 d-flex">
            <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $title = $item->json_params->title->{$locale} ?? $item->title;
              ?>
              <?php if($loop->first): ?>
              <li class="nav-link active" data-id="<?php echo e($item->id); ?>"><?php echo e($title); ?></li>
              <?php else: ?>
              <li class="nav-link" data-id="<?php echo e($item->id); ?>"><?php echo e($title); ?></li>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $services = App\Models\CmsPost::where('is_type', App\Consts::POST_TYPE['service'])
                      ->where('status', 'active')
                      ->where('taxonomy_id', $item->id)
                      ->get();
            ?>
           
            <?php if($loop->first): ?>
              <?php if(isset($services)): ?>
              <ul class="detail-list active list-unstyled " id="<?php echo e($item->id); ?>">
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                    $title = $item->json_params->title->{$locale} ?? $item->title;
                    $file_download = $item->json_params->catalog ?? null;
                  ?>
                  <li class="detail-item d-flex justify-content-between align-items-center">
                    <div class="item-title">
                      <?php echo e($title); ?>

                    </div>
                    <div class="d-flex">
                      <div class="btn btn-download">
                        <a href="<?php echo e($file_download); ?>" download>
                          <img src="image/download.svg" alt="icon">
                          Tải về
                        </a>
                        
                      </div>
                      <div class="btn btn-view">
                        <a href="<?php echo e($file_download); ?>" target="_blank">
                          <img src="image/view.svg" alt="icon">
                          Xem file
                        </a>
                        
                      </div>
                    </div>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
              <?php endif; ?>
            <?php else: ?>
              <?php if(isset($services)): ?>
              <ul class="detail-list list-unstyled" id="<?php echo e($item->id); ?>">
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                    $title = $item->json_params->title->{$locale} ?? $item->title;
                    $file_download = $item->json_params->catalog ?? null;
                  ?>
                  <li class="detail-item d-flex justify-content-between align-items-center">
                    <div class="item-title">
                      <?php echo e($title); ?>

                    </div>
                    <div class="d-flex">
                      <div class="btn btn-download">
                        <a href="<?php echo e($file_download); ?>" download>
                          <img src="image/download.svg" alt="icon">
                          Tải về
                        </a>
                      </div>
                      <div class="btn btn-view">
                        <a href="<?php echo e($file_download); ?>" target="_blank">
                          <img src="image/view.svg" alt="icon">
                          Xem file
                        </a>
                      </div>
                    </div>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
              <?php endif; ?>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </section>
      <?php endif; ?>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/pages/service/category.blade.php ENDPATH**/ ?>