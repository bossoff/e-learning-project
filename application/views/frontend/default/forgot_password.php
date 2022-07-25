<?php if(get_frontend_settings('recaptcha_status')): ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

<section class="category-course-list-area">
    <div class="container">
      <div class="row mb-4 mt-3">
        <div class="col-md-12 text-center">
          <h1 class="fw-700"><?php echo site_phrase('forgot_password'); ?></h1>
          <p class="text-14px"><?php echo site_phrase('provide_your_valid_email_address'); ?></p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="sign-up-form">
            <form action="<?php echo site_url('login/forgot_password/frontend'); ?>" method="post" id="forgot_password">
              <div class="form-group">
                <label for="forgot-password-email"><?php echo site_phrase('your_email'); ?></label>
                <div class="input-group">
                  <span class="input-group-text bg-white" for="forgot-password-email"><i class="fas fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control" placeholder="<?php echo site_phrase('email'); ?>" aria-label="<?php echo site_phrase('email'); ?>" aria-describedby="<?php echo site_phrase('email'); ?>" id="forgot-password-email" required>
                </div>
              </div>

              <?php if(get_frontend_settings('recaptcha_status')): ?>
                <div class="form-group mt-4 mb-0">
                  <div class="g-recaptcha" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                </div>
              <?php endif; ?>

              <div class="form-group">
                <button type="submit" class="btn red radius-10 mt-4 w-100"><?php echo site_phrase('send_request'); ?></button>
              </div>

              <div class="form-group mt-4 mb-0 text-center">
                <?php echo site_phrase('want_to_go_back'); ?>?
                <a class="text-15px fw-700" href="<?php echo site_url('home/login') ?>"><?php echo site_phrase('login'); ?></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>