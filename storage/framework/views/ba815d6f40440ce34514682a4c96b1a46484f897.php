<?php if($block): ?>
  <?php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $background = $block->image_background != '' ? $block->image_background : '';
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $icon = $block->icon ?? '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    
    $block_childs = $blocks->filter(function ($item, $key) use ($block) {
        return $item->parent_id == $block->id;
    });
  ?>

  
<?php endif; ?>
<section id="shareholder">
  <div class="container">
    <div class="title">Dành cho cổ đông</div>
    <ul class="p-0">
      <li>
        <div class="wrap-img">
          <img src="image/codong1.png" alt="icon">
        </div>
        <div class="shareholder-title">
          <span>Hồ sơ quản trị doanh nghiệp</span>
        </div>
      </li>
      <li>
        <div class="wrap-img">
          <img src="image/codong2.png" alt="icon">
        </div>
        <div class="shareholder-title">
          <span>Thông tin cổ phiếu</span>
        </div>
      </li>
      <li>
        <div class="wrap-img">
          <img src="image/codong3.png" alt="icon">
        </div>
        <div class="shareholder-title">
          <span>Báo cáo thường niên</span>
        </div>
      </li>
      <li>
        <div class="wrap-img">
          <img src="image/codong4.png" alt="icon">
        </div>
        <div class="shareholder-title">
          <span>Đại hội cổ đông</span>
        </div>
      </li>
      <li>
        <div class="wrap-img">
          <img src="image/codong5.png" alt="icon">
        </div>
        <div class="shareholder-title">
          <span>Báo cáo tài chính</span>
        </div>
      </li>
      <li>
        <div class="wrap-img">
          <img src="image/codong6.png" alt="icon">
        </div>
        <div class="shareholder-title">
          <span>Công bố thông tin</span>
        </div>
      </li>
    </ul>
  </div>
</section><?php /**PATH C:\xampp\htdocs\honey\resources\views/frontend/blocks/custom/styles/process.blade.php ENDPATH**/ ?>