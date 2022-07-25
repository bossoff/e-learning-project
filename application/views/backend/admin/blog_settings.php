<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<form action="<?php echo site_url('admin/blog_settings/update'); ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="blog_page_title"><?php echo get_phrase('blog_page_title'); ?></label>
						<input type="text" value="<?php echo get_frontend_settings('blog_page_title'); ?>" name="blog_page_title" class="form-control" required>
					</div>

					<div class="form-group">
						<label for="blog_page_subtitle"><?php echo get_phrase('blog_page_subtitle'); ?></label>
						<textarea class="form-control" rows="3" name="blog_page_subtitle" id="blog_page_subtitle" required><?php echo get_frontend_settings('blog_page_subtitle'); ?></textarea>
					</div>

					<div class="form-group">
						<label><?php echo get_phrase('instructors_blog_permission'); ?>?</label><br>
						<input type="radio" name="instructors_blog_permission" id="yes" value="1" <?php if(get_frontend_settings('instructors_blog_permission') == 1)echo 'checked'; ?>> <label for="yes"><?php echo get_phrase('yes'); ?></label>
						<input type="radio" class="ml-2" name="instructors_blog_permission" id="no" value="0" <?php if(get_frontend_settings('instructors_blog_permission') == 0)echo 'checked'; ?>> <label for="no"><?php echo get_phrase('no'); ?></label>
					</div>

					<div class="form-group">
						<label><?php echo get_phrase('blog_visibility_on_the_home_page'); ?>?</label><br>
						<input type="radio" name="blog_visibility_on_the_home_page" id="enable" value="1" <?php if(get_frontend_settings('blog_visibility_on_the_home_page') == 1)echo 'checked'; ?>> <label for="enable"><?php echo get_phrase('visible'); ?></label>
						<input type="radio" class="ml-2" name="blog_visibility_on_the_home_page" id="disabled" value="0" <?php if(get_frontend_settings('blog_visibility_on_the_home_page') == 0)echo 'checked'; ?>> <label for="disabled"><?php echo get_phrase('invisible'); ?></label>
					</div>

					<div class="form-group">
						<label for="blog_page_banner"><?php echo get_phrase('blog_page_banner'); ?> <small class="text-muted">(2000 x 500)</small></label>
						<input type="file" name="blog_page_banner" id="blog_page_banner" class="form-control" accept="image/*">
					</div>

					<div class="form-group">
						<button class="btn btn-primary" type="submit"><?php echo get_phrase('save_changes'); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>