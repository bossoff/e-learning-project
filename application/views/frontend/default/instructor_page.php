<?php
$instructor_details = $this->user_model->get_all_user($instructor_id)->row_array();
$social_links  = json_decode($instructor_details['social_links'], true);
$course_ids = $this->crud_model->get_instructor_wise_courses($instructor_id, 'simple_array');

$this->db->select('user_id');
$this->db->distinct();
$this->db->where_in('course_id', $course_ids);
$total_students = $this->db->get('enrol')->num_rows();
?>
<section class="instructor-header-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-xl-6 order-last order-lg-first text-md-start text-center pt-4 ps-0">
                <h4 class="user-type"><?php echo site_phrase('instructor'); ?></h4>
                <h1 class="instructor-name"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></h1>
                <h2 class="instructor-title"><?php echo $instructor_details['title']; ?></h2>
                <p class="text-12px mt-3">
                    <?php echo $total_students.' '.site_phrase('students_enrolled'); ?>
                </p>
            </div>
            <div class="col-lg-4 col-xl-3 order-first order-lg-last text-center">
                <img class="radius-10" src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']);?>" alt="" class="img-fluid" style="max-width: 300px;">
            </div>
        </div>
    </div>
</section>

<section class="instructor-details-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="order-last order-lg-first col-lg-7 col-xl-6 bg-white radius-8 py-3 px-4">
                <div class="w-100">
                    <h4 class="fw-700"><?php echo site_phrase('about_me'); ?></h4>

                    <div class="biography-content-box view-more-parent">
                        <div class="view-more" onclick="viewMore(this,'hide')"><b><?php echo site_phrase('show_full_biography'); ?></b></div>
                        <div class="biography-content">
                            <?php echo $instructor_details['biography']; ?>
                        </div>
                    </div>
                </div>

                <div class="w-100 pb-4">
                    <h4 class="fw-700 my-3"><?php echo site_phrase('my_skills'); ?></h4>

                    <?php $skills = explode(',', $instructor_details['skills']); ?>
                    <?php foreach($skills as $skill): ?>
                      <span class="badge badge-sub-warning text-12px my-1 py-2"><?php echo $skill; ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-1 d-none d-lg-block mw-30px"></div>
            <div class="order-first order-lg-last col-lg-4 col-xl-3">
                <div class="row bg-white px-3 py-4 radius-8">
                    <div class="col-4 text-center">
                        <h5 class="fw-700"><?php echo $total_students; ?></h5>
                        <p class="text-12px fw-700 text-muted"><?php echo site_phrase('total_students'); ?></p>
                    </div>
                    <div class="col-4 text-center">
                        <h5 class="fw-700"><?php echo sizeof($course_ids); ?></h5>
                        <p class="text-12px fw-700 text-muted"><?php echo site_phrase('courses'); ?></p>
                    </div>
                    <div class="col-4 text-center">
                        <h5 class="fw-700"><?php echo $this->crud_model->get_instructor_wise_course_ratings($instructor_id, 'course')->num_rows(); ?></h5>
                        <p class="text-12px fw-700 text-muted"><?php echo site_phrase('reviews'); ?></p>
                    </div>

                    <div class="col-12">
                        <div class="instructor-social-links">
                            <?php if($social_links['facebook']): ?>
                                <a href="<?php echo $social_links['facebook']; ?>" target="_blank"><i class="fab fa-facebook-f"></i> <?php echo site_phrase('facebook'); ?></a>
                            <?php endif; ?>

                            <?php if($social_links['twitter']): ?>
                                <a href="<?php echo $social_links['twitter']; ?>" target="_blank"><i class="fab fa-twitter"></i> <?php echo site_phrase('twitter'); ?></a>
                            <?php endif; ?>

                            <?php if($social_links['linkedin']): ?>
                                <a href="<?php echo $social_links['linkedin']; ?>" target="_blank"><i class="fab fa-linkedin-in"></i> <?php echo site_phrase('linkedin'); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-10">
            <h3 class="course-carousel-title mb-4 px-2"><?php echo site_phrase('courses'); ?></h3>
            <div class="course-carousel">
                <?php
                foreach ($course_ids as $course_id) :
                    $top_course = $this->crud_model->get_course_by_id($course_id)->row_array();
                    $lessons = $this->crud_model->get_lessons('course', $top_course['id']);
                    $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($top_course['id']);
                    ?>
                    <div class="course-box-wrap">
                        <a onclick="$(location).attr('href', '<?php echo site_url('home/course/' . rawurlencode(slugify($top_course['title'])) . '/' . $top_course['id']); ?>');" href="javascript:;" class="has-popover">
                            <div class="course-box">
                                <div class="course-image">
                                    <img src="<?php echo $this->crud_model->get_course_thumbnail_url($top_course['id']); ?>" alt="" class="img-fluid">
                                </div>
                                <div class="course-details">
                                    <h5 class="title"><?php echo $top_course['title']; ?></h5>
                                    <div class="rating">
                                        <?php
                                        $total_rating =  $this->crud_model->get_ratings('course', $top_course['id'], true)->row()->rating;
                                        $number_of_ratings = $this->crud_model->get_ratings('course', $top_course['id'])->num_rows();
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
                                            <span class="badge badge-sub-warning text-11px"><?php echo site_phrase($top_course['level']); ?></span>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button class="brn-compare-sm" onclick="event.stopPropagation(); $(location).attr('href', '<?php echo site_url('home/compare?course-1=' . rawurlencode(slugify($top_course['title'])) . '&&course-id-1=' . $top_course['id']); ?>');"><i class="fas fa-balance-scale"></i> <?php echo site_phrase('compare'); ?></button>
                                        </div>
                                    </div>

                                    <hr class="divider-1">

                                    <div class="d-block">
                                        <div class="floating-user d-inline-block">
                                            <?php if ($top_course['multi_instructor']):
                                                $instructor_details = $this->user_model->get_multi_instructor_details_with_csv($top_course['user_id']);
                                                $margin = 0;
                                                foreach ($instructor_details as $key => $instructor_detail) { ?>
                                                    <img style="margin-left: <?php echo $margin; ?>px;" class="position-absolute" src="<?php echo $this->user_model->get_user_image_url($instructor_detail['id']); ?>" width="30px" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $instructor_detail['first_name'].' '.$instructor_detail['last_name']; ?>" onclick="event.stopPropagation(); $(location).attr('href', '<?php echo site_url('home/instructor_page/'.$instructor_detail['id']); ?>');">
                                                    <?php $margin = $margin+17; ?>
                                                <?php } ?>
                                            <?php else: ?>
                                                <?php $user_details = $this->user_model->get_all_user($top_course['user_id'])->row_array(); ?>
                                                <img src="<?php echo $this->user_model->get_user_image_url($user_details['id']); ?>" width="30px" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $user_details['first_name'].' '.$user_details['last_name']; ?>" onclick="event.stopPropagation(); $(location).attr('href', '<?php echo site_url('home/instructor_page/'.$user_details['id']); ?>');">
                                            <?php endif; ?>
                                        </div>



                                        <?php if ($top_course['is_free_course'] == 1) : ?>
                                            <p class="price text-right d-inline-block float-end"><?php echo site_phrase('free'); ?></p>
                                        <?php else : ?>
                                            <?php if ($top_course['discount_flag'] == 1) : ?>
                                                <p class="price text-right d-inline-block float-end"><small><?php echo currency($top_course['price']); ?></small><?php echo currency($top_course['discounted_price']); ?></p>
                                            <?php else : ?>
                                                <p class="price text-right d-inline-block float-end"><?php echo currency($top_course['price']); ?></p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        if ($(".course-carousel")[0]) {
            $(".course-carousel").slick({
                dots: false,
                infinite: false,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 3,
                swipe: false,
                touchMove: false,
                responsive: [
                    { breakpoint: 840, settings: { slidesToShow: 2, slidesToScroll: 2, }, },
                    { breakpoint: 620, settings: { slidesToShow: 1, slidesToScroll: 1, }, },
                ],
            });
        }
    });
</script>