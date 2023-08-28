
@if($block)

@php
  // dd($block);
  $title = $block->json_params->title->{$locale} ?? $block->title;
  $description = $block->json_params->description->{$locale} ?? $block->description;
  $brief = $block->json_params->brief->{$locale} ?? $block->brief;
  $content = $block->json_params->content->{$locale} ?? $block->content;
  $background = $block->image_background != '' ? $block->image_background : url('assets/img/banner.jpg');
  $url_link = $block->url_link != '' ? $block->url_link : '';
  $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
  $params_block['parent_id'] = null;
  $params_block['block_code'] = 'introduce';
  $params_block['status'] = App\Consts::STATUS['active'];
  $params_block['order_by'] = [
      'iorder' => 'ASC',
      'id' => 'DESC'
  ];
  
  $list_block_introduce = App\Http\Services\PageBuilderService::getBlockContent($params_block)
    ->get();
  $params_block['parent_id'] = $block->id;
  $block_childs = App\Http\Services\PageBuilderService::getBlockContent($params_block)
    ->get();
@endphp
<div class="wrap-timeline" >
  @if(isset($list_block_introduce) && $list_block_introduce->count()>0)
  <ul class="time-line list-unstyled container-1160 mx-auto d-flex justify-content-between">
    @foreach($list_block_introduce as $key => $item)
      @if($loop->first)
        <a href="#{{ $item->id }}">
          <li class="link-scroll active" data-id="{{ $item->id }}">{{ $item->json_params->title->{$locale}??($item->title ?? '') }}</li>
        </a>
      @else
        <a href="#{{ $item->id }}">
          <li class="link-scroll" data-id="{{ $item->id }}">{{ $item->json_params->title->{$locale}??($item->title ?? '') }}</li>
        </a>
      @endif
    @endforeach
  </ul>
  @endif
</div>
<section id="intro-company">
  <div class="container container-1160" id="{{ $block->id }}">
    <h2 class="title text-center">
      {{ $title }}
      <div>{{ $description }} <span>{{ $brief }}</span></div>
    </h2>
    <div class="desc text-center">
      {!! $content !!}
    </div>
    
  </div>
</section>
<section id="intro-business">
  <div class="container container-1160" >
   
    @foreach($block_childs as $key => $item)
      @if($item->parent_id == $block->id)
        @php
          $image = $item->json_params->image->{$locale} ?? $item->image;
          $title = $item->json_params->title->{$locale} ?? $item->title;
          $description = $item->json_params->description->{$locale} ?? $item->description;
          
          $params_block['block_code'] = 'introduce';
          $params_block['status'] = App\Consts::STATUS['active'];
          $params_block['order_by'] = [
              'iorder' => 'ASC',
              'id' => 'DESC'
          ];
          $params_block['parent_id'] = $item->id;
          
          $block_Childs = $block_childs->filter(function ($item_child, $key) use ($item) {
            return $item_child->parent_id == $item->id;
          });
          
        @endphp
       
        @if($key % 2 != 0)
          <div class="row align-items-center">
            <div class="col-lg-6 col-12">
              <div class="company-img">
                <img src="{{ $image }}" alt="{{ $title }}">
              </div>
            </div>
            @if(isset($block_Childs))
            <div class="col-lg-6 col-12">
              <ul class="company-infor right list-unstyled p-0">
                @foreach($block_Childs as $item_child)
                <li>
                  <span class="bold">{{ $item_child->json_params->title->{$locale} ?? $item_child->title }}: </span>{{ $item_child->json_params->description->{$locale} ?? $item_child->description }}
                </li>
                @endforeach
                <li>
                  {{ $description }}
                </li>
              </ul>
            </div>
            @endif
          </div>
        @else
          <div class="row align-items-center">
            <div class="col-lg-6 col-12">
              @if(isset($block_Childs))
              <ul class="company-infor list-unstyled p-0">
                @foreach($block_Childs as $item_child)
                <li>
                  <span class="bold">{{ $item_child->json_params->title->{$locale} ?? $item_child->title }}: </span>{{ $item_child->json_params->description->{$locale} ?? $item_child->description }}
                </li>
                @endforeach
              </ul>
              @endif
            </div>
            <div class="col-lg-6 col-12 bg-content">
              <div class="company-img">
                <img class="img-fluid w-100" src="{{ $image }}" alt="{{ $title }}">
              </div>
            </div>
          </div>
        @endif
      @endif
    @endforeach
  </div>
</section>
@endif
