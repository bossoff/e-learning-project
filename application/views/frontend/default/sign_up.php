<?php if(get_frontend_settings('recaptcha_status')): ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>



<section class="category-course-list-area">
    <div class="container">
        <div class="row mb-5 mt-3">
          <div class="col-md-12 text-center">
            <h1 class="fw-700"><?php echo site_phrase('sign_up'); ?></h1>
            <p class="text-14px"><?php echo site_phrase('sign_up_and_start_learning'); ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 d-none d-lg-block text-center">
            <img class="mt-5" width="80%" src="<?php echo base_url('uploads/system/sign_up.png'); ?>">
          </div>
          <div class="col-lg-6">
            <div class="sign-up-form">
              <?php if(get_settings('fb_social_login')) include "facebook_login.php"; ?>
              <form action="<?php echo site_url('login/register'); ?>" method="post" id="sign_up">
                <div class="form-group">
                  <label for="first_name"><?php echo site_phrase('first_name'); ?></label>
                  <div class="input-group">
                    <span class="input-group-text bg-white" for="first_name"><i class="fas fa-user"></i></span>
                    <input type="text" name="first_name" class="form-control" placeholder="<?php echo site_phrase('first_name'); ?>" aria-label="<?php echo site_phrase('first_name'); ?>" aria-describedby="<?php echo site_phrase('first_name'); ?>" id="first_name" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="last_name"><?php echo site_phrase('last_name'); ?></label>
                  <div class="input-group">
                    <span class="input-group-text bg-white" for="last_name"><i class="fas fa-user"></i></span>
                    <input type="text" name="last_name" class="form-control" placeholder="<?php echo site_phrase('last_name'); ?>" aria-label="<?php echo site_phrase('last_name'); ?>" aria-describedby="<?php echo site_phrase('last_name'); ?>" id="last_name" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="registration-email"><?php echo site_phrase('email'); ?></label>
                  <div class="input-group">
                    <span class="input-group-text bg-white" for="email"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="<?php echo site_phrase('email'); ?>" aria-label="<?php echo site_phrase('email'); ?>" aria-describedby="<?php echo site_phrase('email'); ?>" id="registration-email" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="registration-password"><?php echo site_phrase('password'); ?></label>
                  <div class="input-group">
                    <span class="input-group-text bg-white" for="password"><i class="fas fa-key"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="<?php echo site_phrase('password'); ?>" aria-label="<?php echo site_phrase('password'); ?>" aria-describedby="<?php echo site_phrase('password'); ?>" id="registration-password" required>
                  </div>
                </div>

                <?php if(get_frontend_settings('recaptcha_status')): ?>
                  <div class="form-group mt-4 mb-0">
                    <div class="g-recaptcha" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                  </div>
                <?php endif; ?>

                <div class="form-group">
                  <button type="submit" class="btn red radius-10 mt-4 w-100"><?php echo site_phrase('sign_up'); ?></button>
                </div>

                <div class="form-group mt-4 mb-0 text-center">
                  <?php echo site_phrase('already_have_an_account'); ?>?
                  <a class="text-15px fw-700" href="<?php echo site_url('home/login') ?>"><?php echo site_phrase('login'); ?></a>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</section>