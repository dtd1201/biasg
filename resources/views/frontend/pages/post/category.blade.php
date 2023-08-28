@extends('frontend.layouts.default')

@php
  $page_title = $taxonomy->title ?? ($page->title ?? $page->name);
  $image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');
  $title = $taxonomy->json_params->title->{$locale} ?? ($taxonomy->title ?? null);
  $image = $taxonomy->json_params->image ?? null;
  $seo_title = $taxonomy->json_params->seo_title ?? $title;
  $seo_keyword = $taxonomy->json_params->seo_keyword ?? null;
  $seo_description = $taxonomy->json_params->seo_description ?? null;
  $seo_image = $image ?? null;
@endphp

@section('content')
  <div id="content">
    <section id="banner-category" class="position-relative">
      <img class="img-fluid w-100" src="{{ $image }}" alt="{{ $page_title }}">
      <div class="bottom d-flex align-items-center">
        <a href="{{ route('frontend.home') }}">@lang('Home') </a>
        <img class="mx-2" src="image/arrow.png" alt="arrow">
        <a href="#" class="bold">{{ $page_title }}</a>
      </div>
    </section>
    <section id="category-post">
      <div class="container container-1160">
          <div class="post-title-box">
              <div class="post-title">
                  <h1 class="title">
                    {{ $page_title }}
                  </h1>
                  <span class="des">Khám phá những điều mới mẻ trong những ngày qua</span>
              </div>
              <div class="post-social-box">
                  <div class="post-social-item">
                      <a href="{{ $web_information->social->facebook }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                          <path d="M13.5279 20.9972V12.8012H16.2929L16.7039 9.59215H13.5279V7.54815C13.5279 6.62215 13.7859 5.98815 15.1149 5.98815H16.7989V3.12715C15.9799 3.03915 15.1559 2.99715 14.3319 3.00015C11.8879 3.00015 10.2099 4.49215 10.2099 7.23115V9.58615H7.46289V12.7951H10.2159V20.9972H13.5279Z" stroke="black"/>
                        </svg>
                      </a>
                      {{-- <span class="social-des">3.7 M</span> --}}
                  </div>
                  <div class="post-social-item">
                      <a href="{{ $web_information->social->instagram }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M7.96289 3.5H16.9629V2.5H7.96289V3.5ZM3.96289 7.5C3.96289 5.30053 5.76419 3.5 7.96289 3.5V2.5C5.21204 2.5 2.96289 4.74812 2.96289 7.5H3.96289ZM3.96289 16.5V7.5H2.96289V16.5H3.96289ZM7.96289 20.5C5.76426 20.5 3.96289 18.6986 3.96289 16.5H2.96289C2.96289 19.2509 5.21197 21.5 7.96289 21.5V20.5ZM16.9629 20.5H7.96289V21.5H16.9629V20.5ZM20.9629 16.5C20.9629 18.6986 19.1615 20.5 16.9629 20.5V21.5C19.7138 21.5 21.9629 19.2509 21.9629 16.5H20.9629ZM20.9629 7.5V16.5H21.9629V7.5H20.9629ZM16.9629 3.5C19.1616 3.5 20.9629 5.30053 20.9629 7.5H21.9629C21.9629 4.74812 19.7137 2.5 16.9629 2.5V3.5ZM8.21282 12C8.21282 14.3466 10.1154 16.2499 12.4629 16.2499V15.2499C10.6677 15.2499 9.21282 13.7943 9.21282 12H8.21282ZM12.4629 7.74993C10.1154 7.74993 8.21282 9.65251 8.21282 12H9.21282C9.21282 10.2048 10.6677 8.74993 12.4629 8.74993V7.74993ZM16.713 12C16.713 9.65243 14.8094 7.74993 12.4629 7.74993V8.74993C14.2573 8.74993 15.713 10.2049 15.713 12H16.713ZM12.4629 16.2499C14.8094 16.2499 16.713 14.3466 16.713 12H15.713C15.713 13.7943 14.2572 15.2499 12.4629 15.2499V16.2499ZM17.338 7.74992C16.9924 7.74992 16.713 7.4702 16.713 7.12492H15.713C15.713 8.0221 16.4397 8.74992 17.338 8.74992V7.74992ZM17.963 7.12492C17.963 7.4702 17.6835 7.74992 17.338 7.74992V8.74992C18.2362 8.74992 18.963 8.0221 18.963 7.12492H17.963ZM17.338 6.49992C17.6835 6.49992 17.963 6.77965 17.963 7.12492H18.963C18.963 6.22775 18.2362 5.49992 17.338 5.49992V6.49992ZM16.713 7.12492C16.713 6.77965 16.9924 6.49992 17.338 6.49992V5.49992C16.4397 5.49992 15.713 6.22775 15.713 7.12492H16.713Z" fill="black"/>
                        </svg>
                      </a>
                      {{-- <span class="social-des">2.4 M</span> --}}
                  </div>
                  <div class="post-social-item">
                      <a href="{{ $web_information->social->twitter }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M20.2697 7.978C20.2827 8.153 20.2827 8.327 20.2827 8.501C20.2827 13.826 16.2297 19.962 8.82272 19.962C6.54072 19.962 4.42072 19.301 2.63672 18.153C2.96072 18.19 3.27272 18.203 3.60972 18.203C5.49272 18.203 7.22572 17.567 8.61072 16.482C6.83972 16.445 5.35572 15.285 4.84372 13.689C5.09272 13.726 5.34272 13.751 5.60472 13.751C5.96572 13.751 6.32872 13.701 6.66572 13.614C4.81872 13.24 3.43572 11.619 3.43572 9.661V9.611C3.97272 9.91 4.59572 10.097 5.25572 10.122C4.17072 9.4 3.45972 8.165 3.45972 6.768C3.45972 6.02 3.65872 5.334 4.00772 4.736C5.99072 7.179 8.97172 8.776 12.3137 8.951C12.2517 8.651 12.2137 8.34 12.2137 8.028C12.2137 5.808 14.0097 4 16.2417 4C17.4017 4 18.4487 4.486 19.1847 5.272C20.0947 5.097 20.9667 4.76 21.7407 4.299C21.4417 5.234 20.8047 6.02 19.9697 6.519C20.7807 6.431 21.5667 6.207 22.2887 5.895C21.7407 6.693 21.0557 7.404 20.2697 7.978Z" stroke="black"/>
                        </svg>
                      </a>
                      {{-- <span class="social-des">3.7 M</span> --}}
                  </div>
                  <div class="post-social-item">
                      <a href="{{ $web_information->social->youtube }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M22.4649 6.58254L22.9616 6.52501L22.9613 6.52302L22.4649 6.58254ZM20.467 4.54652L20.5316 4.05071L20.5287 4.05034L20.467 4.54652ZM22.4649 17.1973L22.9614 17.2568L22.9616 17.2548L22.4649 17.1973ZM20.467 19.2333L20.5287 19.7295L20.5311 19.7292L20.467 19.2333ZM2.80924 19.2333L2.74512 19.7292L2.74757 19.7295L2.80924 19.2333ZM0.810539 17.1973L0.313858 17.2548L0.314095 17.2568L0.810539 17.1973ZM0.810539 6.58254L0.314091 6.52302L0.31386 6.52501L0.810539 6.58254ZM2.80924 4.54652L2.74757 4.05033L2.74484 4.05069L2.80924 4.54652ZM9.78131 15.6031H9.28131V16.5374L10.0587 16.0192L9.78131 15.6031ZM9.78131 8.17777L10.0587 7.76175L9.28131 7.24348V8.17777H9.78131ZM15.3503 11.8906L15.6276 12.3066L16.2517 11.8906L15.6276 11.4746L15.3503 11.8906ZM22.9613 6.52302C22.8873 5.90511 22.5657 5.32957 22.1396 4.89546C21.7137 4.46163 21.1454 4.13068 20.5316 4.05071L20.4024 5.04233C20.7504 5.08767 21.1226 5.28703 21.426 5.59602C21.7291 5.90475 21.9256 6.28456 21.9685 6.64206L22.9613 6.52302ZM22.9616 17.2548C23.3801 13.643 23.3801 10.1379 22.9616 6.52501L21.9682 6.64007C22.3779 10.1766 22.3778 13.6044 21.9682 17.1397L22.9616 17.2548ZM20.5311 19.7292C21.1453 19.6498 21.7137 19.3187 22.1396 18.8847C22.5658 18.4504 22.8873 17.8746 22.9613 17.2568L21.9685 17.1377C21.9256 17.4953 21.729 17.8754 21.4259 18.1843C21.1226 18.4934 20.7505 18.6925 20.403 18.7374L20.5311 19.7292ZM2.74757 19.7295C8.65126 20.4633 14.6234 20.4632 20.5287 19.7295L20.4054 18.7371C14.5819 19.4607 8.69268 19.4607 2.87091 18.7371L2.74757 19.7295ZM0.314095 17.2568C0.388175 17.8746 0.70966 18.4504 1.13598 18.8847C1.56203 19.3186 2.13063 19.6497 2.74512 19.7291L2.87336 18.7374C2.52526 18.6924 2.15298 18.4931 1.84957 18.1841C1.54642 17.8753 1.34985 17.4953 1.30698 17.1377L0.314095 17.2568ZM0.31386 6.52501C-0.10462 10.1379 -0.104621 13.6427 0.313862 17.2548L1.30722 17.1397C0.897595 13.6041 0.897593 10.1766 1.30722 6.64007L0.31386 6.52501ZM2.74484 4.05069C2.13057 4.13047 1.56207 4.46141 1.13601 4.89533C0.709693 5.32949 0.388179 5.90512 0.314095 6.52302L1.30698 6.64206C1.34985 6.28455 1.54639 5.90468 1.84954 5.59595C2.15294 5.28696 2.52532 5.0876 2.87364 5.04236L2.74484 4.05069ZM20.5287 4.05034C14.6231 3.31655 8.65126 3.31655 2.74757 4.05034L2.87091 5.04271C8.69268 4.3191 14.5816 4.3191 20.4054 5.04271L20.5287 4.05034ZM10.2813 15.6031V8.17777H9.28131V15.6031H10.2813ZM15.0729 11.4746L9.50396 15.1871L10.0587 16.0192L15.6276 12.3066L15.0729 11.4746ZM9.50395 8.59379L15.0729 12.3066L15.6276 11.4746L10.0587 7.76175L9.50395 8.59379Z" fill="black"/>
                        </svg>
                      </a>
                      {{-- <span class="social-des">2.4 M</span> --}}
                  </div>
              </div>
          </div>
          <div class="row">
              @foreach ($posts as $item)
                @php
                  $title = $item->json_params->title->{$locale} ?? $item->title;
                  $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                  $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                  
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
                                <img class="post-img" src="{{ $image }}" alt="{{ $title }}">
                            </a>
                            <a href="{{ $alias }}">
                                <span class="post-title">{{ $title }}</span>
                            </a>
                        </div>
                        <div class="post-item-des">
                            <div class="post-info-box">
                                <div class="poster">
                                    {{-- <img src="" alt=""> --}}
                                    <span>{{ $poster }}</span>
                                </div>
                                <div class="space"></div>
                                <div class="post-count-share">
                                    <span>Ngày {{ $date }}, {{ $year }}</span>
                                    {{-- <a class="share" href="">
                                        <span></span>
                                        <div class="share-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="14" viewBox="0 0 12 14" fill="none">
                                                <path d="M2.36364 8.375C3.11675 8.375 3.72727 7.75939 3.72727 7C3.72727 6.24061 3.11675 5.625 2.36364 5.625C1.61052 5.625 1 6.24061 1 7C1 7.75939 1.61052 8.375 2.36364 8.375Z" stroke="#6C757D" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9.63707 4.25C10.3902 4.25 11.0007 3.63439 11.0007 2.875C11.0007 2.11561 10.3902 1.5 9.63707 1.5C8.88396 1.5 8.27344 2.11561 8.27344 2.875C8.27344 3.63439 8.88396 4.25 9.63707 4.25Z" stroke="#6C757D" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9.63707 12.5C10.3902 12.5 11.0007 11.8844 11.0007 11.125C11.0007 10.3656 10.3902 9.75 9.63707 9.75C8.88396 9.75 8.27344 10.3656 8.27344 11.125C8.27344 11.8844 8.88396 12.5 9.63707 12.5Z" stroke="#6C757D" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M3.55078 7.67407L8.4468 10.451M8.4468 3.54907L3.55078 6.326" stroke="#6C757D" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>1K chia sẻ</span>
                                        </div>
                                    </a> --}}
                                </div>
                            </div>
                            <div class="desc">
                                {{ $brief }}
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach
              <div class="box-btn">
                <a href="{{ $alias }}" class="btn btn-see-more">@lang('View detail')</a>
              </div>
          </div>
          
      </div>
    </section>
  </div>
@endsection
