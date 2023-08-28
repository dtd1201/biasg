@extends('frontend.layouts.default')

@php
  $title = $detail->json_params->title->{$locale} ?? $detail->title;
  $brief = $detail->json_params->brief->{$locale} ?? null;
  $content = $detail->json_params->content->{$locale} ?? null;
  $image = $detail->image != '' ? $detail->image : null;
  $image_thumb = $detail->image_thumb != '' ? $detail->image_thumb : null;
  $date = date('H:i d/m/Y', strtotime($detail->created_at));
  $count_view = $detail->count_visited ?? 0;
  
  // For taxonomy
  $taxonomy_json_params = json_decode($detail->taxonomy_json_params);
  $taxonomy_title = $taxonomy_json_params->title->{$locale} ?? $detail->taxonomy_title;
  $image_taxonomy = $taxonomy_json_params->image ?? null;
  $image_background = $taxonomy_json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? null);
  $taxonomy_alias = Str::slug($taxonomy_title);
  $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $taxonomy_alias, $detail->taxonomy_id);
  
  $seo_title = $detail->json_params->seo_title ?? $title;
  $seo_keyword = $detail->json_params->seo_keyword ?? null;
  $seo_description = $detail->json_params->seo_description ?? $brief;
  $seo_image = $image ?? ($image_thumb ?? null);
  
  // schema information
  $datePublished = date('Y-m-d', strtotime($detail->created_at));
  $dateModified = date('Y-m-d', strtotime($detail->updated_at));
  $poster = App\Models\Admin::where('status', 'active')->where('id', $detail->admin_created_id)->first()->name;
@endphp

@section('content')
  {{-- Print all content by [module - route - page] without blocks content at here --}}
  {{-- <section id="page-title">
    <div class="container text-center">
      <h1 class="mb-3">{{ $taxonomy_title }}</h1>
      <span>{{ $title }}</span>
    </div>
  </section>

  <section id="content">
    <div class="content-wrap">
      <div class="container my-5">
        <div class="row">
          <div class="postcontent col-lg-9">
            <div class="single-post mb-0">
              <div class="entry clearfix">
                <div class="entry-content mt-0" id="content-detail">
                  {!! $content ?? '' !!}
                  <hr class="mt-5">
                  <div class="si-share border-0 d-flex justify-content-between align-items-center mt-3">
                    <span>@lang('Share this post'):</span>
                    <div>
                      <a href="http://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}"
                        class="social-icon icon-facebook">
                        <i class="fa-brands fa-square-facebook"></i>
                      </a>
                      <a href="https://twitter.com/intent/tweet?url={{ Request::fullUrl() }}"
                        class="social-icon icon-twitter">
                        <i class="fa-brands fa-square-twitter"></i>
                      </a>
                      <a href="https://www.instagram.com/cws/share?url={{ Request::fullUrl() }}"
                        class="social-icon icon-instagram">
                        <i class="fa-brands fa-square-instagram"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              @if (isset($relatedPosts) && count($relatedPosts) > 0)
                <h4 class="title-widget text-uppercase">@lang('Related Posts')</h4>
                <div class="related-posts row posts-md col-mb-30">
                  @foreach ($relatedPosts as $item)
                    @php
                      $title = $item->json_params->title->{$locale} ?? $item->title;
                      $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                      $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                      $date = date('d/m/Y', strtotime($item->created_at));
                      // Viet ham xu ly lay slug
                      $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->taxonomy_alias ?? $item->taxonomy_title, $item->taxonomy_id);
                      $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
                    @endphp
                    <div class="entry col-12 col-md-6">
                      <div class="grid-inner row align-items-center gutter-20">
                        <div class="col-4 col-xl-5">
                          <div class="entry-image">
                            <a href="{{ $alias }}"><img src="{{ $image }}" alt="Blog Single"></a>
                          </div>
                        </div>
                        <div class="col-8 col-xl-7">
                          <div class="entry-title title-xs nott">
                            <h3><a href="{{ $alias }}">{{ Str::limit($title, 70) }}</a></h3>
                          </div>
                          <div class="entry-content d-none d-xl-block">
                            {{ Str::limit($brief, 100) }}
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endif
            </div>
          </div>
          @include('frontend.components.sidebar.post')
        </div>
      </div>
    </div>
  </section> --}}
  <div id="content">
    <section id="banner-category" class="position-relative">
      <img class="img-fluid w-100" src="{{ $image_taxonomy }}" alt="{{ $title }}">
      <div class="bottom d-flex align-items-center">
        <a href="{{ route('frontend.home') }}">@lang('Home')</a>
        <img class="mx-2" src="{{ asset('image/arrow.png') }}" alt="arrow">
        <a href="{{ $alias_category }}" class="bold">{{ $taxonomy_title }}</a>
        <img class="mx-2" src="{{ asset('image/arrow.png') }}" alt="arrow">
        <a href="#" class="bold">{{ $title }}</a>
      </div>
    </section>
    <section id="post-detail">
      <div class="container container-1160">
          <div class="row">
              <div class="col-lg-8 col-md-8 col-12 box-left">
                  <div class="post-detail">
                      <div class="post-detail-top">
                          <img class="post-img" src="{{ $image }}" alt="{{ $title }}">
                          <div class="post-info-box">
                              <div class="detail-info">
                                  <div class="poster">
                                      {{-- <img src="" alt=""> --}}
                                      <span>{{ $poster }}</span>
                                  </div>
                                  <div class="space"></div>
                                  <div class="post-count-info">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                                          <path d="M2.4 12.5H0V4.1H2.4V12.5ZM7.2 12.5H4.8V0.5H7.2V6.5V12.5ZM12 12.5H9.6V7.7H12V12.5Z" fill="#454545"/>
                                      </svg>
                                      <span>{{ $count_view }} lượt xem</span>
                                  </div>
                                  <div class="space"></div>
                                  {{-- <div class="post-count-info">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="14" viewBox="0 0 12 14" fill="none">
                                          <path d="M2.36364 8.375C3.11675 8.375 3.72727 7.75939 3.72727 7C3.72727 6.24061 3.11675 5.625 2.36364 5.625C1.61052 5.625 1 6.24061 1 7C1 7.75939 1.61052 8.375 2.36364 8.375Z" stroke="#6C757D" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M9.63707 4.25C10.3902 4.25 11.0007 3.63439 11.0007 2.875C11.0007 2.11561 10.3902 1.5 9.63707 1.5C8.88396 1.5 8.27344 2.11561 8.27344 2.875C8.27344 3.63439 8.88396 4.25 9.63707 4.25Z" stroke="#6C757D" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M9.63707 12.5C10.3902 12.5 11.0007 11.8844 11.0007 11.125C11.0007 10.3656 10.3902 9.75 9.63707 9.75C8.88396 9.75 8.27344 10.3656 8.27344 11.125C8.27344 11.8844 8.88396 12.5 9.63707 12.5Z" stroke="#6C757D" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M3.55078 7.67407L8.4468 10.451M8.4468 3.54907L3.55078 6.326" stroke="#6C757D" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round"/>
                                      </svg>
                                      <span>1K chia sẻ</span>
                                  </div> --}}
                              </div>
                          </div>
                          <span class="post-title">{{ $title }}</span>
                      </div>
                      <div class="post-detail-des">
                          {!! $content !!}
                      </div>

                      <div class="tag-share-box">
                          <div class="tag-share">
                              <span class="text-share">Chia sẻ</span>
                              <div class="share-social">
                                  <div class="share-social-icon">
                                    <a href="{{ $web_information->social->facebook }}">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M17 12.352C17 15.264 15.264 17 12.352 17H11.4C10.96 17 10.6 16.64 10.6 16.2V11.584C10.6 11.368 10.776 11.184 10.992 11.184L12.4 11.16C12.512 11.152 12.608 11.072 12.632 10.96L12.912 9.43201C12.936 9.28801 12.824 9.152 12.672 9.152L10.968 9.176C10.744 9.176 10.568 9.00001 10.56 8.78401L10.528 6.824C10.528 6.696 10.632 6.58401 10.768 6.58401L12.688 6.552C12.824 6.552 12.928 6.44801 12.928 6.31201L12.896 4.39199C12.896 4.25599 12.792 4.152 12.656 4.152L10.496 4.18401C9.168 4.20801 8.11201 5.296 8.13601 6.624L8.176 8.824C8.184 9.048 8.00801 9.22401 7.78401 9.23201L6.824 9.248C6.688 9.248 6.58401 9.35199 6.58401 9.48799L6.60801 11.008C6.60801 11.144 6.712 11.248 6.848 11.248L7.80801 11.232C8.03201 11.232 8.20799 11.408 8.21599 11.624L8.28799 16.184C8.29599 16.632 7.93599 17 7.48799 17H5.648C2.736 17 1 15.264 1 12.344V5.648C1 2.736 2.736 1 5.648 1H12.352C15.264 1 17 2.736 17 5.648V12.352Z" fill="black"/>
                                      </svg>
                                    </a>
                                  </div>
                                  <div class="share-social-icon">
                                      <a href="{{ $web_information->social->instagram }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M15.3577 4H8.65032C5.73687 4 4 5.736 4 8.648V15.344C4 18.264 5.73687 20 8.65032 20H15.3497C18.2631 20 20 18.264 20 15.352V8.648C20.008 5.736 18.2711 4 15.3577 4ZM12.004 15.104C10.2911 15.104 8.89844 13.712 8.89844 12C8.89844 10.288 10.2911 8.896 12.004 8.896C13.7168 8.896 15.1095 10.288 15.1095 12C15.1095 13.712 13.7168 15.104 12.004 15.104ZM16.7423 7.904C16.7023 8 16.6463 8.088 16.5743 8.168C16.4942 8.24 16.4062 8.296 16.3101 8.336C16.2141 8.376 16.11 8.4 16.006 8.4C15.7899 8.4 15.5898 8.32 15.4377 8.168C15.3657 8.088 15.3096 8 15.2696 7.904C15.2296 7.808 15.2056 7.704 15.2056 7.6C15.2056 7.496 15.2296 7.392 15.2696 7.296C15.3096 7.192 15.3657 7.112 15.4377 7.032C15.6218 6.848 15.9019 6.76 16.1581 6.816C16.2141 6.824 16.2621 6.84 16.3101 6.864C16.3582 6.88 16.4062 6.904 16.4542 6.936C16.4942 6.96 16.5342 7 16.5743 7.032C16.6463 7.112 16.7023 7.192 16.7423 7.296C16.7824 7.392 16.8064 7.496 16.8064 7.6C16.8064 7.704 16.7824 7.808 16.7423 7.904Z" fill="black"/>
                                        </svg>
                                      </a>
                                  </div>
                                  <div class="share-social-icon">
                                    <a href="{{ $web_information->social->twitter }}">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M20.2697 7.978C20.2827 8.153 20.2827 8.327 20.2827 8.501C20.2827 13.826 16.2297 19.962 8.82272 19.962C6.54072 19.962 4.42072 19.301 2.63672 18.153C2.96072 18.19 3.27272 18.203 3.60972 18.203C5.49272 18.203 7.22572 17.567 8.61072 16.482C6.83972 16.445 5.35572 15.285 4.84372 13.689C5.09272 13.726 5.34272 13.751 5.60472 13.751C5.96572 13.751 6.32872 13.701 6.66572 13.614C4.81872 13.24 3.43572 11.619 3.43572 9.661V9.611C3.97272 9.91 4.59572 10.097 5.25572 10.122C4.17072 9.4 3.45972 8.165 3.45972 6.768C3.45972 6.02 3.65872 5.334 4.00772 4.736C5.99072 7.179 8.97172 8.776 12.3137 8.951C12.2517 8.651 12.2137 8.34 12.2137 8.028C12.2137 5.808 14.0097 4 16.2417 4C17.4017 4 18.4487 4.486 19.1847 5.272C20.0947 5.097 20.9667 4.76 21.7407 4.299C21.4417 5.234 20.8047 6.02 19.9697 6.519C20.7807 6.431 21.5667 6.207 22.2887 5.895C21.7407 6.693 21.0557 7.404 20.2697 7.978Z" stroke="black"/>
                                      </svg>
                                    </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              @php
                $params_product['status'] = App\Consts::POST_STATUS['active'];
                $params_product['is_type'] = App\Consts::POST_TYPE['post'];
                $params_product['order_by'] = 'id';
                
                $recents = App\Http\Services\ContentService::getCmsPost($params_product)
                    ->limit(App\Consts::PAGINATE['sidebar'])
                    ->get();
              @endphp
              @isset($recents)
              <div class="col-lg-4 col-md-4 col-12 box-right">
                  <div class="sidebar-title">
                      <span>@lang('Latest news')</span>
                  </div>
                  <div class="sidebar-box-item">
                    @foreach ($recents as $item)
                      @php
                        $title = $item->json_params->title->{$locale} ?? $item->title;
                        $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                        $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                        $date = date('H:i d/m/Y', strtotime($item->created_at));
                        // Viet ham xu ly lay slug
                        $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
                      @endphp
                      <div class="post-item">
                          <div class="post-item-in">
                              <div class="post-item-top">
                                  <a href="{{ $alias }}">
                                      <img class="post-img" src="{{ $image }}" alt="{{ $title }}">
                                  </a>
                                  <a href="{{ $alias }}">
                                      <span class="post-title">{{ $title }}</span>
                                  </a>
                              </div>
                              <div class="post-item-des">
                                  <div class="desc">
                                      {{ $brief }}
                                  </div>
                              </div>
                          </div>
                      </div>
                    @endforeach
                  </div>
              </div>
              @endisset
          </div>
      </div>
    </section>
  </div>
@endsection
