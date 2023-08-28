

@php
    if (isset($menu)) {
        $main_menu = $menu->first(function ($item, $key) {
            return $item->menu_type == 'header' && ($item->parent_id == null || $item->parent_id == 0);
        });
    
        $menu_chil = $menu->filter(function ($item, $key) use ($main_menu) {
            return $item->parent_id == $main_menu->id;
        });
    }
    
@endphp     

<div id="header">
  <div class="header-main">
    <div class="container container-header d-flex justify-content-between">
      <div class="d-flex">
        <a href="{{ route('frontend.home') }}" class="header-logo">
          <img class="img-fluid w-100 h-100" src="{{ $web_information->image->logo_header ?? '' }}" alt="logo header">
        </a>
        <div class="header-infor bold text-uppercase">
          {{ $web_information->information->site_name }}
          <div>{{ $web_information->information->seo_title }}</div>
        </div>
      </div>
      @isset($menu_chil)
      <div class="header-wrap">
        <div class="header-contact d-flex justify-content-end">
          {{-- <div class="d-flex justify-content-end">
            <div class="form-search">
              <form class="top-search-form" action="{{ route('frontend.search.index') }}" method="get">
                <input type="search" name="keyword" placeholder="@lang('Type and hit enter...')" value="{{ $params['keyword'] ?? '' }}"
                  class="form-control" />
              </form>
              
            </div>
            <a href="javascript:;" class="icon-search"><img src="{{asset('image/icon-search.png')}}" alt="search"></a>
          </div>
          @foreach ($menu_chil as $item)
            @if ($item->sub <= 0)
              @if (isset($item->json_params->image) && $item->json_params->image != '')
              <a href="{{ $item->url_link }}">
                <img class="flag-vn" src="{{ $item->json_params->image }}" alt="{{ $item->json_params->name->{$locale} ?? ($item->name ?? '') }}">
              </a>
              @endif
            @endif
          @endforeach --}}
          <div class="search-button">
            <form class="top-search-form" action="{{ route('frontend.search.index') }}" method="get">
              <input type="search" name="keyword" placeholder="@lang('Type and hit enter...')" value="{{ $params['keyword'] ?? '' }}" />
              <div class="icon">
                <img src="{{ asset('image/icon-search.png') }}" alt="search" />
              </div>
            </form>
          </div>
          <div class="img-lang">
            @foreach ($menu_chil as $item)
              @if ($item->sub <= 0)
                @if (isset($item->json_params->image) && $item->json_params->image != '')
                <a href="{{ $item->url_link }}"><img class="flag-{{ $item->json_params->name->{$locale} ?? ($item->name ?? '') }}" src="{{ $item->json_params->image }}" alt="{{ $item->json_params->name->{$locale} ?? ($item->name ?? '') }}"></a>
                @endif
              @endif
            @endforeach
          </div>
        </div>
        <ul class="header-menu bold d-flex list-unstyled m-0">
          @foreach ($menu_chil as $item)
            @if (isset($item->json_params->image) && $item->json_params->image != '')
            @else
              <li class="menu-item">
                <a href="{{ $item->url_link }}" class="menu-link">{{ $item->json_params->name->{$locale} ?? ($item->name ?? '') }}</a>
              </li>
            @endif
          @endforeach
        </ul>
      </div>
      @endisset
      <div class="icon-menu d-md-none">
        <i class="fa-solid fa-bars"></i>
      </div>
    </div>
  </div>
  <div class="overlay">
    <div class="content"></div>
    <div class="close">
      <i class="fa-solid fa-circle-xmark"></i>
    </div>
  </div>
  <div class="menu-mobile">
    <div class="text-center mb-5">
      <a href="{{ route('frontend.home') }}" class="header-logo py-3">
        <img class="img-fluid w-50" src="{{ $web_information->image->logo_header ?? '' }}" alt="logo header">
      </a>
    </div>
    <div class="search-mobile">
      <input type="text" name="search" placeholder="Tìm kiếm sản phẩm">
    </div>
    @isset($menu_chil)
    <ul class=" list-unstyled bold m-0 mt-3">
      @foreach ($menu_chil as $item)
        @if (isset($item->json_params->image) && $item->json_params->image != '')
        @else
        <li class="menu-item py-3">
          <a href="{{ $item->url_link }}" class="menu-link">{{ $item->json_params->name->{$locale} ?? ($item->name ?? '') }}</a>
        </li>
        @endif
      @endforeach
    </ul>
    @endisset
  </div>
</div>

@if (!Auth::guard('web')->check())
  @include('frontend.components.popup.login')
@endif