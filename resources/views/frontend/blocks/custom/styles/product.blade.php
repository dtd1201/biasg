@if ($block)
    @php
        $title = $block->json_params->title->{$locale} ?? $block->title;
        $description = $block->json_params->description->{$locale} ?? $block->description;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        
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
    
    <section id="product">
        <div class="container container-1160">
          <div class="section-title">
            {{ $brief }}
            <div>{{ $description }} <span>{{ $title }}</span></div>
          </div>
          <div class="tab-heading d-flex justify-content-center">
            @foreach($rows as $row)
            
                @if($loop->first)
                <div class="tab-item active" data-id="{{ $i++ }}">
                  <img class="img-fluid" src="{{ $row->json_params->image->{$locale}??($row->image_thumb ?? '') }}" alt="{{ $row->json_params->image->{$locale}??($row->image_thumb ?? '') }}">
                </div>
                @else
                <div class="tab-item" data-id="{{ $i++ }}">
                  <img class="img-fluid" src="{{ $row->json_params->image->{$locale}??($row->image_thumb ?? '') }}" alt="{{ $row->json_params->image->{$locale}??($row->image_thumb ?? '') }}">
                </div>
                @endif
            @endforeach
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
                      <img class="img-fluid w-100" src="{{ $row->json_params->image->{$locale}??($row->image ?? '') }}" alt="{{ $row->json_params->title->{$locale}??($row->image ?? '') }}">
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="detail-content">
                        <div class="detail-img">
                          <img src="{{ $row->json_params->image_logo->{$locale}??($row->image_logo ?? '') }}" alt="{{ $row->json_params->title->{$locale}??($row->image ?? '') }}">
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
                      <img class="img-fluid w-100" src="{{ $row->json_params->image->{$locale}??($row->image ?? '') }}" alt="{{ $row->json_params->title->{$locale}??($row->image ?? '') }}">
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="detail-content">
                        <div class="detail-img">
                          <img src="{{ $row->json_params->image->{$locale}??($row->image_logo ?? '') }}" alt="{{ $row->json_params->title->{$locale}??($row->image ?? '') }}">
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
    </section>
  @endif
@endif