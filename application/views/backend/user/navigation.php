<?php
$status_wise_courses = $this->crud_model->get_status_wise_courses();
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu left-side-menu-detached">
	<div class="leftbar-user">
		<a href="javascript: void(0);">
			<img src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="user-image" height="42" class="rounded-circle shadow-sm">
			<?php
			$user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
			?>
			<span class="leftbar-user-name"><?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?></span>
		</a>
	</div>

	<!--- Sidemenu -->
	<ul class="metismenu side-nav side-nav-light">

		<li class="side-nav-title side-nav-item"><?php echo get_phrase('navigation'); ?></li>
		<?php if(get_settings('allow_instructor') == 1): ?>
			<?php if ($this->session->userdata('is_instructor')) : ?>
				<li class="side-nav-item">
					<a href="<?php echo site_url('user/dashboard'); ?>" class="side-nav-link <?php if ($page_name == 'dashboard') echo 'active'; ?>">
						<i class="dripicons-view-apps"></i>
						<span><?php echo get_phrase('dashboard'); ?></span>
					</a>
				</li>
				<li class="side-nav-item">
					<a href="<?php echo site_url('user/courses'); ?>" class="side-nav-link <?php if ($page_name == 'courses' || $page_name == 'course_add' || $page_name == 'course_edit') echo 'active'; ?>">
						<i class="dripicons-archive"></i>
						<span><?php echo get_phrase('course_manager'); ?></span>
					</a>
				</li>
				<?php if (addon_status('ebook')) : ?>
			        <li class="side-nav-item">
			            <a href="javascript: void(0);"
			                class="side-nav-link <?php if ($page_name == 'all_ebooks' || $page_name == 'add_ebook' || $page_name == 'ebook_edit') : ?> active <?php endif; ?>">
			                <i class="dripicons-document"></i>
			                <span> <?php echo get_phrase('ebook'); ?> </span>
			                <span class="menu-arrow"></span>
			            </a>
			            <ul class="side-nav-second-level <?php if ($page_name == 'ebook_edit') echo 'in'; ?>" aria-expanded="false">
			                <li class="<?php if ($page_name == 'all_ebooks' || $page_name == 'ebook_edit') echo 'active'; ?>">
			                    <a
			                        href="<?php echo site_url('addons/ebook_manager/ebook'); ?>"><?php echo get_phrase('all_ebooks'); ?></a>
			                </li>
			                <li class="<?php if ($page_name == 'add_ebook') echo 'active'; ?>">
			                    <a
			                        href="<?php echo site_url('ebook_manager/add_ebook'); ?>"><?php echo get_phrase('add_ebook'); ?></a>
			                </li>
			                <li class="<?php if ($page_name == 'ebook_instructor_revenue') echo 'active'; ?>">
			                    <a
			                        href="<?php echo site_url('addons/ebook_manager/payment_history/instructor_revenue'); ?>"><?php echo get_phrase('sales_report'); ?></a>
			                </li>
			            </ul>
			        </li>
			    <?php endif; ?>
				<li class="side-nav-item">
					<a href="<?php echo site_url('user/sales_report'); ?>" class="side-nav-link <?php if ($page_name == 'report' || $page_name == 'invoice') echo 'active'; ?>">
						<i class="dripicons-to-do"></i>
						<span><?php echo get_phrase('sales_report'); ?></span>
					</a>
				</li>
				<li class="side-nav-item">
					<a href="<?php echo site_url('user/payout_report'); ?>" class="side-nav-link <?php if ($page_name == 'payout_report' || $page_name == 'invoice') echo 'active'; ?>">
						<i class="dripicons-shopping-bag"></i>
						<span><?php echo get_phrase('payout_report'); ?></span>
					</a>
				</li>
				<li class="side-nav-item">
					<a href="<?php echo site_url('user/payout_settings'); ?>" class="side-nav-link <?php if ($page_name == 'payment_settings') echo 'active'; ?>">
						<i class="dripicons-gear"></i>
						<span><?php echo get_phrase('payout_settings'); ?></span>
					</a>
				</li>
			<?php else : ?>
				<li class="side-nav-item">
					<a href="<?php echo site_url('user/become_an_instructor'); ?>" class="side-nav-link <?php if ($page_name == 'become_an_instructor') echo 'active'; ?>">
						<i class="dripicons-archive"></i>
						<span><?php echo get_phrase('become_an_instructor'); ?></span>
					</a>
				</li>
			<?php endif; ?>
		<?php endif; ?>

		<li class="side-nav-item">
			<a href="<?php echo site_url('home/my_messages'); ?>" class="side-nav-link">
				<i class="dripicons-mail"></i>
				<span><?php echo get_phrase('message'); ?></span>
				<?php
					$this->db->where('message_thread.receiver', $this->session->userdata('user_id'));
					$this->db->where('message.sender !=', $this->session->userdata('user_id'));
					$this->db->where('message.read_status', 0);
		            $this->db->from('message_thread');
		            $this->db->join('message', 'message_thread.message_thread_code = message.message_thread_code'); 
					$unreaded_message = $this->db->get()->num_rows();
				?>
				<?php if($unreaded_message > 0): ?>
					<span class="badge badge-danger-lighten float-right"><?php echo $unreaded_message; ?></span>
				<?php endif; ?>
			</a>
		</li>

		<?php if (get_frontend_settings('instructors_blog_permission') && $this->session->userdata('is_instructor')) : ?>
			<li class="side-nav-item <?php if ($page_name == 'blog' || $page_name == 'blog_add' || $page_name == 'blog_edit' || $page_name == 'instructors_pending_blog') : ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'blog' || $page_name == 'blog_add' || $page_name == 'blog_edit' || $page_name == 'instructors_pending_blog') : ?> active <?php endif; ?>">
					<i class="dripicons-blog"></i>
					<span> <?php echo get_phrase('blog'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class="<?php if ($page_name == 'blog') echo 'active'; ?>">
						<a href="<?php echo site_url('user/blog'); ?>"><?php echo get_phrase('all_blogs'); ?></a>
					</li>

					<li class="<?php if ($page_name == 'instructors_pending_blog') echo 'active'; ?>">
						<a href="<?php echo site_url('user/pending_blog'); ?>"><?php echo get_phrase('pending_blog'); ?> <span class="badge badge-danger-lighten"><?php echo $this->crud_model->get_instructors_pending_blog()->num_rows(); ?></span></a>
					</li>
				</ul>
			</li>
		<?php endif; ?>

		<?php if (addon_status('customer_support')) : ?>
			<li class="side-nav-item <?php if ($page_name == 'tickets' || $page_name == 'create_ticket') : ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link">
					<i class="dripicons-help"></i>
					<span> <?php echo get_phrase('support'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class="<?php if ($page_name == 'tickets') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/customer_support/user_tickets'); ?>"><?php echo get_phrase('ticket_list'); ?></a>
					</li>
					<li class="<?php if ($page_name == 'create_ticket') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/customer_support/create_support_ticket'); ?>"><?php echo get_phrase('create_ticket'); ?></a>
					</li>
				</ul>
			</li>
		<?php endif; ?>

		<li class="side-nav-item">
			<a href="<?php echo site_url('home/profile/user_profile'); ?>" class="side-nav-link">
				<i class="dripicons-user"></i>
				<span><?php echo get_phrase('manage_profile'); ?></span>
			</a>
		</li>
	</ul>
</div>