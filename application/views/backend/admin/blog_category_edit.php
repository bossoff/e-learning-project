<form action="<?php echo site_url('admin/blog_category/update/'.$blog_category['blog_category_id']); ?>" method="post">
	<div class="form-group">
		<label for="category_title"><?php echo get_phrase('title'); ?></label>
		<input class="form-control" value="<?php echo $blog_category['title']; ?>" type="text" id="category_title" name="title" required>
	</div>
	<div class="form-group">
		<label for="category_subtitle"><?php echo get_phrase('subtitle'); ?> <small class="text-muted">(80 <?php echo get_phrase('character'); ?>)</small></label>
		<textarea class="form-control" rows="3" name="subtitle" id="category_subtitle" maxlength="80"><?php echo $blog_category['subtitle']; ?></textarea>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary"><?php echo get_phrase('update'); ?></button>
	</div>
</form>