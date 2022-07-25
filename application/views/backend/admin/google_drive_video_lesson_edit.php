<input type="hidden" name="lesson_type" value="video-url">
<input type="hidden" name="lesson_provider" value="google_drive">

<div class="form-group">
    <label><?php echo get_phrase('video_url'); ?></label>
    <input type="text" value="<?php echo $lesson_details['video_url'] ?>" id = "google_drive_video_url" name = "google_drive_video_url" class="form-control" placeholder="<?php echo get_phrase('enter_google_drive_video_url'); ?>">
</div>

<div class="form-group">
    <label><?php echo get_phrase('duration'); ?></label>
    <input type="text" class="form-control" data-toggle='timepicker' data-minute-step="5" name="google_drive_video_duration"  value="<?php echo $lesson_details['duration']; ?>" id = "google_drive_video_duration" data-show-meridian="false" value="00:00:00">
</div>
