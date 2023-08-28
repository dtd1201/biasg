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

  <section id="product">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-12">
          <div class="slider slider-for w-50 m-auto mb-5">
            <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
              <img class="lazyload img-fluid w-100"
                    src="<?php echo e(asset('images/lazyload.gif')); ?>"
                    data-src="<?php echo e($value); ?>" alt="<?php echo e($title); ?>"
                  />
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <div class="slider slider-nav pt-4">
            <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
              <img class="lazyload img-fluid m-auto"
                    src="<?php echo e(asset('images/lazyload.gif')); ?>"
                    data-src="<?php echo e($value); ?>" alt="<?php echo e($title); ?>"
                  />
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
        <div class="col-lg-5 col-12">
          <div class="product-infor">
            <h2 class="text-uppercase text-center bold mb-4"><?php echo e($title); ?></h2>
            <div class="line"></div>
            <div class="product-price pt-3 d-flex">
              <div class="old-price bold pe-3"><?php echo e(number_format($price)); ?> đ</div>
              <div class="price bold px-3"><?php echo e(number_format($price_old)); ?> đ</div>
              <div class="sale-off bold ps-3"><?php echo e(number_format($price_old - $price)); ?> đ</div>
            </div>
            <hr>
            <?php echo $brief; ?>

            <hr>
            <?php echo $content; ?>

            <p>Kích thước</p>
            <div class="d-flex">
              <div class="product-size">
                <input type="radio" name="size" id="size1" checked class="d-none" value="200">
                <label for="size1"><div>200g</div></label><br>
              </div>
              <div class="product-size ms-3">
                <input type="radio" name="size" id="size2" class="d-none" value="500">
                <label for="size2"><div>500g</div></label><br>
              </div>
            </div>
            <div class="d-flex align-items-center pt-4">
              <div class="product-number d-flex align-items-center me-4">
                <button class="number-sub">-</button>
                <input type="number" class="number" min="1" id="quantity" name="number" value="1">
                <button class="number-add">+</button>
              </div>
              <p class="m-0">Còn hàng</p>
            </div>
            <div class="d-flex mt-4">
              <div class="add-to-cart me-4" data-id="<?php echo e($id); ?>">
                Thêm giỏ hàng
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php /**PATH D:\xampp\htdocs\honey\resources\views/frontend/blocks/custom/styles/featured_product.blade.php ENDPATH**/ ?>