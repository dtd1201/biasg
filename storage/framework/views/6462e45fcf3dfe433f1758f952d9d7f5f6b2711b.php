<?php if($block): ?>

  <?php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $url_link = $block->json_params->url_link->{$locale} ?? $block->url_link;
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    $background = $block->image_background ?? '';
    $rows = App\Models\CmsPost::where('is_type', App\Consts::POST_TYPE['product'])
                      ->where('is_featured', true)
                      ->where('status', 'active')
                      ->limit(4)
                      ->get();
  ?>

  
<?php endif; ?>
<section id="product">
  <div class="container container-1160">
    <div class="section-title">
      Các sản phẩm bia Sài Gòn
      <div>được sản xuất tại nhà máy <span>bia sài gòn - bến tre</span></div>
    </div>
    <div class="tab-heading d-flex justify-content-center">
      <div class="tab-item active" data-id="1">
        <img class="img-fluid" src="image/bia1.png" alt="product">
      </div>
      <div class="tab-item" data-id="2">
        <img class="img-fluid" src="image/bia2.png" alt="product">
      </div>
      <div class="tab-item" data-id="3">
        <img class="img-fluid" src="image/bia3.png" alt="product">
      </div>
      <div class="tab-item" data-id="4">
        <img class="img-fluid" src="image/bia4.png" alt="product">
      </div>
    </div>
    <div class="tab-content">
      <div class="tab-detail active">
        <div class="row">
          <div class="col-lg-6 col-12 bg-content">
            <img class="img-fluid w-100" src="image/nha-may.png" alt="intro">
          </div>
          <div class="col-lg-6 col-12">
            <div class="detail-content">
              <div class="detail-img">
                <img src="image/bia-sg.png" alt="bia sai gon">
              </div>
              <div class="detail-title">
                "Kết nối tình bằng hữu"
              </div>
              <div class="desc">
                Có mặt trên thị trường từ năm 1992, bia Saigon Lager đã và đang nhận được 
                nhiều sự tín nhiệm sử dụng của hàng triệu người uống bia Việt Nam. Sản xuất 
                trên dây chuyền công nghệ hiện đại tiên tiến hàng đầu thế giới dưới sự điều 
                hành của đội ngũ kỹ thuật giỏi và công nhân lành nghề, bia Saigon Lager đem 
                đến cảm nhận sảng khoái, tươi mát và đậm đà cho người sử dụng.
              </div>
              <a href="#" class="btn btn-more">Xem chi tiết</a>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-detail">
        <div class="row">
          <div class="col-lg-6 col-12 bg-content">
            <img class="img-fluid w-100" src="image/tab02.png" alt="intro">
          </div>
          <div class="col-lg-6 col-12">
            <div class="detail-content">
              <div class="detail-img">
                <img src="image/bia-sg.png" alt="bia sai gon">
              </div>
              <div class="detail-title">
                "Diện mạo mới, vẫn 1 tình yêu đích thực"
              </div>
              <div class="desc">
                Có mặt trên thị trường từ năm 1992, bia Saigon Lager đã và đang nhận được 
                nhiều sự tín nhiệm sử dụng của hàng triệu người uống bia Việt Nam. Sản xuất 
                trên dây chuyền công nghệ hiện đại tiên tiến hàng đầu thế giới dưới sự điều 
                hành của đội ngũ kỹ thuật giỏi và công nhân lành nghề, bia Saigon Lager đem 
                đến cảm nhận sảng khoái, tươi mát và đậm đà cho người sử dụng.
              </div>
              <a href="#" class="btn btn-more">Xem chi tiết</a>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-detail">
        <div class="row">
          <div class="col-lg-6 col-12 bg-content">
            <img class="img-fluid w-100" src="image/tab03.png" alt="intro">
          </div>
          <div class="col-lg-6 col-12">
            <div class="detail-content">
              <div class="detail-img">
                <img src="image/bia-sg.png" alt="bia sai gon">
              </div>
              <div class="detail-title">
                "Kết nối tình bằng hữu"
              </div>
              <div class="desc">
                Có mặt trên thị trường từ năm 1992, bia Saigon Lager đã và đang nhận được 
                nhiều sự tín nhiệm sử dụng của hàng triệu người uống bia Việt Nam. Sản xuất 
                trên dây chuyền công nghệ hiện đại tiên tiến hàng đầu thế giới dưới sự điều 
                hành của đội ngũ kỹ thuật giỏi và công nhân lành nghề, bia Saigon Lager đem 
                đến cảm nhận sảng khoái, tươi mát và đậm đà cho người sử dụng.
              </div>
              <a href="#" class="btn btn-more">Xem chi tiết</a>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-detail">
        <div class="row">
          <div class="col-lg-6 col-12 bg-content">
            <img class="img-fluid w-100" src="image/tab04.png" alt="intro">
          </div>
          <div class="col-lg-6 col-12">
            <div class="detail-content">
              <div class="detail-img">
                <img src="image/bia-sg.png" alt="bia sai gon">
              </div>
              <div class="detail-title">
                "Diện mạo mới, vẫn 1 tình yêu đích thực"
              </div>
              <div class="desc">
                Có mặt trên thị trường từ năm 1992, bia Saigon Lager đã và đang nhận được 
                nhiều sự tín nhiệm sử dụng của hàng triệu người uống bia Việt Nam. Sản xuất 
                trên dây chuyền công nghệ hiện đại tiên tiến hàng đầu thế giới dưới sự điều 
                hành của đội ngũ kỹ thuật giỏi và công nhân lành nghề, bia Saigon Lager đem 
                đến cảm nhận sảng khoái, tươi mát và đậm đà cho người sử dụng.
              </div>
              <a href="#" class="btn btn-more">Xem chi tiết</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="list-product" style="background-image: url(<?php echo e(asset('image/bg1.webp')); ?>)">
  <div class="container container-product">
    <div class="section-title d-flex align-items-center justify-content-center">
      Các sản phẩm của
      <img src="image/title.png" alt="Bia Sài Gòn">
    </div>
    <div class="tab-heading d-flex justify-content-center">
      <div class="tab-item active" data-id="1">
        <img class="img-fluid" src="image/sp1.png" alt="product">
      </div>
      <div class="tab-item" data-id="2">
        <img class="img-fluid" src="image/sp2.png" alt="product">
      </div>
      <div class="tab-item" data-id="3">
        <img class="img-fluid" src="image/sp3.png" alt="product">
      </div>
      <div class="tab-item" data-id="4">
        <img class="img-fluid" src="image/sp4.png" alt="product">
      </div>
      <div class="tab-item" data-id="5">
        <img class="img-fluid" src="image/sp5.png" alt="product">
      </div>
      <div class="tab-item" data-id="6">
        <img class="img-fluid" src="image/sp6.png" alt="product">
      </div>
      <div class="tab-item" data-id="7">
        <img class="img-fluid" src="image/sp7.png" alt="product">
      </div>
      <div class="swiper-tab">
        <div class="swiper-wrapper">
          <div class="swiper-slide" data-id="1">
            <img class="img-fluid w-50" src="image/sp1.png" alt="image banner">
          </div>
          <div class="swiper-slide" data-id="2">
            <img class="img-fluid w-50 h-100" src="image/sp2.png" alt="image banner">
          </div>
          <div class="swiper-slide" data-id="3">
            <img class="img-fluid w-50 h-100" src="image/sp3.png" alt="image banner">
          </div>
          <div class="swiper-slide" data-id="4">
            <img class="img-fluid w-50 h-100" src="image/sp4.png" alt="image banner">
          </div>
          <div class="swiper-slide" data-id="5">
            <img class="img-fluid w-50 h-100" src="image/sp5.png" alt="image banner">
          </div>
          <div class="swiper-slide" data-id="6">
            <img class="img-fluid w-50 h-100" src="image/sp6.png" alt="image banner">
          </div>
          <div class="swiper-slide" data-id="7">
            <img class="img-fluid w-50 h-100" src="image/sp7.png" alt="image banner">
          </div>
        </div>
      </div>
    </div>
    <div class="tab-content">
      <div class="tab-detail active">
        <div class="row">
          <div class="col-lg-6 col-12 bg-content">
            <img class="img-fluid w-100 tab-img" src="image/featured.png" alt="intro">
          </div>
          <div class="col-lg-6 col-12">
            <div class="detail-content">
              <div class="detail-img">
                <img src="image/special.png" alt="bia sai gon">
              </div>
              <div class="detail-title">
                "Làm từ 100% lúa mạch mùa xuân"
              </div>
              <div class="desc">
                Có mặt trên thị trường từ năm 1992, bia Saigon Lager đã và đang nhận được 
                nhiều sự tín nhiệm sử dụng của hàng triệu người uống bia Việt Nam. Sản xuất 
                trên dây chuyền công nghệ hiện đại tiên tiến hàng đầu thế giới dưới sự điều 
                hành của đội ngũ kỹ thuật giỏi và công nhân lành nghề, bia Saigon Lager đem 
                đến cảm nhận sảng khoái, tươi mát và đậm đà cho người sử dụng.
              </div>
              <a href="#" class="btn btn-more">Xem chi tiết</a>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-detail">
        <div class="row">
          <div class="col-lg-6 col-12 bg-content">
            <img class="img-fluid w-100 tab-img" src="image/tab02.png" alt="intro">
          </div>
          <div class="col-lg-6 col-12">
            <div class="detail-content">
              <div class="detail-img">
                <img src="image/special.png" alt="bia sai gon">
              </div>
              <div class="detail-title">
                "Làm từ 100% lúa mạch mùa xuân"
              </div>
              <div class="desc">
                Có mặt trên thị trường từ năm 1992, bia Saigon Lager đã và đang nhận được 
                nhiều sự tín nhiệm sử dụng của hàng triệu người uống bia Việt Nam. Sản xuất 
                trên dây chuyền công nghệ hiện đại tiên tiến hàng đầu thế giới dưới sự điều 
                hành của đội ngũ kỹ thuật giỏi và công nhân lành nghề, bia Saigon Lager đem 
                đến cảm nhận sảng khoái, tươi mát và đậm đà cho người sử dụng.
              </div>
              <a href="#" class="btn btn-more">Xem chi tiết</a>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-detail">
        <div class="row">
          <div class="col-lg-6 col-12 bg-content">
            <img class="img-fluid w-100 tab-img" src="image/tab03.png" alt="intro">
          </div>
          <div class="col-lg-6 col-12">
            <div class="detail-content">
              <div class="detail-img">
                <img src="image/special.png" alt="bia sai gon">
              </div>
              <div class="detail-title">
                "Bật lịch lãm sáng tự tin"
              </div>
              <div class="desc">
                Có mặt trên thị trường từ năm 1992, bia Saigon Lager đã và đang nhận được 
                nhiều sự tín nhiệm sử dụng của hàng triệu người uống bia Việt Nam. Sản xuất 
                trên dây chuyền công nghệ hiện đại tiên tiến hàng đầu thế giới dưới sự điều 
                hành của đội ngũ kỹ thuật giỏi và công nhân lành nghề, bia Saigon Lager đem 
                đến cảm nhận sảng khoái, tươi mát và đậm đà cho người sử dụng.
              </div>
              <a href="#" class="btn btn-more">Xem chi tiết</a>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-detail">
        <div class="row">
          <div class="col-lg-6 col-12 bg-content">
            <img class="img-fluid w-100 tab-img" src="image/tab04.png" alt="intro">
          </div>
          <div class="col-lg-6 col-12">
            <div class="detail-content">
              <div class="detail-img">
                <img src="image/special.png" alt="bia sai gon">
              </div>
              <div class="detail-title">
                "Làm từ 100% lúa mạch mùa xuân"
              </div>
              <div class="desc">
                Có mặt trên thị trường từ năm 1992, bia Saigon Lager đã và đang nhận được 
                nhiều sự tín nhiệm sử dụng của hàng triệu người uống bia Việt Nam. Sản xuất 
                trên dây chuyền công nghệ hiện đại tiên tiến hàng đầu thế giới dưới sự điều 
                hành của đội ngũ kỹ thuật giỏi và công nhân lành nghề, bia Saigon Lager đem 
                đến cảm nhận sảng khoái, tươi mát và đậm đà cho người sử dụng.
              </div>
              <a href="#" class="btn btn-more">Xem chi tiết</a>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-detail">
        <div class="row">
          <div class="col-lg-6 col-12 bg-content">
            <img class="img-fluid w-100 tab-img" src="image/tab05.png" alt="intro">
          </div>
          <div class="col-lg-6 col-12">
            <div class="detail-content">
              <div class="detail-img">
                <img src="image/special.png" alt="bia sai gon">
              </div>
              <div class="detail-title">
                "Bật lịch lãm sáng tự tin"
              </div>
              <div class="desc">
                Có mặt trên thị trường từ năm 1992, bia Saigon Lager đã và đang nhận được 
                nhiều sự tín nhiệm sử dụng của hàng triệu người uống bia Việt Nam. Sản xuất 
                trên dây chuyền công nghệ hiện đại tiên tiến hàng đầu thế giới dưới sự điều 
                hành của đội ngũ kỹ thuật giỏi và công nhân lành nghề, bia Saigon Lager đem 
                đến cảm nhận sảng khoái, tươi mát và đậm đà cho người sử dụng.
              </div>
              <a href="#" class="btn btn-more">Xem chi tiết</a>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-detail">
        <div class="row">
          <div class="col-lg-6 col-12 bg-content">
            <img class="img-fluid w-100 tab-img" src="image/tab06.png" alt="intro">
          </div>
          <div class="col-lg-6 col-12">
            <div class="detail-content">
              <div class="detail-img">
                <img src="image/special.png" alt="bia sai gon">
              </div>
              <div class="detail-title">
                "Làm từ 100% lúa mạch mùa xuân"
              </div>
              <div class="desc">
                Có mặt trên thị trường từ năm 1992, bia Saigon Lager đã và đang nhận được 
                nhiều sự tín nhiệm sử dụng của hàng triệu người uống bia Việt Nam. Sản xuất 
                trên dây chuyền công nghệ hiện đại tiên tiến hàng đầu thế giới dưới sự điều 
                hành của đội ngũ kỹ thuật giỏi và công nhân lành nghề, bia Saigon Lager đem 
                đến cảm nhận sảng khoái, tươi mát và đậm đà cho người sử dụng.
              </div>
              <a href="#" class="btn btn-more">Xem chi tiết</a>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-detail">
        <div class="row">
          <div class="col-lg-6 col-12 bg-content">
            <img class="img-fluid w-100 tab-img" src="image/tab05.png" alt="intro">
          </div>
          <div class="col-lg-6 col-12">
            <div class="detail-content">
              <div class="detail-img">
                <img src="image/special.png" alt="bia sai gon">
              </div>
              <div class="detail-title">
                "Bật lịch lãm sáng tự tin"
              </div>
              <div class="desc">
                Có mặt trên thị trường từ năm 1992, bia Saigon Lager đã và đang nhận được 
                nhiều sự tín nhiệm sử dụng của hàng triệu người uống bia Việt Nam. Sản xuất 
                trên dây chuyền công nghệ hiện đại tiên tiến hàng đầu thế giới dưới sự điều 
                hành của đội ngũ kỹ thuật giỏi và công nhân lành nghề, bia Saigon Lager đem 
                đến cảm nhận sảng khoái, tươi mát và đậm đà cho người sử dụng.
              </div>
              <a href="#" class="btn btn-more">Xem chi tiết</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="background"></div>
</section><?php /**PATH C:\xampp\htdocs\honey\resources\views/frontend/blocks/cms_product/styles/default.blade.php ENDPATH**/ ?>