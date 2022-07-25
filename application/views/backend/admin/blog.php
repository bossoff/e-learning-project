<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body py-2">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('blogs'); ?>
                    <a href="<?php echo site_url('admin/add_blog'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_new_blog'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('blogs'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap dataTable no-footer dtr-inline collapsed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('creator'); ?></th>
                                <th><?php echo get_phrase('title'); ?></th>
                                <th><?php echo get_phrase('category'); ?></th>
                                <th><?php echo get_phrase('status'); ?></th>
                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($blogs->result_array() as $key => $blog) : ?>
                            	<?php $user_details = $this->user_model->get_all_user($blog['user_id'])->row_array(); ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td>
                                    	<a href="<?php echo site_url('home/instructor_page/'.$blog['user_id']); ?>" target="_blank">
	                                    	<div class="d-flex">
	                                    		<div>
	                                        		<img src="<?php echo $this->user_model->get_user_image_url($user_details['id']); ?>" alt="" height="50" width="50" class="img-fluid rounded-circle img-thumbnail">
	                                        	</div>
		                                        <div class="pl-1 pt-1">
			                                    	<?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?>
			                                    	<p><?php echo $user_details['email']; ?></p>
			                                    </div>
			                                </div>
			                            </a>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url('blog/details/'.slugify($blog['title']).'/'.$blog['blog_id']); ?>" target="_blank"><?php echo $blog['title']; ?></a><br>
                                        <small class="text-muted"><?php echo date('d M Y', $blog['added_date']); ?></small>
                                    </td>
                                    <td><?php echo $this->crud_model->get_blog_categories($blog['blog_category_id'])->row('title'); ?></td>
                                    <td>
                                        <?php if($blog['status'] == 1): ?>
                                        	<span class="badge badge-success"><?php echo get_phrase('active'); ?></span>
                                        <?php else: ?>
                                        	<span class="badge badge-secondary"><?php echo get_phrase('inactive'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="dropright dropright">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="<?php echo site_url('admin/edit_blog/' . $blog['blog_id']) ?>"><?php echo get_phrase('edit'); ?></a></li>
                                                <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('admin/blog/status/' . $blog['blog_id']); ?>');">
                                                	<?php if($blog['status'] == 1){echo get_phrase('deactivate'); }else{ echo get_phrase('activate'); } ?>
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('admin/blog/delete/' . $blog['blog_id']); ?>');"><?php echo get_phrase('delete'); ?></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>