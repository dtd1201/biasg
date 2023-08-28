@extends('frontend.layouts.default')

@php
  $page_title = $taxonomy->json_params->title->{$locale} ?? ($page->title ?? $page->name);
  $image_background = $web_information->image->background_breadcrumbs ?? ($taxonomy->json_params->image_background ?? '');
  $title = $taxonomy->json_params->title->{$locale} ?? ($taxonomy->title ?? null);
  $image = $taxonomy->json_params->image ?? null;
  $params_product['status'] = App\Consts::POST_STATUS['active'];
  $params_product['is_type'] = App\Consts::POST_TYPE['product'];
  $params_product['order_by'] = 'iorder';
  
  $row = App\Http\Services\ContentService::getCmsPost($params_product)
      ->get();
@endphp
@section('content')
  <div id="content">
    <section id="banner-category" class="position-relative">
      <img class="img-fluid w-100" src="{{ $image }}" alt="{{ $page_title }}">
      <div class="bottom d-flex align-items-center">
        <a href="{{ route('frontend.home') }}">@lang('Home')</a>
        <img class="mx-2" src="image/arrow.png" alt="arrow">
        <a href="#" class="bold">{{ $page_title }}</a>
      </div>
    </section>
    @isset($row)
    <section id="category-product">
      @foreach($row as $key => $item)
        @php
          $category = App\Models\CmsTaxonomy::where('id', $item->taxonomy_id)->first();
          $alias_child = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $item->alias ?? $title, $item->id, 'detail', $category->title);
        @endphp
        @if($key % 2 == 0)
        <div class="product-detail">
          <div class="container container-category">
            <div class="row">
              <div class="col-lg-6 col-12 bg-content">
                <img class="img-fluid w-100 product-img" src="{{ $item->json_params->image->{$locale}??($item->image ?? '') }}" alt="{{ $item->json_params->title->{$locale}??($item->title ?? '') }}">
              </div>
              <div class="col-lg-6 col-12">
                <div class="detail-content">
                  <div class="detail-img detail-first">
                    <img src="{{ $item->json_params->image_logo->{$locale}??($item->image_logo ?? '') }}" alt="{{ $item->json_params->title->{$locale}??($item->title ?? '') }}">
                  </div>
                  <div class="detail-title">
                    "{{ $item->json_params->description->{$locale}??($item->description ?? '') }}"
                  </div>
                  <div class="desc">
                    {{ $item->json_params->brief->{$locale}??($item->brief ?? '') }}
                  </div>
                  <a href="{{ $alias_child }}" class="btn btn-more">@lang('View detail')</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @else
        <div class="product-detail reverse" style="background-image: url('{{ $taxonomy->json_params->image_background }}')">
          <div class="container container-category">
            <div class="row flex-row-reverse">
              <div class="col-lg-6 col-12 bg-content">
                <img class="img-fluid w-100 product-img" src="{{ $item->json_params->image->{$locale}??($item->image ?? '') }}" alt="{{ $item->json_params->title->{$locale}??($item->title ?? '') }}">
              </div>
              <div class="col-lg-6 col-12">
                <div class="detail-content">
                  <div class="detail-img">
                    <img src="{{ $item->json_params->image_logo->{$locale}??($item->image_logo ?? '') }}" alt="{{ $item->json_params->title->{$locale}??($item->title ?? '') }}">
                  </div>
                  <div class="detail-title">
                    "{{ $item->json_params->description->{$locale}??($item->description ?? '') }}"
                  </div>
                  <div class="desc">
                    {{ $item->json_params->brief->{$locale}??($item->brief ?? '') }}
                  </div>
                  <a href="{{ $alias_child }}" class="btn btn-more">@lang('View detail')</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
      @endforeach
    </section>
    @endisset
  </div>
@endsection

@push('script')
<script>
  
</script>
@endpush