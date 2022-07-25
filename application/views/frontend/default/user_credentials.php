<?php include "profile_menus.php"; ?>

<section class="user-dashboard-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <div class="user-dashboard-sidebar">
                    <div class="user-box">
                        <img src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="" class="img-fluid">
                        <div class="name">
                            <div class="name"><?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></div>
                        </div>
                    </div>
                    <div class="user-dashboard-menu">
                        <ul>
                            <li class="mb-3"><a href="<?php echo site_url('home/profile/user_profile'); ?>"> <i class="fas fa-user-circle"></i> <?php echo site_phrase('profile'); ?></a></li>
                            <li class="active mb-3"><a href="<?php echo site_url('home/profile/user_credentials'); ?>"> <i class="fas fa-lock"></i> <?php echo site_phrase('account'); ?></a></li>
                            <li class=" mb-3"><a href="<?php echo site_url('home/profile/user_photo'); ?>"> <i class="fas fa-camera-retro"></i> <?php echo site_phrase('photo'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-9 mt-4 mt-md-0">
                <form class="w-100 bg-white radius-10 p-4" action="<?php echo site_url('home/update_profile/update_credentials'); ?>" method="post">
                    <div class="row">
                        <div class="col-12 border-bottom mb-3 pb-3">
                            <h4><?php echo site_phrase('account_information'); ?></h4>
                            <p><?php echo site_phrase('edit_your_account_settings'); ?></p>
                        </div>




                        <div class="col-12 mb-3">
                            <label class="text-dark fw-600" for="email"><?php echo site_phrase('email'); ?></label>
                            <div class="input-group">
                                <input type="email" class="form-control" name = "email" id="email" placeholder="<?php echo site_phrase('email'); ?>" value="<?php echo $user_details['email']; ?>" disabled>
                            </div>
                        </div>

                        <hr class="my-4 bg-secondary">

                        <div class="col-12 mb-3">
                            <label class="text-dark fw-600" for="current_password"><?php echo site_phrase('current_password'); ?></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input type="password" class="form-control" id="current_password" name = "current_password" placeholder="<?php echo site_phrase('enter_current_password'); ?>">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="text-dark fw-600" for="new_password"><?php echo site_phrase('new_password'); ?></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="new_password" name = "new_password" placeholder="<?php echo site_phrase('enter_new_password'); ?>">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="text-dark fw-600" for="confirm_password"><?php echo site_phrase('confirm_password'); ?></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="confirm_password" name = "confirm_password" placeholder="<?php echo site_phrase('re-type_your_password'); ?>">
                            </div>
                        </div>

                        <div class="col-12 pt-4">
                            <button class="btn red px-5 py-2 radius-8"><?php echo site_phrase('save_changes'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>