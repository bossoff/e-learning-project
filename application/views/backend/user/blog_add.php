<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body py-2">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('add_blog'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<div class="row ">
    <div class="col-md-10">
    	<div class="card">
    		<div class="card-body">
    			<h4 class='mb-3'><?php echo get_phrase('add_a_new_blog'); ?></h4>
		    	<form action="<?php echo site_url('user/blog/add'); ?>" method="post" enctype="multipart/form-data">
		    		<div class="form-group">
		    			<label for="title"><?php echo get_phrase('title'); ?></label>
		    			<input type="text" class="form-control" name="title" id="title" placeholder="<?php echo get_phrase('enter_blog_title'); ?>" required>
		    		</div>

		    		<div class="form-group">
		    			<label for="blog_category_id"><?php echo get_phrase('category'); ?></label>
		    			<select class="form-control select2" data-toggle="select2" name="blog_category_id" id="blog_category_id" required>
		    				<option value=""><?php echo get_phrase('select_a_category'); ?></option>
		    				<?php foreach($this->crud_model->get_blog_categories()->result_array() as $category): ?>
		    					<option value="<?php echo $category['blog_category_id']; ?>"><?php echo $category['title']; ?></option>
		    				<?php endforeach; ?>
		    			</select>
		    		</div>

		    		<div class="form-group">
                        <label for="keywords"><?php echo get_phrase('keywords'); ?></label>
                        <input type="text" class="form-control bootstrap-tag-input" id = "keywords" name="keywords" data-role="tagsinput" style="width: 100%;"/>
                        <small class="text-muted"><?php echo site_phrase('click_the_enter_button_after_writing_your_keyword'); ?></small>
                    </div>

		    		<div class="form-group">
		    			<label for="summernote-basic"><?php echo get_phrase('description'); ?></label>
		    			<textarea name="description" id="summernote-basic"></textarea>
		    		</div>

		    		<div class="form-group mb-3">
						<label for="banner"><?php echo get_phrase('blog_banner'); ?></label>
						<div class="wrapper-image-preview" style="margin-left: -6px;">
							<div class="box" style="width: 300px;">
								<div class="js--image-preview" style="background-image: url('<?php echo base_url('uploads/blog/banner/placeholder.png') ?>'); background-color: #F5F5F5; background-size: cover; background-position: center;"></div>
								<div class="upload-options">
									<label for="banner" class="btn"> <i class="mdi mdi-camera"></i> <?php echo get_phrase('choose_a_banner'); ?> <br> <small>(2000 x 500)</small> </label>
									<input id="banner" style="visibility:hidden;" type="file" class="image-upload" name="banner" accept="image/*">
								</div>
							</div>
						</div>
					</div>

					<div class="form-group mb-3">
						<label for="thumbnail"><?php echo get_phrase('blog_thumbnail'); ?></label>
						<div class="wrapper-image-preview" style="margin-left: -6px;">
							<div class="box" style="width: 300px;">
								<div class="js--image-preview" style="background-image: url('<?php echo base_url('uploads/blog/thumbnail/placeholder.png') ?>'); background-color: #F5F5F5; background-size: cover; background-position: center;"></div>
								<div class="upload-options">
									<label for="thumbnail" class="btn"> <i class="mdi mdi-camera"></i> <?php echo get_phrase('choose_a_thumbnail'); ?> <br> <small>(800 x 500)</small> </label>
									<input id="thumbnail" style="visibility:hidden;" type="file" class="image-upload" name="thumbnail" accept="image/*">
								</div>
							</div>
						</div>
					</div>

					<div class="form-group mt-4">
						<button class="btn btn-success"><?php echo get_phrase('add_blog'); ?></button>
					</div>
		    	</form>
		    </div>
		</div>
	</div>
</div>