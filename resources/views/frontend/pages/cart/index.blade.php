@extends('frontend.layouts.default')

@php
$page_title = $taxonomy->title ?? ($page->title ?? ($page->name ?? ''));
$image_background = $web_information->image->background_breadcrumbs ?? ($taxonomy->json_params->image_background ?? '');
$data = session('cart');
@endphp

@section('content')
  {{-- Print all content by [module - route - page] without blocks content at here --}}

  <section id="page-title" style="background-image: url('{{ $image_background }}'); background-size: cover;"
    data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">
    <div id="particles-line"></div>
    <div class="container clearfix">
      <h1 class="text-center">{{ $page_title }}</h1>
    </div>
  </section>

  <section id="content">
    <div class="content-wrap">
      <div class="container py-5">
        @if (session('cart'))
          @include('frontend.components.cart.cart-components',[
          ])
          {{--<div class="cart-wrapper">
            <table class="table cart mb-5">
              <thead>
                <tr>
                  <th class="cart-product-remove">&nbsp;</th>
                  <th class="cart-product-thumbnail">&nbsp;</th>
                  <th class="cart-product-name">@lang('Product')</th>
                  <th class="cart-product-name">@lang('Size')</th>
                  <th class="cart-product-price">@lang('Price') </th>
                  <th class="cart-product-quantity">@lang('Quantity')</th>
                  <th class="cart-product-subtotal">@lang('Total')</th>
                </tr>
              </thead>
              <tbody>
                @php $total = 0;@endphp
                @foreach (session('cart') as $id => $details)
                  @php
                    $total += $details['price'] * $details['quantity'];
                    $alias_detail = Str::slug($details['title']);
                    $url_link = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $alias_detail, $id, 'detail', 'san-pham');
                  @endphp
                  <tr class="cart_item" data-id="{{ $id }}">
                    <td class="cart-product-remove">
                      <a href="javascript:void(0)" class="remove remove-from-cart" title="@lang('Remove this item')">
                        <i class="fa-solid fa-trash-can"></i>
                      </a>
                    </td>
                    <td class="cart-product-thumbnail">
                      <a href="{{ $url_link }}">
                        <img width="64" height="64" src="{{ $details['image_thumb'] ?? $details['image'] }}"
                          alt="{{ $details['title'] }}">
                      </a>
                    </td>
                    <td class="cart-product-name">
                      <a href="{{ $url_link }}">{{ $details['title'] }}</a>
                    </td>
                    <td class="cart-product-size">
                      <span class="amount">
                        {{ $details['size'] ?? '' }} g
                      </span>
                    </td>
                    <td class="cart-product-price">
                      <span class="amount">
                        {{ isset($details['price']) && $details['price'] > 0 ? number_format($details['price']) : __('Contact') }}
                      </span>
                    </td>
                    <td class="cart-product-quantity">
                      <div class="quantity d-flex">
                        <input type="button" value="-" class="minus">
                        <input type="text" name="quantity" value="{{ $details['quantity'] }}" autocomplete="off"
                          class="qty update-cart" />
                        <input type="button" value="+" class="plus">
                      </div>
                    </td>
                    <td class="cart-product-subtotal">
                      <span class="amount">{{ number_format($details['price'] * $details['quantity']) }}</span>
                    </td>
                  </tr>
                @endforeach
                <tr class="cart_item">
                  <td colspan="5">
                    <div class="row justify-content-between my-4">
                      <div class="col-lg-12">
                        <a href="{{ url()->current() }}" class="button btn-update m-0">@lang('Update Cart')</a>
                      </div>
                    </div>
                  </td>
                  <td class="cart-product-subtotal">
                    <span class="amount text-danger">
                      <strong>
                        {{ number_format($total) }}
                      </strong>
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>--}}
          <div class="row col-mb-30">
            <div class="col-lg-12">
              <h4 class="text-uppercase mb-4">@lang('Submit Order Cart')</h4>
              <form class="row" method="POST" action="{{ route('frontend.order.store.product') }}">
                @csrf
                <div class="col-md-4 form-group">
                  <label for="name">@lang('Fullname') <small class="text-danger">*</small></label>
                  <input type="text" class="sm-form-control" placeholder="@lang('Fullname') *" id="name"
                    name="name" required value="{{ $user_auth->name ?? old('name') }}" />
                </div>
                <div class="col-md-4 form-group">
                  <label for="email">@lang('Email')</label>
                  <input type="email" class="sm-form-control" placeholder="@lang('Email')" id="email"
                    name="email" value="{{ $user_auth->email ?? old('email') }}" />
                </div>
                <div class="col-md-4 form-group">
                  <label for="phone">@lang('Phone') <small class="text-danger">*</small></label>
                  <input type="text" class="sm-form-control" placeholder="@lang('Phone') *" id="phone"
                    name="phone" required value="{{ $user_auth->phone ?? old('phone') }}" />
                </div>
                <div class="col-md-4 form-group mt-4">
                  <label for="affiliate_code">@lang('Affiliate code')</label>
                  <input type="text" id="affiliate_code" name="affiliate_code"
                    value="{{ $user_auth->affiliate_code ?? old('affiliate_code') }}" class="sm-form-control"
                    placeholder="@lang('Affiliate code')" />
                </div>
                <div class="col-md-8 form-group mt-4">
                  <label for="address">@lang('Address')</label>
                  <input type="text" class="sm-form-control" placeholder="@lang('Address')" id="address"
                    name="address" value="{{ old('address') }}" />
                </div>

                <div class="col-md-12 form-group mt-4">
                  <label for="customer_note">@lang('Content note')</label>
                  <textarea id="customer_note" name="customer_note" rows="5" cols="30"
                    placeholder="@lang('Content note')" autocomplete="off">{{ old('customer_note') }}</textarea>
                </div>
                <div class="col-12 form-group">
                  <button type="submit" class="button btn-update mt-5">@lang('Submit Order')</button>
                </div>
              </form>
            </div>
          </div>
        @else
          <div class="row">
            <div class="col-lg-12">
              <div class="style-msg alertmsg">
                <div class="sb-msg">
                  <i class="icon-warning-sign"></i>
                  <strong>@lang('Warning!')</strong>
                  @lang('Cart is empty!')
                </div>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>
@endsection