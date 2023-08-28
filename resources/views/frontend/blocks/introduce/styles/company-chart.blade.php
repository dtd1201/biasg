@if ($block)
  @php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $background = $block->image_background != '' ? $block->image_background : '';
    $image = $block->image != '' ? $block->image : '';
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $icon = $block->icon ?? '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    
  @endphp
  <section id="intro-organization">
    <div class="title-heading d-flex align-items-center justify-content-center" id="{{ $block->id }}">
      <div class="line-middle"></div>
      <h2>{{ $title }}</h2>
      <div class="line-middle"></div>
    </div>
    <div class="diagram-img text-center">
      <img class="img-fluid w-75" src="{{ $image }}" alt="{{ $title }}">
    </div>
  </section>
@endif