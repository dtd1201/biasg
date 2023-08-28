<div class="modal1 mfp-hide" id="modal-sign-up">
  <div class="card mx-auto" style="max-width: 540px">
    <div class="card-header py-3 bg-transparent center">
      <h3 class="mb-0 fw-normal">Chào mừng quay trở lại !</h3>
    </div>
    <div class="card-body mx-auto py-5" style="max-width: 70%">
      <form
        id="login_form"
        name="login_form"
        class="mb-0 row"
        action="<?php echo e(route('frontend.login.post')); ?>"
        method="post"
      >
      <?php echo csrf_field(); ?>
        <div class="col-12">
          <input
            type="text"
            id="username"
            name="email"
            value=""
            class="form-control not-dark"
            placeholder="<?php echo app('translator')->get('Username'); ?>"
            required
          />
        </div>

        <div class="col-12 mt-4">
          <input
            type="password"
            id="password"
            name="password"
            value=""
            class="form-control not-dark"
            placeholder="<?php echo app('translator')->get('Password'); ?>"
          />
        </div>

        <div class="col-12 mt-4">
          <button
            class="button login_button w-100 m-0"
            id="login-form-submit"
            name="login-form-submit"
            value="login"
          >
            <?php echo app('translator')->get('Login'); ?>
          </button>
        </div>
        <p class="text-center mt-3 mb-0">Hoặc đăng nhập bằng</p>
        <div class="col-12 mt-4 social-login d-flex justify-content-center">
          <div class="facebook-login">
            <a href="<?php echo e(route('frontend.provider', ['provider' => 'facebook'])); ?>">Facebook</a>
          </div>
          <div class="google-login">
            <a href="<?php echo e(route('frontend.provider', ['provider' => 'google'])); ?>">Google</a>
          </div>
        </div>
        <div class="col-12 form-group login_result d-none">
            <div class="alert alert-warning" role="alert">
              <?php echo app('translator')->get('Processing...'); ?>
            </div>
          </div>

          <?php
            $referer = request()->headers->get('referer');
            $current = url()->full();
          ?>
          <input type="hidden" name="referer" value="<?php echo e($referer); ?>">
          <input type="hidden" name="current" value="<?php echo e($current); ?>">
      </form>
    </div>
    <div class="card-footer py-4 center">
      <p class="mb-0">
        Chưa có tài khoản? <a data-lightbox="inline" href="#modal-register"><u>Đăng ký</u></a><a href="<?php echo e(route('forget.password.get')); ?>" style="padding-left: 20px">Quên mật khẩu</a>
      </p>
    </div>
  </div>
</div>

<div class="modal1 mfp-hide" id="modal-register">
  <div class="card mx-auto" style="max-width: 540px">
    <div class="card-header py-3 bg-transparent center">
      <h3 class="mb-0 fw-normal"><?php echo app('translator')->get('Signup an account'); ?></h3>
    </div>
    <div class="card-body mx-auto py-5" style="max-width: 70%">
      <form
        id="signup_form"
        name="signup_form"
        class="mb-0 row"
        action="<?php echo e(route('frontend.signup.post')); ?>"
        method="post"
      >
      <?php echo csrf_field(); ?>
        <div class="col-12">
          <input
            type="text"
            id="name"
            name="name"
            value=""
            class="form-control not-dark"
            placeholder="<?php echo app('translator')->get('Username'); ?>"
            required
          />
        </div>
        
        <div class="col-12 mt-4">
          <input
            type="text"
            id="phone"
            name="phone"
            value=""
            class="form-control not-dark"
            placeholder="<?php echo app('translator')->get('Phone'); ?>"
            required
          />
        </div>

        <div class="col-12 mt-4">
          <input
            type="text"
            id="email"
            name="email"
            value=""
            class="form-control not-dark"
            placeholder="<?php echo app('translator')->get('Email'); ?>"
            required
          />
        </div>
        
        <div class="col-12 mt-4">
          <input
            type="password"
            id="password"
            name="password"
            value=""
            class="form-control not-dark"
            placeholder="<?php echo app('translator')->get('Password'); ?>"
          />
        </div>

        <div class="col-12 mt-4">
          <button
            class="button login_button w-100 m-0"
            id="login-form-submit"
            name="login-form-submit"
            value="login"
          >
            <?php echo app('translator')->get('Signup an account'); ?>
          </button>
        </div>
          <div class="col-12 form-group signup_result d-none">
            <div class="alert alert-warning" role="alert">
              <?php echo app('translator')->get('Processing...'); ?>
            </div>
          </div>

          <?php
            $referer = request()->headers->get('referer');
            $current = url()->full();
          ?>
          <input type="hidden" name="referer" value="<?php echo e($referer); ?>">
          <input type="hidden" name="current" value="<?php echo e($current); ?>">
      </form>
    </div>
  </div>
</div>
<?php /**PATH D:\xampp\htdocs\office\resources\views/frontend/components/popup/login.blade.php ENDPATH**/ ?>