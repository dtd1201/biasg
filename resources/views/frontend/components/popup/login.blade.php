<div class="modal">
  <div id="modal-sign-up">
    <div class="wrap-card">
      <div class="card m-auto" style="max-width: 540px">
        <div class="card-header py-5 text-center">
          <h3 class="mb-0 fw-normal">Chào mừng quay trở lại !</h3>
        </div>
        <div class="card-body mx-auto py-5" style="max-width: 70%">
          <form
            id="login_form"
            name="login_form"
            class="mb-0 row"
            action="{{ route('frontend.login.post') }}"
            method="post"
          >
          @csrf
            <div class="col-12 mb-3">
              <input
                type="text"
                name="email"
                value=""
                class="form-control not-dark"
                placeholder="@lang('Username')"
                required
              />
            </div>
    
            <div class="col-12 my-4">
              <input
                type="password"
                name="password"
                value=""
                class="form-control not-dark"
                placeholder="@lang('Password')"
              />
            </div>
    
            <div class="col-12 mt-4 mb-5">
              <button
                class="button login_button w-100 m-0"
                id="login-form-submit"
                name="login-form-submit"
                value="login"
              >
                @lang('Login')
              </button>
            </div>
            {{-- <p class="text-center mt-3 mb-0">Hoặc đăng nhập bằng</p>
            <div class="col-12 mt-4 social-login d-flex justify-content-center">
              <div class="facebook-login">
                <a href="{{ route('frontend.provider', ['provider' => 'facebook']) }}">Facebook</a>
              </div>
              <div class="google-login">
                <a href="{{ route('frontend.provider', ['provider' => 'google']) }}">Google</a>
              </div>
            </div> --}}
            <div class="col-12 form-group login_result d-none">
                <div class="alert alert-warning" role="alert">
                  @lang('Processing...')
                </div>
              </div>
    
              @php
                $referer = request()->headers->get('referer');
                $current = url()->full();
              @endphp
              <input type="hidden" name="referer" value="{{ $referer }}">
              <input type="hidden" name="current" value="{{ $current }}">
          </form>
        </div>
        <div class="card-footer py-5 text-center">
          <p class="mb-0">
            Chưa có tài khoản? <span class="btn-register text-primary">Đăng ký</span></a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div id="modal-register">
    <div class="wrap-card">
      <div class="card m-auto" style="max-width: 540px">
        <div class="card-header py-5 text-center">
          <h3 class="mb-0 fw-normal">@lang('Signup an account')</h3>
        </div>
        <div class="card-body mx-auto py-5" style="max-width: 70%">
          <form
            id="signup_form"
            name="signup_form"
            class="mb-0 row"
            action="{{ route('frontend.signup.post') }}"
            method="post"
          >
          @csrf
            <div class="col-12">
              <input
                type="text"
                name="name"
                value=""
                class="form-control not-dark"
                placeholder="@lang('Username')"
                required
              />
            </div>
            
            <div class="col-12 mt-4">
              <input
                type="text"
                name="phone"
                value=""
                class="form-control not-dark"
                placeholder="@lang('Phone')"
                required
              />
            </div>
    
            <div class="col-12 mt-4">
              <input
                type="text"
                name="email"
                value=""
                class="form-control not-dark"
                placeholder="@lang('Email')"
                required
              />
            </div>
            
            <div class="col-12 mt-4">
              <input
                type="password"
                name="password"
                value=""
                class="form-control not-dark"
                placeholder="@lang('Password')"
              />
            </div>
    
            <div class="col-12 my-5">
              <button
                class="button login_button w-100 m-0"
                name="login-form-submit"
                value="login"
              >
                @lang('Signup an account')
              </button>
            </div>
              <div class="col-12 form-group signup_result d-none">
                <div class="alert alert-warning" role="alert">
                  @lang('Processing...')
                </div>
              </div>
    
              @php
                $referer = request()->headers->get('referer');
                $current = url()->full();
              @endphp
              <input type="hidden" name="referer" value="{{ $referer }}">
              <input type="hidden" name="current" value="{{ $current }}">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


