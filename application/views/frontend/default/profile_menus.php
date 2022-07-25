<?php
$this->db->where('message_thread.receiver', $this->session->userdata('user_id'));
$this->db->where('message.sender !=', $this->session->userdata('user_id'));
$this->db->where('message.read_status', 0);
      $this->db->from('message_thread');
      $this->db->join('message', 'message_thread.message_thread_code = message.message_thread_code'); 
$unreaded_message = $this->db->get()->num_rows();
?>

<section class="page-header-area my-course-area">
  <div class="container-fluid p-0 position-relative" style="background-image: url('<?php echo base_url('assets/frontend/default/img/my_courses.jpg'); ?>'); background-position: center;
    background-size: cover;">
    <div class="image-placeholder-2"></div>
    <div class="container" style="position: inherit;">
      <h1 class="page-title py-5 text-white print-hidden"><?php echo $page_title; ?></h1>
    </div>
  </div>

  <div class="container">
    <ul class="print-hidden">
      <li class="<?php if($page_name == 'my_courses') echo 'active'; ?>"><a href="<?php echo site_url('home/my_courses'); ?>"> <i class="fas fa-fast-forward"></i> <?php echo site_phrase('courses'); ?></a></li>

      <?php if(addon_status('ebook')): ?>
        <li class="<?php if($page_name == 'my_ebooks' || $page_name == 'ebook_invoice') echo 'active'; ?>">
          <a href="<?php echo site_url('home/my_ebooks'); ?>"> <i class="fas fa-book"></i>
          <?php echo site_phrase('ebooks'); ?></a></li>
      <?php endif; ?>

      <?php if(addon_status('course_bundle')): ?>
        <li class="<?php if($page_name == 'my_bundles' || $page_name == 'bundle_invoice') echo 'active'; ?>"><a href="<?php echo site_url('home/my_bundles'); ?>"> <i class="fas fa-cubes"></i> <?php echo site_phrase('bundles'); ?></a></li>
      <?php endif; ?>

      <li class="<?php if($page_name == 'my_wishlist') echo 'active'; ?>"><a href="<?php echo site_url('home/my_wishlist'); ?>"> <i class="far fa-heart"></i> <?php echo site_phrase('wishlists'); ?></a></li>

      <li class="<?php if($page_name == 'my_messages') echo 'active'; ?>">
        <a href="<?php echo site_url('home/my_messages'); ?>">
          <i class="far fa-comments"></i> <?php echo site_phrase('messages'); ?>
          <?php if($unreaded_message > 0): ?>
            <span class="badge bg-warning float-right"><?php echo $unreaded_message; ?></span>
          <?php endif; ?>
        </a>
      </li>

      <li class="<?php if($page_name == 'purchase_history' || $page_name == 'invoice') echo 'active'; ?>"><a href="<?php echo site_url('home/purchase_history'); ?>"> <i class="fas fa-history"></i> <?php echo site_phrase('purchase_history'); ?></a></li>

      <li class="<?php if($page_name == 'user_profile' || $page_name == 'user_credentials' || $page_name == 'update_user_photo') echo 'active'; ?>"><a href="<?php echo site_url('home/profile/user_profile'); ?>"> <i class="far fa-user-circle"></i> <?php echo site_phrase('profile'); ?></a></li>
    </ul>
    </div>
</section>