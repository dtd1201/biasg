@if($block)
<section id="banner-intro" class="position-relative">
    <img class="img-fluid w-100" src="{{ $block->json_params->image->{$locale}??($block->image ?? '') }}" alt="{{ $block->json_params->url_link_title->{$locale}??($block->url_link_title ?? '') }}">
    <div class="bottom d-flex align-items-center">
      <a href="/">@lang('Home')</a>
      <img class="mx-2" src="image/arrow.png" alt="arrow">
      <a href="{{ $block->json_params->url_link->{$locale}??($block->url_link ?? '') }}" class="bold">{{ $block->json_params->url_link_title->{$locale}??($block->url_link_title ?? '') }}</a>
    </div>
</section>
@endif