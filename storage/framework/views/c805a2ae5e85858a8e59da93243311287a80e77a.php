<?php if($block): ?>
  <?php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $background = $block->image_background != '' ? $block->image_background : url('assets/img/banner.jpg');
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    
    $params['status'] = App\Consts::POST_STATUS['active'];
    $params['is_featured'] = true;
    $params['is_type'] = App\Consts::POST_TYPE['post'];
    
    $rows = App\Http\Services\ContentService::getCmsPost($params)
        ->limit(4)
        ->get();
  ?>

  
<?php endif; ?>
<section id="post">
  <div class="container container-1160">
    <h2 class="text-uppercase text-center post-title">Tin tức - sự kiện</h2>
    <div class="row">
      <div class="col-lg-4 col-md-4 col-12 article">
        <a href="#" class="article-img">
          <img class="img-fluid w-100" src="image/post1.png" alt="post article">
        </a>
        <p class="date">Sep 21, 2023</p>
        <a href="#" class="article-title">Ông Nguyễn Thành Nam trở thành Tổng giám đốc Bia Sài Gòn</a>
        <p class="desc">
          Sản phẩm bia Saigon Special với thành phần 100% malt (không có gạo), 
          được sản xuất trên dây chuyền công nghệ hiện đại...
        </p>
      </div>
      <div class="col-lg-4 col-md-4 col-12 article">
        <a href="#" class="article-img">
          <img class="img-fluid w-100" src="image/post2.png" alt="post article">
        </a>
        <p class="date">Sep 21, 2023</p>
        <a href="#" class="article-title">Ông Nguyễn Thành Nam trở thành Tổng giám đốc Bia Sài Gòn</a>
        <p class="desc">
          Sản phẩm bia Saigon Special với thành phần 100% malt (không có gạo), 
          được sản xuất trên dây chuyền công nghệ hiện đại...
        </p>
      </div>
      <div class="col-lg-4 col-md-4 col-12 article">
        <a href="#" class="article-img">
          <img class="img-fluid w-100" src="image/post3.png" alt="post article">
        </a>
        <p class="date">Sep 21, 2023</p>
        <a href="#" class="article-title">Ông Nguyễn Thành Nam trở thành Tổng giám đốc Bia Sài Gòn</a>
        <p class="desc">
          Sản phẩm bia Saigon Special với thành phần 100% malt (không có gạo), 
          được sản xuất trên dây chuyền công nghệ hiện đại...
        </p>
      </div>
    </div>
  </div>
</section><?php /**PATH C:\xampp\htdocs\honey\resources\views/frontend/blocks/cms_post/styles/default.blade.php ENDPATH**/ ?>