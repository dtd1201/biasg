<style>
  .tab-item .img-fluid {
    height: 60px;
  }
</style>
@if ($block)
    @php
        $title = $block->json_params->title->{$locale} ?? $block->title;
        $description = $block->json_params->description->{$locale} ?? $block->description;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        $background = $block->json_params->image_background->{$locale} ?? $block->image_background;
        $image = $block->json_params->image->{$locale} ?? $block->image;
        $params['status'] = App\Consts::TAXONOMY_STATUS['active'];
        $params['taxonomy'] = App\Consts::TAXONOMY['product'];
        // $params['is_featured'] = true;
        $params['is_type'] = App\Consts::TAXONOMY['product'];
        
        $taxonomys = App\Http\Services\ContentService::getCmsTaxonomy($params)->get();
        foreach($taxonomys as $item){
          if($item->alias == $block->url_link){
            $main_taxonomy = $item;
          }
        }
        $params['taxonomy_id'] = $main_taxonomy->id;
        $rows = App\Http\Services\ContentService::getCmsPost($params)
            ->get();
        
    @endphp
  @if(isset($main_taxonomy))
    @php
        $i = 1;
    @endphp
    <section id="list-product" style="background-image: url({{ asset($background) }})">
        <div class="container container-product">
          <div class="section-title d-flex align-items-center justify-content-center">
            {{ $brief }}
            <img src="{{ $image }}" alt="{{ $title }}">
          </div>
          <div class="tab-heading d-flex justify-content-center">
            @foreach($rows as $row)
                @if($loop->first)
                <div class="tab-item active" data-id="{{$i++}}">
                  <img class="img-fluid" src="{{ $row->json_params->image->{$locale}??($row->image_thumb ?? '') }}" alt="{{ $row->json_params->title->{$locale}??($row->title ?? '') }}">
                </div>
                @else
                <div class="tab-item" data-id="{{$i++}}">
                  <img class="img-fluid" src="{{ $row->json_params->image->{$locale}??($row->image_thumb ?? '') }}" alt="{{ $row->json_params->title->{$locale}??($row->title ?? '') }}">
                </div>
                @endif
            @endforeach
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
            @foreach($rows as $row)
              @php
                $category = App\Models\CmsTaxonomy::where('id', $row->taxonomy_id)->first();
                $alias_child = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $row->alias ?? $title, $row->id, 'detail', $category->title);
              @endphp
                @if($loop->first)
                <div class="tab-detail active">
                  <div class="row">
                    <div class="col-lg-6 col-12 bg-content">
                      <img class="img-fluid w-100 tab-img" src="{{ $row->json_params->image->{$locale}??($row->image ?? '') }}" alt="{{ $row->json_params->title->{$locale}??($row->title ?? '') }}">
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="detail-content">
                        <div class="detail-img">
                          <img src="{{ $row->json_params->image_logo->{$locale}??($row->image_logo ?? '') }}" alt="{{ $row->json_params->title->{$locale}??($row->title ?? '') }}">
                        </div>
                        <div class="detail-title">
                          "{{ $row->json_params->description->{$locale}??($row->description ?? '') }}"
                        </div>
                        <div class="desc">
                          {{ $row->json_params->brief->{$locale}??($row->brief ?? '') }}
                        </div>
                        <a href="{{ $alias_child }}" class="btn btn-more">{{ $block->json_params->url_link_title->{$locale}??($block->url_link_title ?? '') }}</a>
                      </div>
                    </div>
                  </div>
                </div>
                @else
                <div class="tab-detail">
                  <div class="row">
                    <div class="col-lg-6 col-12 bg-content">
                      <img class="img-fluid w-100 tab-img" src="{{ $row->json_params->image->{$locale}??($row->image ?? '') }}" alt="{{ $row->json_params->title->{$locale}??($row->title ?? '') }}">
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="detail-content">
                        <div class="detail-img">
                          <img src="{{ $row->json_params->image_logo->{$locale}??($row->image_logo ?? '') }}" alt="{{ $row->json_params->title->{$locale}??($row->title ?? '') }}">
                        </div>
                        <div class="detail-title">
                          "{{ $row->json_params->description->{$locale}??($row->description ?? '') }}"
                        </div>
                        <div class="desc">
                          {{ $row->json_params->brief->{$locale}??($row->brief ?? '') }}
                        </div>
                        <a href="{{ $alias_child }}" class="btn btn-more">{{ $block->json_params->url_link_title->{$locale}??($block->url_link_title ?? '') }}</a>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
            @endforeach
          </div>
        </div>
        <div class="background"></div>
    </section>
  @endif
@endif