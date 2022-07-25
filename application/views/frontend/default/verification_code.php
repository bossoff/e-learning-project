<section class="category-course-list-area">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="sign-up-form">
          <div class="row mb-4 mt-3">
            <div class="col-md-12 text-center">
              <h1 class="fw-700"><?php echo site_phrase('email_verification'); ?></h1>
              <p class="text-14px"><?php echo site_phrase('let_us_know_that_this_email_address_belongs_to_you'); ?> <?php echo site_phrase('Enter_the_code_from_the_email_sent_to').' <b>'.$this->session->userdata('register_email').'</b>'; ?></p>
            </div>
          </div>
          <form action="javascript:;" method="post" id="email_verification">
            <div class="form-group">
              <label for="verification_code"><?php echo site_phrase('verification_code'); ?></label>
              <div class="input-group">
                <span class="input-group-text bg-white" for="verification_code"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" placeholder="<?php echo site_phrase('enter_the_verification_code'); ?>" aria-label="<?php echo site_phrase('verification_code'); ?>" aria-describedby="<?php echo site_phrase('verification_code'); ?>" id="verification_code" required>
              </div>
              <a href="javascript:;" class="text-14px fw-500 text-muted" id="resend_mail_button" onclick="resend_verification_code()">
                <div class="float-start"><?= site_phrase('resend_mail') ?></div>
                <div id="resend_mail_loader" class="float-start ps-1"></div>
              </a>
            </div>

            <div class="form-group">
              <button type="button" onclick="continue_verify()" class="btn red radius-10 mt-4 w-100"><?php echo site_phrase('continue'); ?></button>
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


<script type="text/javascript">
  function continue_verify() {
    var email = '<?= $this->session->userdata('register_email'); ?>';
    var verification_code = $('#verification_code').val();
    $.ajax({
      type: 'post',
      url: '<?php echo site_url('login/verify_email_address/'); ?>',
      data: {verification_code : verification_code, email : email},
      success: function(response){
        if(response){
          window.location.replace('<?= site_url('home/login'); ?>');
        }else{
          location.reload();
        }
      }
    });
  }
  
  function resend_verification_code() {
    $("#resend_mail_loader").html('<img src="<?= base_url('assets/global/gif/page-loader-3.gif'); ?>" style="width: 25px;">');
    var email = '<?= $this->session->userdata('register_email'); ?>';
    $.ajax({
      type: 'post',
      url: '<?php echo site_url('login/resend_verification_code/'); ?>',
      data: {email : email},
      success: function(response){
        toastr.success('<?php echo site_phrase('mail_successfully_sent_to_your_inbox');?>');
        $("#resend_mail_loader").html('');
      }
    });
  }
</script>
