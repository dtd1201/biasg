@if ($block)
<section id="about-us">
  <div class="container container-1160">
    <div class="row">
      <div class="col-lg-6 col-12">
        <img class="img-fluid w-100" src="{{ $block->json_params->image->{$locale}??($block->image ?? '') }}" alt="{{ $block->json_params->title->{$locale} ?? ($block->title ?? '') }}">
      </div>
      <div class="col-lg-6 col-12 bg-about">
        <div class="about-detail">
          <div class="section-title">{{ $block->json_params->title->{$locale} ?? ($block->title ?? '') }}</div>
          <div class="desc">
            {{ $block->json_params->description->{$locale} ?? ($block->description ?? '') }}
          </div>
          <a href="{{ $block->url_link??'#' }}" class="btn btn-more">{{ $block->json_params->url_link_title->{$locale}??($block->url_link_title ?? '') }}</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

