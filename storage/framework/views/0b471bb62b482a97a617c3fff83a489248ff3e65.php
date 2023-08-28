

<?php
  $page_title = $taxonomy->title ?? ($page->title ?? $page->name);
  $seo_title = $page_title . (isset($params['keyword']) && $params['keyword'] != '' ? ': ' . $params['keyword'] : '');
  
  $image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');
?>
<?php $__env->startPush('style'); ?>
  <style>

  </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
  <div id="content">
    <section id="banner-category" class="position-relative">
      <img class="img-fluid w-100" src="<?php echo e(asset($image_background)); ?>" alt="<?php echo e($page_title); ?>">
      <div class="bottom d-flex align-items-center">
        <a href="<?php echo e(route('frontend.home')); ?>"><?php echo app('translator')->get('Home'); ?> </a>
        <img class="mx-2" src="<?php echo e(asset('image/arrow.png')); ?>" alt="arrow">
        <a href="#" class="bold"><?php echo e($page_title); ?></a>
      </div>
    </section>
    <section id="category-post">
      <div class="container container-1160">
        <div class="row">
          <?php if(isset($posts)&& $posts->count()>0): ?>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $title = $item->json_params->title->{$locale} ?? $item->title;
                $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                $image = $item->image != '' ? $item->image : ($item->image != '' ? $item->image : null);
                // $date = date('H:i d/m/Y', strtotime($item->created_at));
                $date = date('d', strtotime($item->created_at));
                $month = date('M', strtotime($item->created_at));
                $year = date('Y', strtotime($item->created_at));
                // Viet ham xu ly lay slug
                $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->taxonomy_alias ?? $item->taxonomy_title, $item->taxonomy_id);
                $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
                $poster = App\Models\Admin::where('status', 'active')->where('id', $item->admin_created_id)->first()->name;
              ?>
              <div class="col-lg-4 col-md-4 col-12 ">
                  <div class="post-item">
                      <div class="post-item-top">
                          <a href="<?php echo e($alias); ?>">
                              <img class="post-img img-fluid w-100" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>" >
                          </a>
                          <a href="<?php echo e($alias); ?>">
                              <span class="post-title"><?php echo e($title); ?></span>
                          </a>
                      </div>
                      
                  </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <div class="no_result">Không tìm thấy kết quả nào</div>
          <?php endif; ?>
        </div> 
      </div>
    </section>

  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/pages/search/index.blade.php ENDPATH**/ ?>