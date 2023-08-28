@extends('frontend.layouts.default')

@php
  $page_title = $taxonomy->title ?? ($page->title ?? $page->name);
  $seo_title = $page_title . (isset($params['keyword']) && $params['keyword'] != '' ? ': ' . $params['keyword'] : '');
  
  $image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');
@endphp
@push('style')
  <style>

  </style>
@endpush
@section('content')
  <div id="content">
    <section id="banner-category" class="position-relative">
      <img class="img-fluid w-100" src="{{ asset($image_background) }}" alt="{{ $page_title }}">
      <div class="bottom d-flex align-items-center">
        <a href="{{ route('frontend.home') }}">@lang('Home') </a>
        <img class="mx-2" src="{{ asset('image/arrow.png') }}" alt="arrow">
        <a href="#" class="bold">{{ $page_title }}</a>
      </div>
    </section>
    <section id="category-post">
      <div class="container container-1160">
        <div class="row">
          @if(isset($posts)&& $posts->count()>0)
            @foreach ($posts as $item)
              @php
                $title = $item->json_params->title->{$locale} ?? $item->title;
                $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                $image = $item->image != '' ? $item->image : ($item->image != '' ? $item->image : null);
                // $date = date('H:i d/m/Y', strtotime($item->created_at));
                $date = date('d', strtotime($item->created_at));
                $month = date('M', strtotime($item->created_at));
                $year = date('Y', strtotime($item->created_at));
                // Viet ham xu ly lay slug
                $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->taxonomy_alias ?? $item->taxonomy_title, $item->taxonomy_id);
                $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
                $poster = App\Models\Admin::where('status', 'active')->where('id', $item->admin_created_id)->first()->name;
              @endphp
              <div class="col-lg-4 col-md-4 col-12 ">
                  <div class="post-item">
                      <div class="post-item-top">
                          <a href="{{ $alias }}">
                              <img class="post-img img-fluid w-100" src="{{ $image }}" alt="{{ $title }}" >
                          </a>
                          <a href="{{ $alias }}">
                              <span class="post-title">{{ $title }}</span>
                          </a>
                      </div>
                      
                  </div>
              </div>
            @endforeach
          @else
            <div class="no_result">Không tìm thấy kết quả nào</div>
          @endif
        </div> 
      </div>
    </section>

  </div>
@endsection
