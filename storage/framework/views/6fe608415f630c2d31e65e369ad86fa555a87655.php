

<?php
  $title = $detail->json_params->title->{$locale} ?? $detail->title;
  $brief = $detail->json_params->brief->{$locale} ?? null;
  $price = $detail->json_params->price ?? null;
  $price_old = $detail->json_params->price_old ?? null;
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
  <section id="page-title">
    <div class="container text-center">
      <h1 class="mb-3"><?php echo e($taxonomy_title); ?></h1>
      <span><?php echo e($title); ?></span>
    </div>
  </section>

  <section id="content" class="py-5">
    <div class="content-wrap">
      <div class="container clearfix">
        <div class="single-product">
          <div class="product">
            <div class="row">
              <div class="col-md-6">
                <div class="slider slider-for w-75 m-auto mb-5">
                  <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div>
                    <img class="img-fluid w-100" src="<?php echo e($value); ?>" alt="product image">
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="slider slider-nav pt-4">
                  <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div>
                    <img class="img-fluid w-75 m-auto" src="<?php echo e($value); ?>" alt="product image">
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </div>
              <div class="col-md-6 product-desc">
                <h3 class="mb-4"><?php echo e($title); ?></h3>
                <div class="line"></div>
                <div class="d-flex align-items-center justify-content-between mt-4 mb-3">
                  <div class="product-price">
                    <del><?php echo e(isset($price_old) && $price_old > 0 ? number_format($price_old, 0, ',', '.') . ' đ' : ""); ?></del>
                    <ins class="ms-3"><?php echo e(isset($price) && $price > 0 ? number_format($price, 0, ',', '.') . ' đ' : __('Contact')); ?></ins>
                  </div>
                  <div class="product-rating">
                    <?php if($vote): ?>
                      <?php
                        $full = floor($vote);
                        $empty = 5 - $full;
                        $half = $vote - $full;
                        if($half > 0.4) {
                          $empty--;
                        }
                      ?>
                      <?php for($i=0; $i < $full ; $i++): ?>
                        <i class="icon-star3" style="color: rgb(195, 255, 0)"></i>
                      <?php endfor; ?>
                      <?php if($half > 0.4): ?>
                        <i class="icon-star-half-full" style="color: rgb(195, 255, 0)"></i>
                      <?php endif; ?>
                      <?php if($empty): ?>
                        <?php for($i = 0; $i < $empty; $i++): ?>
                          <i class="icon-star-empty"></i>
                        <?php endfor; ?>
                      <?php endif; ?>
                    <?php else: ?>
                      <?php for($i = 0; $i < 5; $i++): ?>
                        <i class="icon-star-empty"></i>
                      <?php endfor; ?>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="desc-detail">
                  <?php echo $brief; ?>

                </div>
                <ul class="list-unstyled mt-3">
                  <li>
                    <i class="fa-solid fa-circle-right"></i>
                    <span class="detail-title">Thành phần</span>: Bánh tổ ong và mật ong tự nhiên 100%
                  </li>
                  <li>
                    <i class="fa-solid fa-circle-right"></i>
                    <span class="detail-title">Khối lượng</span>: 500g
                  </li>
                  <li>
                    <i class="fa-solid fa-circle-right"></i>
                    <span class="detail-title">Xuất xứ</span>: Việt Nam
                  </li>
                  <li>
                    <i class="fa-solid fa-circle-right"></i>
                    <span class="detail-title">Sản xuất tại</span>: Công ty Cổ phần Ong Tam Đảo
                  </li>
                  <li>
                    <i class="fa-solid fa-circle-right"></i>
                    <span class="detail-title">Mua hàng chính hãng tại: 096 735 0808</span>
                  </li>
                </ul>
                <form class="cart mb-4" method="post">
                  <div class="d-flex mb-4">
                    <div class="product-size">
                      <input type="radio" name="size" id="size1" checked class="d-none" value="200">
                      <label for="size1"><div>200g</div></label><br>
                    </div>
                    <div class="product-size ms-3">
                      <input type="radio" name="size" id="size2" class="d-none" value="500">
                      <label for="size2"><div>500g</div></label><br>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="product-number d-flex align-items-center me-4">
                      <input type="button" value="-" class="minus number-sub" />
                      <input type="number" step="1" class="number" min="1" id="quantity" name="number" value="1">
                      <input type="button" value="+" class="plus number-add" />
                    </div>
                    <p class="m-0">Còn hàng</p>
                    <button type="button" data-id="<?php echo e($detail->id); ?>" class="add-to-cart ms-3">
                      <?php echo app('translator')->get('Add to cart'); ?>
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <hr class="mb-1">
            <div class="row">
              <div class="col-lg-12 col-12">
                <div class="tabs mb-0">
                  <ul class="tab-nav d-flex list-unstyled mb-40">
                    <li class="nav-item active" data-id="#tabs-1">
                      <?php echo app('translator')->get('Description'); ?>
                    </li>
                    <li class="nav-item" data-id="#tabs-2">
                      <?php echo app('translator')->get('Reviews'); ?> (<?php echo e(count($review)); ?>)
                    </li>
                  </ul>
                  <div class="tab-container">
                    <div class="tab-content active" id="tabs-1">
                      <?php echo $content; ?>

                    </div>
                    <div class="tab-content" id="tabs-2">
                      <div id="review">
                        <ul class="review-list list-unstyled">
                          <li class="review-detail">
                            <div class="row">
                              <div class="col-lg-1 col-1">
                                <div class="user-avatar m-4">
                                  <img src="<?php echo e(asset('images/avatar.jpg')); ?>" alt="" class="img-fluid w-100">
                                </div>
                              </div>
                              <div class="col-lg-11 col-11">
                                <div class="d-flex align-items-center">
                                  <div class="user-name fs-2">Manh Tuong</div>
                                  <div class="review-rate ms-5">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                  </div>
                                </div>
                                <div class="d-flex">
                                  <div class="review-time">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    12/07/2023
                                  </div>
                                  <div class="review-reply ms-4">Reply</div>
                                </div>
                                <div class="review-content">
                                  Sản phẩm rất tốt, sẽ ủng hộ shop lâu dài!!!
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="review-detail">
                            <div class="row">
                              <div class="col-lg-1 col-1">
                                <div class="user-avatar m-4">
                                  <img src="<?php echo e(asset('images/avatar.jpg')); ?>" alt="" class="img-fluid w-100">
                                </div>
                              </div>
                              <div class="col-lg-11 col-11">
                                <div class="d-flex align-items-center">
                                  <div class="user-name fs-2">Manh Tuong</div>
                                  <div class="review-rate ms-5">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                  </div>
                                </div>
                                <div class="d-flex">
                                  <div class="review-time">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    12/07/2023
                                  </div>
                                  <div class="review-reply ms-4">Reply</div>
                                </div>
                                <div class="review-content">
                                  Sản phẩm rất tốt, sẽ ủng hộ shop lâu dài!!!
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <h3 class="my-4">Bình luận về sản phẩm</h3>
                        <div class="add-review">
                          <form action="" method="post">
                            <div class="d-flex">
                              <div class="form-group w-50 me-4">
                                <label for="" class="mb-2"><?php echo app('translator')->get('Fullname'); ?></label>
                                <input type="text"
                                  class="form-control" name="name" placeholder="Họ và tên">
                              </div>
                              <div class="form-group w-50 ms-4">
                                <label for="" class="mb-2">Email</label>
                                <input type="email"
                                  class="form-control" name="email" placeholder="Email">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="" class="mb-2"><?php echo app('translator')->get('Content'); ?></label>
                              <textarea name="content" class="w-100" cols="30" rows="5" placeholder="<?php echo app('translator')->get('Content'); ?>"></textarea>
                            </div>
                            <div class="add-vote my-4">
                              Đánh giá
                              <select name="vote" class="ms-3">
                                <option value="1">Tùy chọn</option>
                                <option value="1">1 Sao</option>
                                <option value="2">2 Sao</option>
                                <option value="3">3 Sao</option>
                                <option value="4">4 Sao</option>
                                <option value="5">5 Sao</option>
                              </select>
                            </div>
                            <button type="submit" class="mt-4"><?php echo app('translator')->get('Submit'); ?></button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php if(isset($relatedPosts) && count($relatedPosts) > 0): ?>
          <div>
            <h4 class="text-uppercase bold my-4"><?php echo app('translator')->get('Related Products'); ?></h4>
            <div class="swiper-relate">
              <div class="swiper-wrapper">
                <?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="swiper-slide">
                    <?php
                      $title = $item->json_params->title->{$locale} ?? $item->title;
                      $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                      $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                      $date = date('d/m/Y', strtotime($item->created_at));
                      // Viet ham xu ly lay slug
                      $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $item->alias ?? $title_item, $item->id, 'detail', $item->taxonomy_title);
                      $price = $item->json_params->price ?? null;
                      $price_old = $item->json_params->price_old ?? null;
                    ?>

                    <div class="product-detail mb-4">
                      <a href="<?php echo e($alias); ?>" class="product-image p-2">
                        <img class="img-fluid w-100" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
                      </a>
                      <div class="product-desc p-2">
                        <div class="product-title">
                          <h3>
                            <a href="<?php echo e($alias); ?>"><?php echo e(Str::limit($title, 38)); ?></a>
                          </h3>
                        </div>
                        <div class="product-price">
                          <ins><?php echo e(number_format($price, 0,',','.') . ' đ'); ?></ins>
                          <?php if($price_old): ?>
                            <del><?php echo e(number_format($price_old, 0,',','.') . ' đ'); ?></del>
                          <?php endif; ?>
                        </div>
                        <div class="product-button d-flex justify-content-between mt-4 mb-2">
                          <a href="<?php echo e($alias); ?>" class="button-detail">Chi tiết</a>
                          <div class="button-cart">Thêm vào giỏ</div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
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

<?php echo $__env->make('frontend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\honey\resources\views/frontend/pages/product/detail.blade.php ENDPATH**/ ?>