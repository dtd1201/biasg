<?php if($block): ?>
<section id="about-us">
  <div class="container container-1160">
    <div class="row">
      <div class="col-lg-6 col-12">
        <img class="img-fluid w-100" src="<?php echo e($block->json_params->image->{$locale}??($block->image ?? '')); ?>" alt="<?php echo e($block->json_params->title->{$locale} ?? ($block->title ?? '')); ?>">
      </div>
      <div class="col-lg-6 col-12 bg-about">
        <div class="about-detail">
          <div class="section-title"><?php echo e($block->json_params->title->{$locale} ?? ($block->title ?? '')); ?></div>
          <div class="desc">
            <?php echo e($block->json_params->description->{$locale} ?? ($block->description ?? '')); ?>

          </div>
          <a href="<?php echo e($block->url_link??'#'); ?>" class="btn btn-more"><?php echo e($block->json_params->url_link_title->{$locale}??($block->url_link_title ?? '')); ?></a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/blocks/custom/styles/about-us.blade.php ENDPATH**/ ?>