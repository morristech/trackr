<!-- Users -->
<section id="users">

  <h2><?php echo $user['first_name'] .' '. $user['last_name']; ?></h2>

  <div class="row">
    <div class="span4">
	  <address>
		<?php echo $user['email']; ?>
	  </address>
    </div>

<?php if ($user['profile_pic_path']) { ?>
    <div class="span4">
	  <div class="image"><img src="<?php echo base_url() . config_item('image_path_users'); ?><?php echo $user['profile_pic_path']; ?>" /></div>
    </div>
  </div

  <?php } ?>

</section>
<!-- /Users -->



<div class="clearfix"></div>

