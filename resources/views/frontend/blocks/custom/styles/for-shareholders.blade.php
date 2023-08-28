@if ($block)
  @php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $background = $block->image_background != '' ? $block->image_background : '';
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $icon = $block->icon ?? '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    
    $block_childs = $blocks->filter(function ($item, $key) use ($block) {
        return $item->parent_id == $block->id;
    });
  @endphp

  <section id="shareholder" style="background-image: url({{ asset($background) }})">
    <div class="container">
      <div class="title">{{ $title }}</div>
      @isset($block_childs)
      <ul class="p-0">
        @foreach($block_childs as $item)

        <li>
          <div class="wrap-img">
            <img src="{{ $item->json_params->image??($item->image ?? '') }}" alt="{{ $item->json_params->title->{$locale}??($item->title ?? '') }}">
          </div>
          <div class="shareholder-title">
            <span>{{ $item->json_params->title->{$locale}??($item->title ?? '') }}</span>
          </div>
        </li>
        @endforeach
      </ul>
      @endisset
    </div>
  </section>
@endif
