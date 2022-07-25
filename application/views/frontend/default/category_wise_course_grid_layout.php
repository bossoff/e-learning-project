<div class="row">
    <?php foreach ($courses as $course) :
        $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array();
        $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course['id']);
        $lessons = $this->crud_model->get_lessons('course', $course['id']); ?>
        <div class="col-md-6 col-xl-4">
            <div class="course-box-wrap">
                <a onclick="$(location).attr('href', '<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']); ?>');" href="javascript:;" class="has-popover">
                    <div class="course-box">
                        <div class="course-image">
                            <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course['id']); ?>" alt="" class="img-fluid">
                        </div>
                        <div class="course-details">
                            <h5 class="title"><?php echo $course['title']; ?></h5>
                            <div class="rating">
                                <?php
                                $total_rating =  $this->crud_model->get_ratings('course', $course['id'], true)->row()->rating;
                                $number_of_ratings = $this->crud_model->get_ratings('course', $course['id'])->num_rows();
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
                                    <span class="badge badge-sub-warning text-11px"><?php echo site_phrase($course['level']); ?></span>
                                </div>
                                <div class="col-6 text-end">
                                    <button class="brn-compare-sm" onclick="event.stopPropagation(); $(location).attr('href', '<?php echo site_url('home/compare?course-1=' . rawurlencode(slugify($course['title'])) . '&&course-id-1=' . $course['id']); ?>');"><i class="fas fa-balance-scale"></i> <?php echo site_phrase('compare'); ?></button>
                                </div>
                            </div>

                            <hr class="divider-1">

                            <div class="d-block">
                                <div class="floating-user d-inline-block">
                                    <?php if ($course['multi_instructor']):
                                        $instructor_details = $this->user_model->get_multi_instructor_details_with_csv($course['user_id']);
                                        $margin = 0;
                                        foreach ($instructor_details as $key => $instructor_detail) { ?>
                                            <img style="margin-left: <?php echo $margin; ?>px;" class="position-absolute" src="<?php echo $this->user_model->get_user_image_url($instructor_detail['id']); ?>" width="30px" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $instructor_detail['first_name'].' '.$instructor_detail['last_name']; ?>" onclick="event.stopPropagation(); $(location).attr('href', '<?php echo site_url('home/instructor_page/'.$instructor_detail['id']); ?>');">
                                            <?php $margin = $margin+17; ?>
                                        <?php } ?>
                                    <?php else: ?>
                                        <?php $user_details = $this->user_model->get_all_user($course['user_id'])->row_array(); ?>
                                        <img src="<?php echo $this->user_model->get_user_image_url($user_details['id']); ?>" width="30px" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $user_details['first_name'].' '.$user_details['last_name']; ?>" onclick="event.stopPropagation(); $(location).attr('href', '<?php echo site_url('home/instructor_page/'.$user_details['id']); ?>');">
                                    <?php endif; ?>
                                </div>



                                <?php if ($course['is_free_course'] == 1) : ?>
                                    <p class="price text-right d-inline-block float-end"><?php echo site_phrase('free'); ?></p>
                                <?php else : ?>
                                    <?php if ($course['discount_flag'] == 1) : ?>
                                        <p class="price text-right d-inline-block float-end"><small><?php echo currency($course['price']); ?></small><?php echo currency($course['discounted_price']); ?></p>
                                    <?php else : ?>
                                        <p class="price text-right d-inline-block float-end"><?php echo currency($course['price']); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>