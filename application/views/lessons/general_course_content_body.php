<div class="col-lg-9 order-1 course_col" id = "video_player_area">
    <!-- <div class="" style="background-color: #333;"> -->
    <?php if($show_locked_message && $course_details['enable_drip_content']): ?>
        <div class="py-5">
            <?php echo remove_js(htmlspecialchars_decode($drip_content_settings['locked_lesson_message'])); ?>
        </div>
    <?php else: ?>
        <div class="">
            <?php
            $lesson_thumbnail_url = $this->crud_model->get_lesson_thumbnail_url($lesson_id);
            // If the lesson type is video
            // i am checking the null and empty values because of the existing users does not have video in all video lesson as type
            if($lesson_details['lesson_type'] == 'video' || $lesson_details['lesson_type'] == '' || $lesson_details['lesson_type'] == NULL):
                $video_url = $lesson_details['video_url'];
                $provider = $lesson_details['video_type'];
                ?>

                <!-- If the video is youtube video -->
                <?php if (strtolower($provider) == 'youtube'): ?>
                    <!------------- PLYR.IO ------------>
                    <link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">

                    <div class="plyr__video-embed" id="player">
                        <iframe height="500" src="<?php echo $video_url;?>?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
                    </div>

                    <script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
                    <script>const player = new Plyr('#player');</script>
                    <!------------- PLYR.IO ------------>

                    <!-- If the video is vimeo video -->
                <?php elseif (strtolower($provider) == 'vimeo'):
                    $video_details = $this->video_model->getVideoDetails($video_url);
                    $video_id = $video_details['video_id'];?>
                    <!------------- PLYR.IO ------------>
                    <link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">
                    <div class="plyr__video-embed" id="player">
                        <iframe height="500" src="https://player.vimeo.com/video/<?php echo $video_id; ?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media" allowfullscreen allowtransparency allow="autoplay"></iframe>
                    </div>

                    <script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
                    <script>const player = new Plyr('#player');</script>
                    <!------------- PLYR.IO ------------>

                    <!-- If the video is Amazon S3 video -->
                <?php elseif (strtolower($provider) == 'amazon'):?>
                    <!------------- PLYR.IO ------------>
                    <link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">
                    <video poster="<?php echo $lesson_thumbnail_url;?>" id="player" playsinline controls>
                        <?php if (get_video_extension($video_url) == 'mp4'): ?>
                            <source src="<?php echo $video_url; ?>" type="video/mp4">
                        <?php elseif (get_video_extension($video_url) == 'webm'): ?>
                            <source src="<?php echo $video_url; ?>" type="video/webm">
                        <?php else: ?>
                            <h4><?php get_phrase('video_url_is_not_supported'); ?></h4>
                        <?php endif; ?>
                    </video>

                    <script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
                    <script>const player = new Plyr('#player');</script>
                    <!------------- PLYR.IO ------------>
                    <!-- If the video is Amazon S3 video -->

                    <!-- If the video is self uploaded video -->
                <?php elseif (strtolower($provider) == 'system'):?>
                    <!------------- PLYR.IO ------------>
                    <link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">
                    <video poster="<?php echo $lesson_thumbnail_url;?>" id="player" playsinline controls>
                        <?php if (get_video_extension($video_url) == 'mp4'): ?>
                            <source class="remove_video_src" src="<?php echo $video_url; ?>" type="video/mp4">
                        <?php elseif (get_video_extension($video_url) == 'webm'): ?>
                            <source class="remove_video_src" src="<?php echo $video_url; ?>" type="video/webm">
                        <?php else: ?>
                            <h4><?php get_phrase('video_url_is_not_supported'); ?></h4>
                        <?php endif; ?>
                    </video>

                    <script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
                    <script>const player = new Plyr('#player');</script>
                    <!------------- PLYR.IO ------------>
                    <!-- If the video is self uploaded video -->

                <?php elseif (strtolower($provider) == 'google_drive'):?>
                    <style type="text/css">
                        .hidebtn {
                            width: 110px !important;
                            height: 55px !important;
                            background: #00000000 !important;
                            position: absolute !important;
                            right: 0px !important;
                            top: 0px !important;
                            z-index: 999;
                        }
                    </style>
                    <!------------- PLYR.IO ------------>
                    <link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">
                    <div class="mt-5">
                        <div class="embed-responsive embed-responsive-16by9" oncontextmenu="return false;">
                          <?php
                            //video id generate
                            $url_array_1 = explode("/",$lesson_details['video_url'].'/');
                            $url_array_2 = explode("=",$lesson_details['video_url']);
                            $video_id = null;

                            if($url_array_1[4] == 'd'):
                                $video_id = $url_array_1[5];
                            else:
                                $video_id = $url_array_2[1];
                            endif; ?>

                            <div class="plyr__video-embed" id="player" style="position: relative;">
                                <div class="hidebtn"></div>
                                <div class="hidebtn"></div>
                                <iframe class="mobile_vedio_player drive_video_payer" src="https://drive.google.com/file/d/<?php echo $video_id; ?>/preview" style="border: 0px;" width="100%" height="480" allowfullscreen>
                                </iframe>

                            </div>
                        </div>
                    </div>

                    <script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
                    <script>
                        const player = new Plyr('#player');
                    </script>
                    <!------------- PLYR.IO ------------>
                    <!-- If the video is self uploaded video -->

                <?php else :?>
                    <!------------- PLYR.IO ------------>
                    <link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">
                    <video poster="<?php echo $lesson_thumbnail_url;?>" id="player" playsinline controls>
                        <?php if (get_video_extension($video_url) == 'mp4'): ?>
                            <source class="remove_video_src" src="<?php echo $video_url; ?>" type="video/mp4">
                        <?php elseif (get_video_extension($video_url) == 'webm'): ?>
                            <source class="remove_video_src" src="<?php echo $video_url; ?>" type="video/webm">
                        <?php else: ?>
                            <h4><?php get_phrase('video_url_is_not_supported'); ?></h4>
                        <?php endif; ?>
                    </video>

                    <script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
                    <script>const player = new Plyr('#player');</script>
                    <!------------- PLYR.IO ------------>
                <?php endif; ?>
            <?php elseif ($lesson_details['lesson_type'] == 'quiz'): ?>
                <div class="mt-5">
                    <?php include 'quiz_view.php'; ?>
                </div>

            <?php elseif ($lesson_details['lesson_type'] == 'text' && $lesson_details['attachment_type'] == 'description'): ?>
                <div class="mt-5 px-3">
                    <?php echo htmlspecialchars_decode($lesson_details['attachment']); ?>
                </div>

            <?php else: ?>
                <?php if ($lesson_details['attachment_type'] == 'iframe'): ?>
                    <div class="mt-5 w-100">
                        <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" width="100%" height="550px" src="<?php echo $lesson_details['attachment']; ?>" allowfullscreen></iframe>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="mt-5 text-center">
                        <?php if($lesson_details['attachment_type'] == 'img'):
                            $img_size = getimagesize('uploads/lesson_files/'.$lesson_details['attachment']);
                            ?>
                            <img width="100%" style="max-width: <?php echo $img_size[0].'px'; ?>" height="auto" src="<?php echo base_url().'uploads/lesson_files/'.$lesson_details['attachment']; ?>"/>
                        <?php elseif($lesson_details['attachment_type'] == 'doc'): ?>
                            <?php if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1') { ?>
                                <p class="text-danger"><?php echo site_phrase('you_should_upload_the_application_on_a_live_server_to_preview_the_doc_file'); ?></p>
                            <?php } ?>
                            <iframe width="100%" height="500px" class="doc" src="https://docs.google.com/gview?url=<?php echo base_url().'uploads/lesson_files/'.$lesson_details['attachment']; ?>&embedded=true"></iframe>
                        <?php else: ?>
                            <iframe class="embed-responsive-item" width="100%" height="500px" src="<?php echo base_url().'uploads/lesson_files/'.$lesson_details['attachment']; ?>" allowfullscreen></iframe>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="" style="margin: 20px 0;" id = "lesson-summary">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title w-100 mb-3"><?php echo $lesson_details['lesson_type'] == 'quiz' ? get_phrase('instruction') : get_phrase("note"); ?>:</h5>
                    <?php if ($lesson_details['summary'] == ""): ?>
                        <p class="card-text"><?php echo $lesson_details['lesson_type'] == 'quiz' ? get_phrase('no_instruction_found') : get_phrase("no_summary_found"); ?></p>
                    <?php else: ?>
                        <?php echo htmlspecialchars_decode($lesson_details['summary']); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
