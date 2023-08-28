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

  <section id="intro-history">
    <div class="title-heading d-flex align-items-center justify-content-center" id="{{ $block->id }}">
      <div class="line-middle"></div>
      <h2>{{ $title }}</h2>
      <div class="line-middle"></div>
    </div>
    <div class="img-history">
      <img class="img-fluid w-100" src="{{ $image }}" alt="{{ $title }}">
    </div>
    
    @isset($block_childs)
    <div class="container container-1160 history-detail">
      @foreach($block_childs as $item)
        @if($item->parent_id == $block->id)
          @php
            $title = $item->json_params->title->{$locale} ?? $item->title;
            $brief = $item->json_params->brief->{$locale} ?? $item->brief;
            $background = $item->image_background != '' ? $item->image_background : '';
            $image = $item->image != '' ? $item->image : '';
            $url_link = $item->url_link != '' ? $item->url_link : '';
            $icon = $item->icon ?? '';
            $url_link_title = $item->json_params->url_link_title->{$locale} ?? $item->url_link_title;
            
            $block_Childs = $block_childs->filter(function ($item_child, $key) use ($item) {
                return $item_child->parent_id == $item->id;
            });
          @endphp
          
        <div class="year">
          <div class="year-title">{{ $title }}</div>
          <div class="line"></div>
          @isset($block_Childs)
          <ul class="p-0">
            @foreach($block_Childs as $itemChild)
            <li>{{ $itemChild->json_params->title->{$locale} ?? $itemChild->title }}</li>
            @endforeach
          </ul>
          @endisset
        </div>
        @endif
      @endforeach
    </div>
    @endisset
  </section>
@endif