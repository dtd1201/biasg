

<?php
  $page_title = $taxonomy->json_params->title->{$locale} ?? ($page->title ?? $page->name);
  $image_background = $web_information->image->background_breadcrumbs ?? ($taxonomy->json_params->image_background ?? '');
  $title = $taxonomy->json_params->title->{$locale} ?? ($taxonomy->title ?? null);
  $image = $taxonomy->json_params->image ?? null;
  $params_product['status'] = App\Consts::POST_STATUS['active'];
  $params_product['is_type'] = App\Consts::POST_TYPE['product'];
  $params_product['order_by'] = 'iorder';
  
  $row = App\Http\Services\ContentService::getCmsPost($params_product)
      ->get();
?>
<?php $__env->startSection('content'); ?>
  <div id="content">
    <section id="banner-category" class="position-relative">
      <img class="img-fluid w-100" src="<?php echo e($image); ?>" alt="<?php echo e($page_title); ?>">
      <div class="bottom d-flex align-items-center">
        <a href="<?php echo e(route('frontend.home')); ?>"><?php echo app('translator')->get('Home'); ?></a>
        <img class="mx-2" src="image/arrow.png" alt="arrow">
        <a href="#" class="bold"><?php echo e($page_title); ?></a>
      </div>
    </section>
    <?php if(isset($row)): ?>
    <section id="category-product">
      <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $category = App\Models\CmsTaxonomy::where('id', $item->taxonomy_id)->first();
          $alias_child = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $item->alias ?? $title, $item->id, 'detail', $category->title);
        ?>
        <?php if($key % 2 == 0): ?>
        <div class="product-detail">
          <div class="container container-category">
            <div class="row">
              <div class="col-lg-6 col-12 bg-content">
                <img class="img-fluid w-100 product-img" src="<?php echo e($item->json_params->image->{$locale}??($item->image ?? '')); ?>" alt="<?php echo e($item->json_params->title->{$locale}??($item->title ?? '')); ?>">
              </div>
              <div class="col-lg-6 col-12">
                <div class="detail-content">
                  <div class="detail-img detail-first">
                    <img src="<?php echo e($item->json_params->image_logo->{$locale}??($item->image_logo ?? '')); ?>" alt="<?php echo e($item->json_params->title->{$locale}??($item->title ?? '')); ?>">
                  </div>
                  <div class="detail-title">
                    "<?php echo e($item->json_params->description->{$locale}??($item->description ?? '')); ?>"
                  </div>
                  <div class="desc">
                    <?php echo e($item->json_params->brief->{$locale}??($item->brief ?? '')); ?>

                  </div>
                  <a href="<?php echo e($alias_child); ?>" class="btn btn-more"><?php echo app('translator')->get('View detail'); ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php else: ?>
        <div class="product-detail reverse" style="background-image: url('<?php echo e($taxonomy->json_params->image_background); ?>')">
          <div class="container container-category">
            <div class="row flex-row-reverse">
              <div class="col-lg-6 col-12 bg-content">
                <img class="img-fluid w-100 product-img" src="<?php echo e($item->json_params->image->{$locale}??($item->image ?? '')); ?>" alt="<?php echo e($item->json_params->title->{$locale}??($item->title ?? '')); ?>">
              </div>
              <div class="col-lg-6 col-12">
                <div class="detail-content">
                  <div class="detail-img">
                    <img src="<?php echo e($item->json_params->image_logo->{$locale}??($item->image_logo ?? '')); ?>" alt="<?php echo e($item->json_params->title->{$locale}??($item->title ?? '')); ?>">
                  </div>
                  <div class="detail-title">
                    "<?php echo e($item->json_params->description->{$locale}??($item->description ?? '')); ?>"
                  </div>
                  <div class="desc">
                    <?php echo e($item->json_params->brief->{$locale}??($item->brief ?? '')); ?>

                  </div>
                  <a href="<?php echo e($alias_child); ?>" class="btn btn-more"><?php echo app('translator')->get('View detail'); ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
  
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/pages/product/category.blade.php ENDPATH**/ ?>