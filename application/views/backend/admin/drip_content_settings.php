<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-play-protected-content title_icon"></i> <?php echo get_phrase('drip_content_settings'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
	<div class="col-lg-7">
		<div class="card">
			<div class="card-body">
				<h3 class="mb-3 header-title"><?php echo get_phrase('manage_your_drip_content_settings'); ?></h3>
				<form action="<?php echo site_url('admin/drip_content_settings/update'); ?>" method="post">
					<div class="form-group">
						<label><?php echo get_phrase('lesson_completion_role'); ?><span class="required">*</span></label>
						<br>
						<input type="radio" onclick="$('.toggleMinimumWatchField').toggleClass('d-hidden');" value="percentage" id="video_percentage_wise" name="lesson_completion_role" <?php if($drip_content_settings['lesson_completion_role'] == 'percentage') echo 'checked'; ?>>
						<label for="video_percentage_wise"><?php echo get_phrase('video_percentage_wise'); ?></label>
						&nbsp;&nbsp;
						<input type="radio" onclick="$('.toggleMinimumWatchField').toggleClass('d-hidden');" value="duration" id="video_duration_wise" name="lesson_completion_role" <?php if($drip_content_settings['lesson_completion_role'] == 'duration') echo 'checked'; ?>>
						<label for="video_duration_wise"><?php echo get_phrase('video_duration_wise'); ?></label>
					</div>

					<div class="form-group toggleMinimumWatchField <?php if($drip_content_settings['lesson_completion_role'] != 'duration') echo 'd-hidden'; ?>">
						<label for="minimum_duration"><?php echo get_phrase('minimum_duration_to_watch'); ?><span class="required">*</span></label>
						<div class="input-group">
							<input type="text" value="<?php echo seconds_to_time_format($drip_content_settings['minimum_duration']); ?>" id="minimum_duration" class="form-control" name="minimum_duration" data-toggle="timepicker" data-show-meridian="false">
							<div class="input-group-append">
								<span class="input-group-text"><i class="dripicons-clock"></i></span>
							</div>
						</div>
					</div>

					<div class="form-group toggleMinimumWatchField <?php if($drip_content_settings['lesson_completion_role'] != 'percentage') echo 'd-hidden'; ?>">
						<label for="minimum_percentage"><?php echo get_phrase('minimum_percentage_to_watch'); ?><span class="required">*</span></label>
						<div class="input-group">
							<input type="text" value="<?php echo $drip_content_settings['minimum_percentage']; ?>" id="minimum_percentage" name="minimum_percentage" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text"><i class="mdi mdi-percent"></i></span>
							</div>
						</div>
					</div>

					<div class="form-group">
                        <label for="locked_lesson_message"><?php echo get_phrase('message_for_locked_lesson'); ?></label>
                        <textarea name="locked_lesson_message" id = "locked_lesson_message" class="form-control" rows="5"><?php echo $drip_content_settings['locked_lesson_message']; ?></textarea>
                    </div>

                    <div class="form-group">
                    	<button type="submit" class="btn btn-primary"><?php echo get_phrase('save_changes'); ?></button>
                    </div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-5">
		<div class="alert alert-info" role="alert">
			<h4 class="alert-heading"><?php echo get_phrase('attention'); ?>!</h4>
            <p class="mb-0"><?php echo get_phrase('the_auto_checkmark_is_only_applicable_for_video_lessons'); ?>.</p>
            <a href="https://creativeitem.com/docs/academy-lms/drip-content-settings" target="_blank"><?php echo get_phrase('learn_more'); ?></a>
        </div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
	    initSummerNote(['#locked_lesson_message']);
	  });
</script>
