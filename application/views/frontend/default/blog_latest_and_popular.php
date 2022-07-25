<section class="mt-5">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-9">
                <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 g-4">
                    <div class="col-12">
                        <h4 class="fw-700"><?php echo site_phrase('latest_blogs'); ?></h4>
                    </div>
                    <?php foreach($latest_blogs->result_array() as $latest_blog): ?>
                        <?php $user_details = $this->user_model->get_all_user($latest_blog['user_id'])->row_array(); ?>
                        <div class="col">
                            <div class="card radius-10">
                                <?php $blog_thumbnail = 'uploads/blog/thumbnail/'.$latest_blog['thumbnail']; ?>
                                <?php if(file_exists($blog_thumbnail) && is_file($blog_thumbnail)): ?>
                                    <img src="<?php echo base_url($blog_thumbnail); ?>" class="card-img-top radius-top-10" alt="<?php echo $latest_blog['title']; ?>">
                                <?php else: ?>
                                    <img src="<?php echo base_url('uploads/blog/thumbnail/placeholder.png'); ?>" class="card-img-top radius-top-10" alt="<?php echo $latest_blog['title']; ?>">
                                <?php endif; ?>
                                <div class="card-body pt-4">
                                    <p class="card-text">
                                        <small class="text-muted"><?php echo site_phrase('created_by'); ?> - <a href="<?php echo site_url('home/instructor_page/'.$latest_blog['user_id']); ?>"><?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></a></small>
                                    </p>
                                    <h5 class="card-title"><a href="<?php echo site_url('blog/details/'.slugify($latest_blog['title']).'/'.$latest_blog['blog_id']); ?>"><?php echo $latest_blog['title']; ?></a></h5>
                                    <p class="card-text ellipsis-line-3">
                                        <?php echo strip_tags(htmlspecialchars_decode($latest_blog['description'])); ?>
                                    </p>
                                    
                                    <a class="fw-600" href="<?php echo site_url('blog/details/'.slugify($latest_blog['title']).'/'.$latest_blog['blog_id']); ?>"><?php echo site_phrase('more_details'); ?></a>
                                    
                                    <p class="card-text mt-2 mb-0">
                                        <small class="text-muted text-12px"><?php echo site_phrase('published'); ?> - <?php echo get_past_time($latest_blog['added_date']); ?></small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="col-12">
                        <a class="float-end btn btn-secondary px-3 fw-600" href="<?php echo site_url('blogs'); ?>"><?php echo site_phrase('view_all'); ?></a>
                    </div>
                </div>
                
                <?php if($popular_blogs->num_rows() > 0): ?>
                    <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 g-4 mt-3">
                        <div class="col-12">
                            <h4 class="fw-700"><?php echo site_phrase('popular_blogs'); ?></h4>
                        </div>
                        <?php foreach($popular_blogs->result_array() as $popular_blog): ?>
                            <?php $user_details = $this->user_model->get_all_user($popular_blog['user_id'])->row_array(); ?>
                            <div class="col">
                                <div class="card radius-10">
                                    <?php $blog_thumbnail = 'uploads/blog/thumbnail/'.$popular_blog['thumbnail']; ?>
                                    <?php if(file_exists($blog_thumbnail) && is_file($blog_thumbnail)): ?>
                                        <img src="<?php echo base_url($blog_thumbnail); ?>" class="card-img-top radius-10" alt="<?php echo $popular_blog['title']; ?>">
                                    <?php else: ?>
                                        <img src="<?php echo base_url('uploads/blog/thumbnail/placeholder.png'); ?>" class="card-img-top radius-10" alt="<?php echo $popular_blog['title']; ?>">
                                    <?php endif; ?>
                                    <div class="card-body pt-4">
                                        <p class="card-text">
                                            <small class="text-muted"><?php echo site_phrase('created_by'); ?> - <a href="<?php echo site_url('home/instructor_page/'.$popular_blog['user_id']); ?>"><?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></a></small>
                                        </p>
                                        <h5 class="card-title"><a href="<?php echo site_url('blog/details/'.slugify($popular_blog['title']).'/'.$popular_blog['blog_id']); ?>"><?php echo $popular_blog['title']; ?></a></h5>
                                        <p class="card-text ellipsis-line-3">
                                            <?php echo strip_tags(htmlspecialchars_decode($popular_blog['description'])); ?>
                                        </p>
                                        
                                        <a class="fw-600" href="<?php echo site_url('blog/details/'.slugify($popular_blog['title']).'/'.$popular_blog['blog_id']); ?>"><?php echo site_phrase('more_details'); ?></a>
                                        
                                        <p class="card-text mt-2 mb-0">
                                            <small class="text-muted text-12px"><?php echo site_phrase('published'); ?> - <?php echo get_past_time($popular_blog['added_date']); ?></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-12">
                            <div class="col-12">
                                <a class="float-end btn btn-secondary px-3 fw-600" href="<?php echo site_url('blogs'); ?>"><?php echo site_phrase('view_all'); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
                
            <div class="col-lg-3 py-3 radius-10 bg-white">
                <?php include "blog_sidebar.php"; ?>
            </div>
        </div>
    </div>
</section>