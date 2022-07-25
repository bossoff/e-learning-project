<section class="category-course-list-area">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="sign-up-form">
          <div class="row mb-4 mt-3">
            <div class="col-md-12 text-center">
              <h1 class="fw-700"><?php echo site_phrase('change_password'); ?></h1>
              <p class="text-14px"><?php echo site_phrase('enter_your_new_password'); ?> </p>
            </div>
          </div>
          <form action="<?php echo site_url('login/change_password/'.$verification_code); ?>" method="post">
            <div class="form-group">
              <label for="new_password"><?php echo site_phrase('new_password'); ?></label>
              <div class="input-group mb-3">
                <span class="input-group-text bg-white" for="new_password"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" placeholder="<?php echo site_phrase('enter_your_new_password'); ?>" aria-label="<?php echo site_phrase('new_password'); ?>" aria-describedby="<?php echo site_phrase('new_password'); ?>" name="new_password" id="new_password" required>
              </div>

              <label for="confirm_password"><?php echo site_phrase('confirm_password'); ?></label>
              <div class="input-group">
                <span class="input-group-text bg-white" for="confirm_password"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" placeholder="<?php echo site_phrase('confirm_password'); ?>" aria-label="<?php echo site_phrase('confirm_password'); ?>" aria-describedby="<?php echo site_phrase('confirm_password'); ?>" name="confirm_password" id="confirm_password" required>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn red radius-10 mt-4 w-100"><?php echo site_phrase('continue'); ?></button>
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
