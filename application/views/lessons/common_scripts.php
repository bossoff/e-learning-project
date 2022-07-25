<script type="text/javascript">
//saving the current progress and starting from the saved progress
var newProgress;
var savedProgress;
var currentProgress = '<?php echo lesson_progress($lesson_id); ?>';
var lessonType = '<?php echo $lesson_details['lesson_type']; ?>';
var videoProvider = '<?php echo isset($provider) ? $provider : null; ?>';

function markThisLessonAsCompleted(lesson_id) {
  $('#lesson_list_area').hide();
  $('#lesson_list_loader').show();
  var course_id = "<?php echo $course_details['id']; ?>";

  $.ajax({
    type : 'POST',
    url : '<?php echo site_url('home/update_watch_history_manually'); ?>',
    data : {lesson_id : lesson_id, course_id:course_id},
    success : function(response){
      $('#lesson_list_area').show();
      $('#lesson_list_loader').hide();
      var responseVal = JSON.parse(response);
      // console.log(responseVal);
      // console.log(responseVal.course_progress);
    }
  });
}


$(document).ready(function() {
  if (lessonType == 'video' && videoProvider == 'html5') {
    var totalDuration = document.querySelector('#player').duration;

    if (currentProgress == 1 || currentProgress == totalDuration) {
      document.querySelector('#player').currentTime = 0;
    }else {
      document.querySelector('#player').currentTime = currentProgress;
    }
  }
});

var counter = 0;
player.on('canplay', event => {
  if (counter == 0) {
    if (currentProgress == 1) {
      document.querySelector('#player').currentTime = 0;
    }else{
      document.querySelector('#player').currentTime = currentProgress;
    }
  }
  counter++;
});


//const player = new Plyr('#player');
if(<?php echo $course_details['enable_drip_content']; ?> && typeof player === 'object' && player !== null){
    let lesson_id = '<?php echo $lesson_id; ?>';
    let course_id = '<?php echo $course_details['id']; ?>';
    let previousSavedDuration = 0;
    let currentDuration = 0;
    setInterval(function(){
        if("<?php echo $lesson_details['lesson_type']; ?>" == "video"){
            currentDuration = parseInt(player.currentTime);
        }else{
            currentDuration = 0;
        }

        if (lesson_id && course_id && (currentDuration%5) == 0 && previousSavedDuration != currentDuration) {
            previousSavedDuration = currentDuration;

            $.ajax({
              type : 'POST',
              url : '<?php echo site_url('home/update_watch_history_with_duration'); ?>',
              data : {lesson_id : lesson_id, course_id : course_id, current_duration: currentDuration},
              success : function(response){
                var responseVal = JSON.parse(response);
                // console.log(responseVal);
                // console.log(responseVal.course_progress);

              }
            });
        }

        //console.log('Avoid Server Call'+currentDuration);
    }, 1000);
}


setTimeout(function(){
  $('.remove_video_src').remove();
}, 500);
</script>