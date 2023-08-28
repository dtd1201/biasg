@extends('frontend.layouts.default')

@php
  $page_title = $taxonomy->title ?? ($page->title ?? $page->name);
  $image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');
  
  $title = $taxonomy->json_params->title->{$locale} ?? ($taxonomy->title ?? null);
  $title_parent = $taxonomy->parent->json_params->title->{$locale} ?? ($taxonomy->title ?? null);
  // $alias_parent = App\Helpers::generateRoute(App\Consts::TAXONOMY['service'], $taxonomy->parent->alias ?? $taxonomy->parent->json_params->title->{$locale}, $taxonomy->parent_id);
  $image = $taxonomy->json_params->image ?? null;
  $seo_title = $taxonomy->json_params->seo_title ?? $title;
  $seo_keyword = $taxonomy->json_params->seo_keyword ?? null;
  $seo_description = $taxonomy->json_params->seo_description ?? null;
  $seo_image = $image ?? null;

  $params_taxonomy['status'] = App\Consts::STATUS['active'];
  $params_taxonomy['taxonomy'] = App\Consts::TAXONOMY['service'];
  $params_taxonomy['order_by'] = 'iorder';
  $params_taxonomy['parent_id'] = $taxonomy->id;
  $row = App\Http\Services\ContentService::getCmsTaxonomy($params_taxonomy)
      ->get();
@endphp

@section('content')
  {{-- Print all content by [module - route - page] without blocks content at here --}}
  {{-- <div class="page-title-area">
    <div class="container">
      <span class="page-tag">{{ $page->name ?? '' }}</span>
      <h2 class="page-title">{{ $page_title }}</h2>

      <ul class="breadcrumb-nav">
        <li><a href="{{ route('frontend.home') }}">@lang('Home')</a></li>
        <li class="active">{{ $page->name ?? '' }}</li>
      </ul>
    </div>
  </div>

  <div class="entry-page">
    <div class="site-container fullwidth-container">
      <div class="site-content-wrapper no-sidebar">
        <div class="content-area" style="margin-bottom: 50px">

          <div id="post-656" class="page-inner clearfix post-656 page type-page status-publish hentry">
            <div data-elementor-type="wp-page" data-elementor-id="656" class="elementor elementor-656">
              <section
                class="elementor-section elementor-top-section elementor-element elementor-element-11ee35d0 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                data-id="11ee35d0" data-element_type="section">
                <div class="elementor-container elementor-column-gap-default">
                  <div
                    class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-5dbd99a"
                    data-id="5dbd99a" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                      <div
                        class="elementor-element elementor-element-6cee3c1c elementor-widget elementor-widget-yankee-fancy-boxes"
                        data-id="6cee3c1c" data-element_type="widget" data-widget_type="yankee-fancy-boxes.default">
                        <div class="elementor-widget-container">
                          <div class="yankee-service-boxes column-d-4 column-t-2 column-s-2 column-xs-1">

                            @foreach ($posts as $item)
                              @php
                                $title = $item->json_params->title->{$locale} ?? $item->title;
                                $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                                $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                                $date = date('H:i d/m/Y', strtotime($item->created_at));
                                // Viet ham xu ly lay alias bai viet
                                $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['service'], $item->taxonomy_alias ?? $item->taxonomy_title, $item->taxonomy_id);
                                $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['service'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
                                
                              @endphp
                              <div class="service-box">
                                <div class="icon">
                                  <a href="{{ $alias }}">
                                    <img src="{{ $image }}" alt="{{ $title }}">
                                  </a>
                                </div>
                                <h4 class="title"><a href="{{ $alias }}">{{ $title }}</a>
                                </h4><a href="{{ $alias }}" class="service-link"><i
                                    class="fal fa-arrow-right"></i></a>
                              </div>
                            @endforeach

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
          {{ $posts->withQueryString()->links('frontend.pagination.default') }}
        </div>
      </div>
    </div>
  </div> --}}
  {{-- End content --}}
  <div id="content">
    @if($taxonomy->parent_id==null)
      @isset($row)
      <section id="banner-shareholder" class="position-relative">
        <img class="img-fluid w-100" src="{{ $image }}" alt="{{ $title }}">
        <div class="bottom d-flex align-items-center">
          <a href="{{ route('frontend.home') }}">@lang('home')</a>
          <img class="mx-2" src="image/arrow.png" alt="arrow">
          <a href="#" class="bold">{{ $title }}</a>
        </div>
      </section>
      <section id="shareholder-list">
        <div class="container container-1160">
          <div class="row">
            @foreach($row as $item)
              @php
                $title = $item->json_params->title->{$locale} ?? $item->title;
                $description = $item->json_params->description->{$locale} ?? $item->description;
                $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                // Viet ham xu ly lay slug

                $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['service'], $item->alias ?? $item->title, $item->id);
                // $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['service'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
                $poster = App\Models\Admin::where('status', 'active')->where('id', $item->admin_created_id)->first()->name;
              @endphp
              <div class="col-lg-6 col-12">
                <div class="shareholder-item">
                  <div class="new-item">
                    <div class="new-border">
                      <div class="sub-border"></div>
                      <div class="main-border"></div>
                    </div>
                    <div class="new-title text-uppercase">New</div>
                  </div>
                  <h3 class="title">{{ $title }}</h3>
                  <p class="desc">
                    {{ $description }}
                  </p>
                  <a href="{{ $alias_category }}" class="btn btn-more">@lang('View detail')</a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
      @endisset
    @else
    
      @isset($row)
      <section id="banner-shareholder" class="position-relative">
        <img class="img-fluid w-100" src="{{ $image }}" alt="{{ $title }}">
        <div class="bottom d-flex align-items-center">
          <a href="{{ route('frontend.home') }}">@lang('home')</a>
          <img class="mx-2" src="image/arrow.png" alt="arrow">
          <a href="{{ $alias_parent }}">{{ $title_parent }}</a>
          <img class="mx-2" src="image/arrow.png" alt="arrow">
          <a href="#" class="bold">{{ $title }}</a>
        </div>
      </section>
      <section id="shareholder-detail">
        <div class="container container-1160">
          <h2 class="title blod text-uppercase position-relative">
            <div class="arrow-img">
              <img src="image/left.png" alt="arrow">
            </div>
            {{ $title }}
          </h2>
          <ul class="time-line list-unstyled m-0 d-flex">
            @foreach($row as $item)
              @php
                $title = $item->json_params->title->{$locale} ?? $item->title;
              @endphp
              @if($loop->first)
              <li class="nav-link active" data-id="{{ $item->id }}">{{ $title }}</li>
              @else
              <li class="nav-link" data-id="{{ $item->id }}">{{ $title }}</li>
              @endif
            @endforeach
          </ul>
          @foreach($row as $item)
            @php
              $services = App\Models\CmsPost::where('is_type', App\Consts::POST_TYPE['service'])
                      ->where('status', 'active')
                      ->where('taxonomy_id', $item->id)
                      ->get();
            @endphp
           
            @if($loop->first)
              @isset($services)
              <ul class="detail-list active list-unstyled " id="{{ $item->id }}">
                @foreach($services as $item)
                  @php
                    $title = $item->json_params->title->{$locale} ?? $item->title;
                    $file_download = $item->json_params->catalog ?? null;
                  @endphp
                  <li class="detail-item d-flex justify-content-between align-items-center">
                    <div class="item-title">
                      {{ $title }}
                    </div>
                    <div class="d-flex">
                      <div class="btn btn-download">
                        <a href="{{ $file_download }}" download>
                          <img src="image/download.svg" alt="icon">
                          Tải về
                        </a>
                        
                      </div>
                      <div class="btn btn-view">
                        <a href="{{ $file_download }}" target="_blank">
                          <img src="image/view.svg" alt="icon">
                          Xem file
                        </a>
                        
                      </div>
                    </div>
                  </li>
                @endforeach
              </ul>
              @endisset
            @else
              @isset($services)
              <ul class="detail-list list-unstyled" id="{{ $item->id }}">
                @foreach($services as $item)
                  @php
                    $title = $item->json_params->title->{$locale} ?? $item->title;
                    $file_download = $item->json_params->catalog ?? null;
                  @endphp
                  <li class="detail-item d-flex justify-content-between align-items-center">
                    <div class="item-title">
                      {{ $title }}
                    </div>
                    <div class="d-flex">
                      <div class="btn btn-download">
                        <a href="{{ $file_download }}" download>
                          <img src="image/download.svg" alt="icon">
                          Tải về
                        </a>
                      </div>
                      <div class="btn btn-view">
                        <a href="{{ $file_download }}" target="_blank">
                          <img src="image/view.svg" alt="icon">
                          Xem file
                        </a>
                      </div>
                    </div>
                  </li>
                @endforeach
              </ul>
              @endisset
            @endif
          @endforeach
        </div>
      </section>
      @endisset
    @endif
  </div>
@endsection
