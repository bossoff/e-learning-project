<div class="container-fluid position-fixed py-2 bg-light" style="top: 0; z-index: 3000;">
	<div class="row mx-1">
		<div class="col-auto p-0">
			<a class="btn btn-secondary fw-bold w-100 text-start" href="<?php echo $this->session->userdata('app_url'); ?>">
				<i class="fa fa-arrow-left"></i>  <?php echo site_phrase('back_to_mobile_app'); ?>
			</a>
		</div>
		<div class="col-auto ms-auto p-0">
			<a class="btn btn-secondary" href="<?php echo site_url('home/closed_back_to_mobile_ber'); ?>"><i class="fa fa-times"></i></a>
		</div>
	</div>
	
</div>
<div class="container-fluid py-4"></div>