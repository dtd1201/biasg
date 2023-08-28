

<?php
  $title = $detail->json_params->title->{$locale} ?? $detail->title;
  $brief = $detail->json_params->brief->{$locale} ?? null;
  $description = $detail->json_params->description->{$locale} ?? null;
  $alcohol = $detail->json_params->alcohol ?? null;
  $bottles = $detail->json_params->bottles ?? null;
  $cans = $detail->json_params->cans ?? null;
  $content = $detail->json_params->content->{$locale} ?? null;
  $image = $detail->image != '' ? $detail->image : null;
  $image_thumb = $detail->image_thumb != '' ? $detail->image_thumb : null;
  $date = date('H:i d/m/Y', strtotime($detail->created_at));
  $color = $detail->json_params->color ?? '';
  $gallery = $detail->json_params->gallery_image ?? '';


  // For taxonomy
  $taxonomy_json_params = json_decode($detail->taxonomy_json_params);
  $taxonomy_title = $taxonomy_json_params->title->{$locale} ?? $detail->taxonomy_title;
  $image_background = $web_information->image->background_breadcrumbs ?? ($taxonomy->json_params->image_background ?? '');
  $taxonomy_alias = Str::slug($taxonomy_title);
  $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $taxonomy_alias, $detail->taxonomy_id);
  
  $seo_title = $detail->json_params->seo_title ?? $title;
  $seo_keyword = $detail->json_params->seo_keyword ?? null;
  $seo_description = $detail->json_params->seo_description ?? $brief;
  $seo_image = $image ?? ($image_thumb ?? null);
?>

<?php $__env->startSection('content'); ?>
  
  <div id="content">
    
    <section id="banner-video" style="background-image: url('<?php if(isset($detail->json_params->image_background_video)): ?><?php echo e($detail->json_params->image_background_video); ?> <?php endif; ?>')">
      <div class="video-detail">
        <iframe width="80%" height="600" src="<?php if(isset($detail->json_params->link_yt)): ?><?php echo e($detail->json_params->link_yt); ?> <?php endif; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>
      <div class="video-infor w-100">
        <div class="btn-play text-center">
          <div class="btn-circle mx-auto circle-fill">
            <div class="btn-circle-small">
              <i class="fa-solid fa-play pl-3"></i>
            </div>
          </div>
        </div>
        <div class="title text-center"><?php echo e($title); ?></div>
        <div class="desc text-center">“<?php echo e($description); ?>”</div>
      </div>
    </section>
    <section id="product-intro" style="background-image: url('<?php if(isset($detail->json_params->image_background_top)): ?><?php echo e($detail->json_params->image_background_top); ?> <?php endif; ?>')">
      <div class="container">
        <div class="intro-wrap">
          <div class="title">"<?php echo e($title); ?>"</div>
          <div class="desc"><?php echo e($description); ?></div>
          <div class="introduce">
            <?php echo e($brief); ?>

          </div>
          <ul class="d-flex align-items-center list-unstyled p-0 m-0">
            <li>
              <?php echo e($alcohol); ?> <div>%<?php echo app('translator')->get('Alcohol'); ?></div>
            </li>
            <li>
              <?php echo e($bottles); ?> <div><?php echo app('translator')->get('Bottles/safes'); ?></div>
            </li>
            <li>
              <?php echo e($cans); ?> <div><?php echo app('translator')->get('Cans/barrels'); ?></div>
            </li>
          </ul>
        </div>
      </div>
    </section>
    <section id="product-infor" style="background-image: url('<?php if(isset($detail->json_params->image_background_bottom)): ?><?php echo e($detail->json_params->image_background_bottom); ?> <?php endif; ?>')" >
      <div class="container">
        <div class="infor-detail">
          <?php echo $content; ?>

        </div>
      </div>
    </section>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
  <script>
    $(function() {
      $('.nav-item').click(function() {
        $('.nav-item').removeClass('active')
        $(this).addClass('active')
        $('.tab-content').removeClass('active')
        let id = $(this).attr('data-id')
        $(id).addClass('active')
      })
    })
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/pages/product/detail.blade.php ENDPATH**/ ?>