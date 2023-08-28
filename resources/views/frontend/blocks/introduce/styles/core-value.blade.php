@if ($block)
  @php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $background = $block->image_background != '' ? $block->image_background : '';
    $image = $block->image != '' ? $block->image : '';
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $icon = $block->icon ?? '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    $params_block['parent_id'] = $block->id;
    $params_block['block_code'] = 'introduce';
    $params_block['status'] = App\Consts::STATUS['active'];
    $params_block['order_by'] = [
        'iorder' => 'ASC',
        'id' => 'DESC'
    ];
    // $block_childs = $blocks->filter(function ($item, $key) use ($block) {
    //     return $item->parent_id == $block->id;
    // });
    $block_childs = App\Http\Services\PageBuilderService::getBlockContent($params_block)
    ->get();
  @endphp
  <section id="core-value">
    <div class="container container-1160" id="{{ $block->id }}">
      <div class="title-heading d-flex align-items-center justify-content-center">
        <div class="line-middle"></div>
        <h2>{{ $title }}</h2>
        <div class="line-middle"></div>
      </div>
      @isset($block_childs)
      <div class="row">
        @foreach($block_childs as $item)
          @if($item->parent_id == $block->id)
            @php
                $image = $item->json_params->image->{$locale} ?? $item->image;
                $title = $item->json_params->title->{$locale} ?? $item->title;
                $description = $item->json_params->description->{$locale} ?? $item->description;
            @endphp
          <div class="col-lg-4 col-12 col-value">
            <div class="core-infor position-relative">
              <div class="core-icon">
                <img src="{{ $image }}" alt="{{ $title }}">
              </div>
              <div class="core-detail text-center">
                <h3>{{ $title }}</h3>
                <div class="desc">
                  {{ $description }}
                </div>
              </div>
            </div>
          </div>
          @endif
        @endforeach
      </div>
      @endisset
    </div>
  </section>
@endif