<?php
    $categories = $this->crud_model->get_blog_categories()->result_array();
?>

<section class="mt-5">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-9">
                <h6 class="m-0 py-3 mt-1 fw-700 border-bottom"><?php echo site_phrase('blogs_category'); ?></h6>
                <div class="row justify-content-around pt-4">
                    <?php foreach($categories as $category): ?>
                        <div class="col-md-6">
                            <?php $number_of_blog = $this->crud_model->get_blogs_by_category_id($category['blog_category_id'])->num_rows(); ?>
                            <div class="list-group border radius-10 my-2">
                                <a href="<?php echo site_url('blogs?category='.$category['slug']); ?>" class="p-3 list-group-item list-group-item-action border-0" aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1"><?php echo $category['title']; ?></h6>
                                        <?php if($number_of_blog > 0): ?>
                                            <span class="badge bg-primary rounded-pill"><?php echo $number_of_blog; ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <small><?php echo $category['subtitle']; ?></small>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
                
            <div class="col-lg-3 py-3 radius-10 bg-white">
                <?php include "blog_sidebar.php"; ?>
            </div>
        </div>
    </div>
</section>