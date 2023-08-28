@extends('frontend.layouts.default')

@php
  $url = URL::to('/');
  $page_title = $taxonomy->title ?? ($page->title ?? ($page->name ?? ''));
  $image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');
@endphp


@section('content')
  <div id="contact">
    <div class="contact-banner position-relative">
      <img class="img-fluid w-100" src="{{ $image_background }}" alt="banner contact">
      <div class="bottom d-flex align-items-center">
        <a href="{{ route('frontend.home') }}">@lang('Home')</a>
        <img class="mx-2" src="image/arrow.png" alt="arrow">
        <a href="#" class="bold">{{ $page_title }}</a>
      </div>
    </div>
    
    <div class="container container-1160 mb-5">
      <div class="title">{{ $web_information->information->site_name }}</div>
      <p class="contact-more">Mọi thông tin chi tiết xin vui lòng liên hệ</p>
      <div class="row form-contact">
        <div class="col-lg-6 col-12">
          <form class="mb-0 form_ajax" method="post" action="{{ route('frontend.contact.store') }}">
            @csrf
            <div class="form-group">
              <input type="text" class=" required form-control" name="name"  placeholder="@lang('Fullname') *" required>
            </div>
            <div class="form-group">
              <input type="email" pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$" class="required form-control" name="email"  placeholder="Email *" required>
            </div>
            <div class="form-group">
              <input type="text" class="required form-control" name="json_params[address]"  placeholder="@lang('Address') *" required>
            </div>
            <div class="form-group">
              <input type="tel" pattern="^[0-9\-\+]{9,15}$" class="required form-control" name="phone"  placeholder="@lang('phone') *" required>
            </div>
            {{-- <div class="form-group">
              <input type="text" class="form-control w-50" name="code"  placeholder="Mã bảo vệ *">
            </div>  --}}
            <textarea name="content" id="" rows="7" class="w-100" placeholder="@lang('Content')"></textarea>
            <input type="hidden" name="is_type" value="contact">
            <button type="submit" class="btn btn-submit w-100">Gửi</button>
          </form>
        </div>
        <div class="col-lg-6 col-12">
          <ul class="contact-infor p-0">
            {{-- <li class="d-flex align-items-center">
              <img src="image/fax.png" alt="fax">
              Fax: 02703. 895 688
            </li> --}}
            <li class="d-flex align-items-center">
              <img src="image/web.png" alt="fax">
              {{ $url }}
            </li>
            <li class="d-flex align-items-center">
              <img src="image/phone.png" alt="fax">
              {{ $web_information->information->phone }}
            </li>
            <li class="d-flex align-items-center">
              <img src="image/email.png" alt="fax">
              {{ $web_information->information->email }}
            </li>
            <li class="d-flex align-items-center">
              <img src="image/address.png" alt="fax">
              {{ $web_information->information->address }}
            </li>
          </ul>
        </div>
      </div>
      <div class="map">
        {!! $web_information->source_code->map !!}
      </div>
    </div>
  </div>
@endsection
