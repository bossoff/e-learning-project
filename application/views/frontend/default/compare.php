<style>
    .compare-select-box, .compare-select-box:focus{
        padding: 10px 36px 10px 18px !important;
        background-color: #f1f7f8;
        border-radius: 7px;
        font-size: 14px;
    }
</style>
<section class="category-header-area" style="background-image: url('<?php echo base_url('uploads/system/course_page_banner.png'); ?>');">
    <div class="image-placeholder-1"></div>
    <div class="container-lg breadcrumb-container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item display-6 fw-bold">
                <a href="<?php echo site_url('home'); ?>">
                    <?php echo site_phrase('home'); ?>
                </a>
            </li>
            <li class="breadcrumb-item active text-light display-6 fw-bold">
                <?php echo site_phrase('course_compare'); ?>
            </li>
          </ol>
        </nav>
    </div>
</section>

<section class="category-course-list-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="<?php echo site_url('home/compare'); ?>" method="get" class="comparison-form">
                    <div class="row">
                        <div class="col-md-2 text-center fw-700 text-15px"></div>
                        <div class="col-md-3 text-center fw-500 text-14px">
                            <select class="form-select compare-select-box" name="" onchange="compareCourses(this.value, 1)">
                                <option value=""><?php echo site_phrase('choose_a_course_to_compare'); ?></option>
                                <?php foreach ($courses as $key => $course) : ?>
                                    <option value="<?php echo slugify($course['title']) . '_' . $course['id']; ?>" <?php if (isset($course_1_details['id']) && slugify($course_1_details['title']) . '_' . $course_1_details['id'] == slugify($course['title']) . '_' . $course['id']) echo 'selected'; ?>><?php echo $course['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="course-1" id="course-1" value="<?php echo isset($course_1_details['id']) ? slugify($course_1_details['title']) : ''; ?>">
                            <input type="hidden" name="course-id-1" id="course-id-1" value="<?php echo isset($course_1_details['id']) ? slugify($course_1_details['id']) : ''; ?>">
                        </div>
                        <div class="col-md-3 text-center fw-500 text-14px">
                            <select class="form-select compare-select-box" name="" onchange="compareCourses(this.value, 2)">
                                <option value=""><?php echo site_phrase('choose_a_course_to_compare'); ?></option>
                                <?php foreach ($courses as $key => $course) : ?>
                                    <option value="<?php echo slugify($course['title']) . '_' . $course['id']; ?>" <?php if (isset($course_2_details['id']) && slugify($course_2_details['title']) . '_' . $course_2_details['id'] == slugify($course['title']) . '_' . $course['id']) echo 'selected'; ?>><?php echo $course['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="course-2" id="course-2" value="<?php echo isset($course_2_details['id']) ? slugify($course_2_details['title']) : ''; ?>">
                            <input type="hidden" name="course-id-2" id="course-id-2" value="<?php echo isset($course_2_details['id']) ? slugify($course_2_details['id']) : ''; ?>">
                        </div>
                        <div class="col-md-3 text-center fw-500 text-14px">
                            <select class="form-select compare-select-box" name="" onchange="compareCourses(this.value, 3)">
                                <option value=""><?php echo site_phrase('choose_a_course_to_compare'); ?></option>
                                <?php foreach ($courses as $key => $course) : ?>
                                    <option value="<?php echo slugify($course['title']) . '_' . $course['id']; ?>" <?php if (isset($course_3_details['id']) && slugify($course_3_details['title']) . '_' . $course_3_details['id'] == slugify($course['title']) . '_' . $course['id']) echo 'selected'; ?>><?php echo $course['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="course-3" id="course-3" value="<?php echo isset($course_3_details['id']) ? slugify($course_3_details['title']) : ''; ?>">
                            <input type="hidden" name="course-id-3" id="course-id-3" value="<?php echo isset($course_3_details['id']) ? slugify($course_3_details['id']) : ''; ?>">
                        </div>
                        <div class="col-md-1 text-center"></div>
                    </div>
                </form>
                <div class="row mt-4">
                    <div class="col-md-2 text-center fw-700 text-15px"></div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if (isset($course_1_details['id'])) : ?>
                            <img src="<?php echo isset($course_1_details['id']) ? $this->crud_model->get_course_thumbnail_url($course_1_details['id']) : ''; ?>" alt="" class="img-fluid radius-10" style="height: 220px; margin-bottom: 10px;"><br>
                            <?php echo site_phrase('starting_from'); ?>

                            <span class="fw-900 text-18px text-dark">
                                <?php if (isset($course_1_details['id'])) : ?>
                                    <?php if ($course_1_details['is_free_course'] == 1) : ?>
                                        <?php echo site_phrase('free'); ?>
                                    <?php else : ?>
                                        <?php if ($course_1_details['discount_flag'] == 1) : ?>
                                            <?php echo currency($course_1_details['discounted_price']); ?>
                                        <?php else : ?>
                                            <?php echo currency($course_1_details['price']); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </span>
                            <br>

                            <?php if (is_purchased($course_1_details['id'])) : ?>
                                <a href="javascript::" class="btn red radius-10 mt-3 py-2"><?php echo site_phrase('already_purchased'); ?></a>
                            <?php else : ?>
                                <?php if ($course_1_details['is_free_course'] == 1) : ?>
                                    <?php if ($this->session->userdata('user_login') != 1) : ?>
                                        <a href="#" class="btn red radius-10 mt-3 py-2" onclick="handleEnrolledButton()"><?php echo site_phrase('get_enrolled'); ?></a>
                                    <?php else : ?>
                                        <a href="<?php echo site_url('home/get_enrolled_to_free_course/' . $course_1_details['id']); ?>" class="btn red radius-10 mt-3 py-2"><?php echo site_phrase('get_enrolled'); ?></a>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <a href="javascript::" class="btn red radius-10 mt-3 py-2" id="course_<?php echo $course_1_details['id']; ?>" onclick="handleBuyNow(this)"><?php echo site_phrase('buy_now'); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <br>
                            <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course_1_details['title'])) . '/' . $course_1_details['id']) ?>" class="text-danger fw-500 pt-3 d-inline-block"><?php echo site_phrase('learn_more'); ?> <i class="fas fa-angle-right"></i></a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if (isset($course_2_details['id'])) : ?>
                            <img src="<?php echo isset($course_2_details['id']) ? $this->crud_model->get_course_thumbnail_url($course_2_details['id']) : ''; ?>" alt="" class="img-fluid radius-10" style="height: 220px; margin-bottom: 10px;"><br>

                            <?php echo site_phrase('starting_from'); ?>

                            <span class="fw-900 text-18px text-dark">
                                <?php if (isset($course_2_details['id'])) : ?>
                                    <?php if ($course_2_details['is_free_course'] == 1) : ?>
                                        <?php echo site_phrase('free'); ?>
                                    <?php else : ?>
                                        <?php if ($course_2_details['discount_flag'] == 1) : ?>
                                            <?php echo currency($course_2_details['discounted_price']); ?>
                                        <?php else : ?>
                                            <?php echo currency($course_2_details['price']); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </span>
                            <br>

                            <?php if (is_purchased($course_2_details['id'])) : ?>
                                <a href="javascript::" class="btn red radius-10 mt-3 py-2"><?php echo site_phrase('already_purchased'); ?></a>
                            <?php else : ?>
                                <?php if ($course_2_details['is_free_course'] == 1) : ?>
                                    <?php if ($this->session->userdata('user_login') != 1) : ?>
                                        <a href="#" class="btn red radius-10 mt-3 py-2" onclick="handleEnrolledButton()"><?php echo site_phrase('get_enrolled'); ?></a>
                                    <?php else : ?>
                                        <a href="<?php echo site_url('home/get_enrolled_to_free_course/' . $course_2_details['id']); ?>" class="btn red radius-10 mt-3 py-2"><?php echo site_phrase('get_enrolled'); ?></a>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <a href="javascript::" class="btn red radius-10 mt-3 py-2" id="course_<?php echo $course_2_details['id']; ?>" onclick="handleBuyNow(this)"><?php echo site_phrase('buy_now'); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <br>
                            <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course_2_details['title'])) . '/' . $course_2_details['id']) ?>" class="text-danger fw-500 pt-3 d-inline-block"><?php echo site_phrase('learn_more'); ?> <i class="fas fa-angle-right"></i></a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if (isset($course_3_details['id'])) : ?>
                            <img src="<?php echo isset($course_3_details['id']) ? $this->crud_model->get_course_thumbnail_url($course_3_details['id']) : ''; ?>" alt="" class="img-fluid radius-10" style="height: 220px; margin-bottom: 10px;"><br>

                            <?php echo site_phrase('starting_from'); ?>

                            <span class="fw-900 text-18px text-dark">
                                <?php if (isset($course_3_details['id'])) : ?>
                                    <?php if ($course_3_details['is_free_course'] == 1) : ?>
                                        <?php echo site_phrase('free'); ?>
                                    <?php else : ?>
                                        <?php if ($course_3_details['discount_flag'] == 1) : ?>
                                            <?php echo currency($course_3_details['discounted_price']); ?>
                                        <?php else : ?>
                                            <?php echo currency($course_3_details['price']); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </span>
                            <br>

                            <?php if (is_purchased($course_3_details['id'])) : ?>
                                <a href="javascript::" class="btn red radius-10 mt-3 py-2"><?php echo site_phrase('already_purchased'); ?></a>
                            <?php else : ?>
                                <?php if ($course_3_details['is_free_course'] == 1) : ?>
                                    <?php if ($this->session->userdata('user_login') != 1) : ?>
                                        <a href="#" class="btn red radius-10 mt-3 py-2" onclick="handleEnrolledButton()"><?php echo site_phrase('get_enrolled'); ?></a>
                                    <?php else : ?>
                                        <a href="<?php echo site_url('home/get_enrolled_to_free_course/' . $course_3_details['id']); ?>" class="btn red radius-10 mt-3 py-2"><?php echo site_phrase('get_enrolled'); ?></a>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <a href="javascript::" class="btn red radius-10 mt-3 py-2" id="course_<?php echo $course_3_details['id']; ?>" onclick="handleBuyNow(this)"><?php echo site_phrase('buy_now'); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <br>
                            <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course_3_details['title'])) . '/' . $course_3_details['id']) ?>" class="text-danger fw-500 pt-3 d-inline-block"><?php echo site_phrase('learn_more'); ?> <i class="fas fa-angle-right"></i></a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row row bg-white radius-10 py-3 mt-4">
                    <div class="col-md-2 text-center fw-700 text-15px"><?php echo site_phrase('has_discount'); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if(isset($course_1_details['id']) && $course_1_details['discount_flag']){ echo '✅';}elseif(isset($course_1_details['id'])){ echo '❌';} ?>
                    </div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if(isset($course_2_details['id']) && $course_2_details['discount_flag']){ echo '✅';}elseif(isset($course_2_details['id'])){ echo '❌';} ?>
                    </div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if(isset($course_3_details['id']) && $course_3_details['discount_flag']){ echo '✅';}elseif(isset($course_3_details['id'])){ echo '❌';} ?>
                    </div>
                </div>
                <div class="row compare-row">
                    <div class="col-md-2 text-center fw-700 text-15px"><?php echo site_phrase('made_in'); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if(isset($course_1_details['id'])){ ?>
                            <i class="fas fa-language compare-row-icon mb-1"></i><br>
                        <?php echo ucfirst($course_1_details['language']);
                        } ?>
                    </div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if(isset($course_2_details['id'])){ ?>
                            <i class="fas fa-language compare-row-icon mb-1"></i><br>
                        <?php echo ucfirst($course_2_details['language']);
                        } ?>
                    </div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if(isset($course_3_details['id'])){ ?>
                            <i class="fas fa-language compare-row-icon mb-1"></i><br>
                        <?php echo ucfirst($course_3_details['language']);
                        } ?>
                    </div>
                </div>
                <div class="row compare-row">
                    <div class="col-md-2 text-center fw-700 text-15px"><?php echo site_phrase('last_updated_at'); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if (isset($course_1_details['id'])){ ?>
                            <i class="far fa-calendar-alt compare-row-icon mb-1"></i><br>
                            <?php echo date('D, d-M-Y', $course_1_details['last_modified']); ?>
                        <?php } ?>
                    </div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if (isset($course_2_details['id'])){ ?>
                            <i class="far fa-calendar-alt compare-row-icon mb-1"></i><br>
                            <?php echo date('D, d-M-Y', $course_2_details['last_modified']); ?>
                        <?php } ?>
                    </div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if (isset($course_3_details['id'])){ ?>
                            <i class="far fa-calendar-alt compare-row-icon mb-1"></i><br>
                            <?php echo date('D, d-M-Y', $course_3_details['last_modified']); ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="row compare-row">
                    <div class="col-md-2 text-center fw-700 text-15px"><?php echo site_phrase('level'); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if(isset($course_1_details['id'])){ ?>
                            <div class="skill-level-icon ms-auto me-auto mb-2">
                                <span class="active"></span>
                                <span class="<?php if($course_1_details['level'] != 'beginner')echo 'active'; ?>"></span>
                                <span class="<?php if($course_1_details['level'] == 'advanced')echo 'active'; ?>"></span>
                            </div>
                             <?php echo site_phrase(ucfirst($course_1_details['level'])); ?>
                        <?php } ?>
                    </div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if(isset($course_2_details['id'])){ ?>
                            <div class="skill-level-icon ms-auto me-auto mb-2">
                                <span class="active"></span>
                                <span class="<?php if($course_2_details['level'] != 'beginner')echo 'active'; ?>"></span>
                                <span class="<?php if($course_2_details['level'] == 'advanced')echo 'active'; ?>"></span>
                            </div>
                             <?php echo site_phrase(ucfirst($course_2_details['level'])); ?>
                        <?php } ?>
                    </div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if(isset($course_3_details['id'])){ ?>
                            <div class="skill-level-icon ms-auto me-auto mb-2">
                                <span class="active"></span>
                                <span class="<?php if($course_3_details['level'] != 'beginner')echo 'active'; ?>"></span>
                                <span class="<?php if($course_3_details['level'] == 'advanced')echo 'active'; ?>"></span>
                            </div>
                             <?php echo site_phrase(ucfirst($course_3_details['level'])); ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="row compare-row">
                    <div class="col-md-2 text-center fw-700 text-15px"><?php echo site_phrase('total_lessons'); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px"><?php if(isset($course_1_details['id']))echo '<i class="fas fa-book compare-row-icon mb-1"></i><br>'.$this->crud_model->get_lessons('course', $course_1_details['id'])->num_rows(); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px"><?php if(isset($course_2_details['id']))echo '<i class="fas fa-book compare-row-icon mb-1"></i><br>'.$this->crud_model->get_lessons('course', $course_2_details['id'])->num_rows(); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px"><?php if(isset($course_3_details['id']))echo '<i class="fas fa-book compare-row-icon mb-1"></i><br>'.$this->crud_model->get_lessons('course', $course_3_details['id'])->num_rows(); ?></div>
                </div>
                <div class="row compare-row">
                    <div class="col-md-2 text-center fw-700 text-15px"><?php echo site_phrase('total_duration'); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px"><?php if(isset($course_1_details['id'])) echo '<i class="fas fa-stopwatch compare-row-icon mb-1"></i><br>'.$this->crud_model->get_total_duration_of_lesson_by_course_id($course_1_details['id']); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px"><?php if(isset($course_2_details['id'])) echo '<i class="fas fa-stopwatch compare-row-icon mb-1"></i><br>'.$this->crud_model->get_total_duration_of_lesson_by_course_id($course_2_details['id']); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px"><?php if(isset($course_3_details['id'])) echo '<i class="fas fa-stopwatch compare-row-icon mb-1"></i><br>'.$this->crud_model->get_total_duration_of_lesson_by_course_id($course_3_details['id']); ?></div>
                </div>
                <div class="row compare-row">
                    <div class="col-md-2 text-center fw-700 text-15px"><?php echo site_phrase('number_of_reviews'); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px"><?php if(isset($course_1_details['id']))echo '<i class="far fa-comment-alt compare-row-icon mb-1"></i><br>'.$this->crud_model->get_ratings('course', $course_1_details['id'])->num_rows(); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px"><?php if(isset($course_2_details['id']))echo '<i class="far fa-comment-alt compare-row-icon mb-1"></i><br>'.$this->crud_model->get_ratings('course', $course_2_details['id'])->num_rows(); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px"><?php if(isset($course_3_details['id']))echo '<i class="far fa-comment-alt compare-row-icon mb-1"></i><br>'.$this->crud_model->get_ratings('course', $course_3_details['id'])->num_rows(); ?></div>
                </div>
                <div class="row compare-row">
                    <div class="col-md-2 text-center fw-700 text-15px"><?php echo site_phrase('total_enrolment'); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px"><?php if(isset($course_1_details['id']))echo '<i class="fas fa-users compare-row-icon mb-1"></i><br>'.$this->crud_model->enrol_history($course_1_details['id'])->num_rows(); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px"><?php if(isset($course_2_details['id']))echo '<i class="fas fa-users compare-row-icon mb-1"></i><br>'.$this->crud_model->enrol_history($course_2_details['id'])->num_rows(); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px"><?php if(isset($course_3_details['id']))echo '<i class="fas fa-users compare-row-icon mb-1"></i><br>'.$this->crud_model->enrol_history($course_3_details['id'])->num_rows(); ?></div>
                </div>

                <div class="row compare-row">
                    <div class="col-md-2 text-center fw-700 text-15px"><?php echo site_phrase('avg_rating'); ?></div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if (isset($course_1_details['id'])) : ?>
                            <?php
                            $total_rating =  $this->crud_model->get_ratings('course', $course_1_details['id'], true)->row()->rating;
                            $number_of_ratings = $this->crud_model->get_ratings('course', $course_1_details['id'])->num_rows();
                            if ($number_of_ratings > 0) {
                                $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                            } else {
                                $average_ceil_rating = 0;
                            }

                            for ($i = 1; $i < 6; $i++) : ?>
                                <?php if ($i <= $average_ceil_rating) : ?>
                                    <i class="fas fa-star filled" style="color: #f5c85b;"></i>
                                <?php else : ?>
                                    <i class="fas fa-star" style="color: #c7c7c7;"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if (isset($course_2_details['id'])) : ?>
                            <?php
                            $total_rating =  $this->crud_model->get_ratings('course', $course_2_details['id'], true)->row()->rating;
                            $number_of_ratings = $this->crud_model->get_ratings('course', $course_2_details['id'])->num_rows();
                            if ($number_of_ratings > 0) {
                                $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                            } else {
                                $average_ceil_rating = 0;
                            }

                            for ($i = 1; $i < 6; $i++) : ?>
                                <?php if ($i <= $average_ceil_rating) : ?>
                                    <i class="fas fa-star filled" style="color: #f5c85b;"></i>
                                <?php else : ?>
                                    <i class="fas fa-star" style="color: #c7c7c7;"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3 text-center fw-500 text-14px">
                        <?php if (isset($course_3_details['id'])) : ?>
                            <?php
                            $total_rating =  $this->crud_model->get_ratings('course', $course_3_details['id'], true)->row()->rating;
                            $number_of_ratings = $this->crud_model->get_ratings('course', $course_3_details['id'])->num_rows();
                            if ($number_of_ratings > 0) {
                                $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                            } else {
                                $average_ceil_rating = 0;
                            }

                            for ($i = 1; $i < 6; $i++) : ?>
                                <?php if ($i <= $average_ceil_rating) : ?>
                                    <i class="fas fa-star filled" style="color: #f5c85b;"></i>
                                <?php else : ?>
                                    <i class="fas fa-star" style="color: #c7c7c7;"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row compare-row">
                    <div class="col-md-2 text-center fw-700 text-15px"><?php echo site_phrase('short_description'); ?></div>
                    <div class="col-md-3 fw-500 text-14px"><?php echo (isset($course_1_details['id'])) ? ucfirst($course_1_details['short_description']) : '-'; ?></div>
                    <div class="col-md-3 fw-500 text-14px"><?php echo (isset($course_2_details['id'])) ? ucfirst($course_2_details['short_description']) : '-'; ?></div>
                    <div class="col-md-3 fw-500 text-14px"><?php echo (isset($course_3_details['id'])) ? ucfirst($course_3_details['short_description']) : '-'; ?></div>
                </div>

                <div class="row compare-row">
                    <div class="col-md-2 text-center fw-700 text-15px"><?php echo site_phrase('requirements'); ?></div>
                    <div class="col-md-3 fw-500 text-14px">
                        <ul class="what-you-get__items">
                            <?php if (isset($course_1_details['id'])) : ?>
                                <?php foreach (json_decode($course_1_details['requirements']) as $requirement) : ?>
                                    <?php if ($requirement != "") : ?>
                                        <li><?php echo $requirement; ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-md-3 fw-500 text-14px">
                        <ul class="what-you-get__items">
                            <?php if (isset($course_2_details['id'])) : ?>
                                <?php foreach (json_decode($course_2_details['requirements']) as $requirement) : ?>
                                    <?php if ($requirement != "") : ?>
                                        <li><?php echo $requirement; ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-md-3 fw-500 text-14px">
                        <ul class="what-you-get__items">
                            <?php if (isset($course_3_details['id'])) : ?>
                                <?php foreach (json_decode($course_3_details['requirements']) as $requirement) : ?>
                                    <?php if ($requirement != "") : ?>
                                        <li><?php echo $requirement; ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="row compare-row">
                    <div class="col-md-2 text-center fw-700 text-15px"><?php echo site_phrase('outcomes'); ?></div>
                    <div class="col-md-3 fw-500 text-14px">
                        <ul class="what-you-get__items">
                            <?php if (isset($course_1_details['id'])) : ?>
                                <?php foreach (json_decode($course_1_details['outcomes']) as $outcome) : ?>
                                    <?php if ($outcome != "") : ?>
                                        <li><?php echo $outcome; ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-md-3 fw-500 text-14px">
                        <ul class="what-you-get__items">
                            <?php if (isset($course_2_details['id'])) : ?>
                                <?php foreach (json_decode($course_2_details['outcomes']) as $outcome) : ?>
                                    <?php if ($outcome != "") : ?>
                                        <li><?php echo $outcome; ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-md-3 fw-500 text-14px">
                        <ul class="what-you-get__items">
                            <?php if (isset($course_3_details['id'])) : ?>
                                <?php foreach (json_decode($course_3_details['outcomes']) as $outcome) : ?>
                                    <?php if ($outcome != "") : ?>
                                        <li><?php echo $outcome; ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function compareCourses(selectedCourse, courseNumber) {
        selectedCourse = selectedCourse.split('_');
        var courseSlug = selectedCourse[0];
        var courseId = selectedCourse[1];
        $('#course-' + courseNumber).val(courseSlug);
        $('#course-id-' + courseNumber).val(courseId);

        $('.comparison-form').submit();
    }

    function handleBuyNow(elem) {
        handleEnrolledButton();
        
        url1 = '<?php echo site_url('home/handleCartItemForBuyNowButton'); ?>';
        url2 = '<?php echo site_url('home/refreshWishList'); ?>';
        urlToRedirect = '<?php echo site_url('home/shopping_cart'); ?>';
        var explodedArray = elem.id.split("_");
        var course_id = explodedArray[1];

        $.ajax({
            url: url1,
            type: 'POST',
            data: {
                course_id: course_id
            },
            success: function(response) {
                $('#cart_items').html(response);
                $.ajax({
                    url: url2,
                    type: 'POST',
                    success: function(response) {
                        $('#wishlist_items').html(response);
                        toastr.warning('<?php echo site_phrase('please_wait') . '....'; ?>');
                        setTimeout(
                            function() {
                                window.location.replace(urlToRedirect);
                            }, 1500);
                    }
                });
            }
        });
    }

    function handleEnrolledButton() {
        <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
        $.ajax({
            url: '<?php echo site_url('home/isLoggedIn?url_history='.base64_encode($actual_link)); ?>',
            success: function(response) {
                if (!response) {
                    window.location.replace("<?php echo site_url('login'); ?>");
                }
            }
        });
    }
</script>