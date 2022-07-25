<?php
    $cart_items = $this->session->userdata('cart_items');
    foreach ($my_courses as $my_course) :
    $lessons = $this->crud_model->get_lessons('course', $my_course['id']);
    $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($my_course['id']);
    ?>
    <div class="col-lg-3 px-0">
        <div class="course-box-wrap">
            <div class="course-box">
                <div class="course-image">
                    <img src="<?php echo $this->crud_model->get_course_thumbnail_url($my_course['id']); ?>" alt="" class="img-fluid">

                    <div class="wishlist-add wishlisted">
                        <button type="button" onclick="handleWishList(this)" id="<?php echo $my_course['id']; ?>">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                </div>
                <div class="course-details">
                    <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($my_course['title'])) . '/' . $my_course['id']); ?>"><h5 class="title"><?php echo $my_course['title']; ?></h5></a>
                    <div class="rating">
                        <?php
                        $total_rating =  $this->crud_model->get_ratings('course', $my_course['id'], true)->row()->rating;
                        $number_of_ratings = $this->crud_model->get_ratings('course', $my_course['id'])->num_rows();
                        if ($number_of_ratings > 0) {
                            $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                        } else {
                            $average_ceil_rating = 0;
                        }

                        for ($i = 1; $i < 6; $i++) : ?>
                            <?php if ($i <= $average_ceil_rating) : ?>
                                <i class="fas fa-star filled"></i>
                            <?php else : ?>
                                <i class="fas fa-star"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <div class="d-inline-block">
                            <span class="text-dark ms-1 text-15px">(<?php echo $average_ceil_rating; ?>)</span>
                            <span class="text-dark text-12px text-muted ms-2">(<?php echo $number_of_ratings.' '.site_phrase('reviews'); ?>)</span>
                        </div>
                    </div>
                    <div class="d-flex text-dark">
                        <div class="">
                            <i class="far fa-clock text-14px"></i>
                            <span class="text-muted text-12px"><?php echo $course_duration; ?></span>
                        </div>
                        <div class="ms-3">
                            <i class="far fa-list-alt text-14px"></i>
                            <span class="text-muted text-12px"><?php echo $lessons->num_rows().' '.site_phrase('lectures'); ?></span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6">
                            <span class="badge badge-sub-warning text-11px"><?php echo site_phrase($my_course['level']); ?></span>
                        </div>
                        <div class="col-6 text-end">
                            <button class="brn-compare-sm" onclick="return check_action(this, '<?php echo site_url('home/compare?course-1=' . rawurlencode(slugify($my_course['title'])) . '&&course-id-1=' . $my_course['id']); ?>');"><i class="fas fa-balance-scale"></i> <?php echo site_phrase('compare'); ?></button>
                        </div>
                    </div>

                    <hr class="divider-1">

                    <div class="d-block">
                        <div class="floating-user d-inline-block">
                            <?php if ($my_course['multi_instructor']):
                                $instructor_details = $this->user_model->get_multi_instructor_details_with_csv($my_course['user_id']);
                                $margin = 0;
                                foreach ($instructor_details as $key => $instructor_detail) { ?>
                                    <img style="margin-left: <?php echo $margin; ?>px;" class="position-absolute" src="<?php echo $this->user_model->get_user_image_url($instructor_detail['id']); ?>" width="30px" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $instructor_detail['first_name'].' '.$instructor_detail['last_name']; ?>" onclick="return check_action(this,'<?php echo site_url('home/instructor_page/'.$instructor_detail['id']); ?>');">
                                    <?php $margin = $margin+17; ?>
                                <?php } ?>
                            <?php else: ?>
                                <?php $user_details = $this->user_model->get_all_user($my_course['user_id'])->row_array(); ?>
                                <img src="<?php echo $this->user_model->get_user_image_url($user_details['id']); ?>" width="30px" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $user_details['first_name'].' '.$user_details['last_name']; ?>"  onclick="return check_action(this,'<?php echo site_url('home/instructor_page/'.$user_details['id']); ?>');">
                            <?php endif; ?>
                        </div>



                        <?php if ($my_course['is_free_course'] == 1) : ?>
                            <p class="price text-right d-inline-block float-end"><?php echo site_phrase('free'); ?></p>
                        <?php else : ?>
                            <?php if ($my_course['discount_flag'] == 1) : ?>
                                <p class="price text-right d-inline-block float-end"><small><?php echo currency($my_course['price']); ?></small><?php echo currency($my_course['discounted_price']); ?></p>
                            <?php else : ?>
                                <p class="price text-right d-inline-block float-end"><?php echo currency($my_course['price']); ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>