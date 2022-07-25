<div class="form-group text-center" style="height: 45px">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId=<?php echo get_settings('fb_app_id') ?>&autoLogAppEvents=1" nonce="h58p64zo"></script>
    <div class="fb-login-button" onlogin="check_API()" data-width="" scope="public_profile,email" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="true"></div>

    <script type="text/javascript">
        function check_API() {                      // Testing Graph API after login.  See 
            FB.api('/me', function(response) {
                //   console.log('Successful login for: ' + response.name);
                //   console.log(response);
                if(response.name){
                    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
                        console.log(response.status);
                        if (response.status === 'connected') {   // Logged into your webpage and Facebook.
                            location.replace("<?php echo site_url('login/fb_validate_login/'); ?>"+response.authResponse.accessToken +'/' + response.authResponse.userID);
                        }
                    });
                }
            });
        }
    </script>
</div>

<div class="form-group">
  <div class="row justify-content-center">
    <div class="col-3 d-none d-sm-block">
      <hr class="w-100">
    </div>
    <div class="col-auto text-center text-13px fw-500 text-muted pt-1">
      <?php echo site_phrase('continue_with_email'); ?>
    </div>
    <div class="col-3 d-none d-sm-block">
      <hr class="w-100">
    </div>
  </div>
</div>