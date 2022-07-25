
<?php include "profile_menus.php"; ?>

<?php
    $my_courses = $this->user_model->my_courses()->result_array();

    $categories = array();
    foreach ($my_courses as $my_course) {
        $course_details = $this->crud_model->get_course_by_id($my_course['course_id'])->row_array();
        if (!in_array($course_details['category_id'], $categories)) {
            array_push($categories, $course_details['category_id']);
        }
    }
?>

<section class="my-courses-area">
    <div class="container">
        <div class="w-100 px-2">
            <div class="row align-items-baseline bg-white radius-8">
                <div class="col-lg-6 py-2">
                    <div class="btn-group">
                        <a class="btn bg-background dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <?php echo site_phrase('categories'); ?>
                        </a>

                        <div class="dropdown-menu">
                            <?php foreach ($categories as $category):
                                $category_details = $this->crud_model->get_categories($category)->row_array();
                                ?>
                                <a class="dropdown-item" href="javascript:;" id = "<?php echo $category; ?>" onclick="getCoursesByCategoryId(this.id)"><?php echo $category_details['name']; ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <div class="btn-group">
                        <a href="<?php echo site_url('home/my_courses'); ?>" class="btn bg-background" disabled><?php echo site_phrase('reset'); ?></a>
                    </div>
                </div>
                <div class="col-lg-6 py-2">
                    <form action="javascript:;">
                        <div class="input-group common-search-box">
                            <input type="text" class="form-control py-2" placeholder="<?php echo site_phrase('search_my_courses'); ?>" onkeyup="getCoursesBySearchString(this.value)">
                            <dib class="input-group-button">
                                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                            </dib>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row no-gutters" id = "my_courses_area">
            <?php include 'reload_my_courses.php'; ?>
        </div>
    </div>
</section>


<script type="text/javascript">
function getCoursesByCategoryId(category_id) {
    $('#my_courses_area').html('<div class="animated-loader"><div class="spinner-border text-secondary" role="status"></div></div>');
    $.ajax({
        type : 'POST',
        url : '<?php echo site_url('home/my_courses_by_category'); ?>',
        data : {category_id : category_id},
        success : function(response){
            $('#my_courses_area').html(response);
        }
    });
}

function getCoursesBySearchString(search_string) {
    $('#my_courses_area').html('<div class="animated-loader"><div class="spinner-border text-secondary" role="status"></div></div>');
    $.ajax({
        type : 'POST',
        url : '<?php echo site_url('home/my_courses_by_search_string'); ?>',
        data : {search_string : search_string},
        success : function(response){
            $('#my_courses_area').html(response);
        }
    });
}

function getCourseDetailsForRatingModal(course_id) {
    $.ajax({
        type : 'POST',
        url : '<?php echo site_url('home/get_course_details'); ?>',
        data : {course_id : course_id},
        success : function(response){
            $('#course_title_1').append(response);
            $('#course_title_2').append(response);
            $('#course_thumbnail_1').attr('src', "<?php echo base_url().'uploads/thumbnails/course_thumbnails/';?>"+course_id+".jpg");
            $('#course_thumbnail_2').attr('src', "<?php echo base_url().'uploads/thumbnails/course_thumbnails/';?>"+course_id+".jpg");
            $('#course_id_for_rating').val(course_id);
            // $('#instructor_details').text(course_id);
            console.log(response);
        }
    });
}
</script>
