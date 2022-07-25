<input type="hidden" name="lesson_type" value="text-description">

<div class="form-group">
    <label for="text_description"> <?php echo get_phrase('enter_your_text'); ?></label>
    <textarea name="text_description" class="form-control" id="text_description" rows="4"></textarea>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        initSummerNote(['#text_description']);
    });
</script>