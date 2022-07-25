<form action="javascript:;" method="post">
	<div class="form-group">
		<label for="purchase_code_form_field"><?php echo get_phrase('purchase_code'); ?></label>
		<input type="text" class="form-control mb-1" name="purchase_code" id="purchase_code_form_field">
		<span id="invalid_purchase_code_message" class="d-hidden badge badge-danger-lighten"><?php echo get_phrase('invalid_purchase_code'); ?></span>
	</div>
	<div class="form-group">
		<button class="btn btn-primary" onclick="save_purchase_code();" type="button"><?php echo get_phrase('submit'); ?></button>
	</div>
</form>

<script type="text/javascript">
	function save_purchase_code(){
		var purchase_code = $('#purchase_code_form_field').val();
		$.ajax({
			url: '<?php echo site_url('admin/save_valid_purchase_code/update'); ?>',
			type: 'post',
			data: {purchase_code : purchase_code},
			success: function(response) {
				if(response == 1){
					window.location.reload();
				}else{
					$('#invalid_purchase_code_message').show();
				}
			}
		});
	}
</script>