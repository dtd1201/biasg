<?php if($block): ?>
  <?php
    $product = App\Models\CmsPost::where('is_type', App\Consts::POST_TYPE['product'])
                      ->where('is_featured', true)
                      ->where('status', 'active')
                      ->first();
    $title = $product->title ?? '';
    $brief = $product->json_params->brief->{$locale} ?? $product->brief;
    $content = $product->json_params->content->{$locale} ?? $product->content;
    $price = $product->json_params->price ?? '';
    $price_old = $product->json_params->price_old ?? '';
    $gallery = $product->json_params->gallery_image ?? '';
    $id = $product->id ?? '';
  ?>

  
<?php endif; ?>
<section id="about-us">
  <div class="container container-1160">
    <div class="row">
      <div class="col-lg-6 col-12">
        <img class="img-fluid w-100" src="image/about.png" alt="about-us">
      </div>
      <div class="col-lg-6 col-12 bg-about">
        <div class="about-detail">
          <div class="section-title">Về chúng tôi</div>
          <div class="desc">
            Bia SAIGON - Niềm tự hào của Việt Nam. Công ty cổ phần Bia Sài Gòn - 
            Bến Tre (BIASAIGONBENTRE) tự hào là một trong những đơn vị thành viên trực 
            thuộc Tổng Công ty cổ phần Bia - Rượu - Nước giải khát Sài Gòn (SABECO)...
          </div>
          <a href="#" class="btn btn-more">Xem chi tiết</a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php /**PATH C:\xampp\htdocs\honey\resources\views/frontend/blocks/custom/styles/featured_product.blade.php ENDPATH**/ ?>