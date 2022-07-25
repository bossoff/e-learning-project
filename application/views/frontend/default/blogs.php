<section class="" style="background-image: url('<?php echo site_url('uploads/blog/page-banner/'.get_frontend_settings('blog_page_banner')); ?>'); background-size: cover; background-position: center; position: relative;">
    <div class="image-placeholder-2"></div>
    <div class="container-lg position-inherit py-5">
        <div class="row my-0 my-md-4">
            <div class="col-lg-6">
                <h1 class="display-4 fw-600 text-white"><?php echo get_frontend_settings('blog_page_title'); ?></h1>
                <div class="text-17px text-white"><?php echo get_frontend_settings('blog_page_subtitle'); ?></div>
            </div>
        </div>
    </div>
</section>

<?php include $included_page; ?>