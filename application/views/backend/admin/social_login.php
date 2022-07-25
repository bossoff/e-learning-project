<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('social_login_configuration'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <?php if (strpos(site_url(), 'https') !== 0): ?>
                    <div class="alert alert-danger">
                        <strong><?php echo  'SSL(https) '.get_phrase('issue'); ?> !</strong>
                        <br>
                        <?php echo get_phrase('you_must_use_an_SSL_supported_server_to_use_the_Facebook_login_feature'); ?>
                    </div>
                <?php endif; ?>

                <div class="col-lg-12">
                    <h4 class="mb-3 header-title">
                        <?php echo get_phrase('facebook_login');?>
                        <a target="_blank" href="https://developers.facebook.com/docs/development/create-an-app/"><i class="mdi mdi-information-outline" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('facebook_app_creation_instruction'); ?>"></i></a>
                    </h4>

                    <form class="required-form" action="<?php echo site_url('admin/social_login_settings/update'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="smtp_protocol"><?php echo get_phrase('facebook_login'); ?><span class="required">*</span></label>
                            <br>
                            <input type="radio" id="fb_social_login_active" name="fb_social_login" value="1" <?php if(get_settings('fb_social_login') == 1)echo 'checked'; ?>>
                            <label for="fb_social_login_active"><?php echo get_phrase('active'); ?></label>

                            <input type="radio" id="fb_social_login_disabled" name="fb_social_login" value="0" <?php if(get_settings('fb_social_login') != 1)echo 'checked'; ?>>
                            <label for="fb_social_login_disabled"><?php echo get_phrase('inactive'); ?></label>
                        </div>

                        <div class="form-group">
                            <label for="fb_app_id"><?php echo get_phrase('facebook_app_id'); ?><span class="required">*</span></label>
                            <input type="text" name = "fb_app_id" id = "fb_app_id" class="form-control" value="<?php echo get_settings('fb_app_id');  ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="fb_app_secret"><?php echo get_phrase('facebook_app_secret'); ?><span class="required">*</span></label>
                            <input type="text" name = "fb_app_secret" id = "fb_app_secret" class="form-control" value="<?php echo get_settings('fb_app_secret');  ?>" required>
                        </div>

                        <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase('save_changes'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
