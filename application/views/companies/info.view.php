<!-- Companies -->
<section id="companies">



  <h2><?php echo $company['name']; ?></h2>

  <div class="row">
    <div class="span4">
	  <address>
		<?php echo $company['address']; ?>
	  </address>
    </div>


    <div class="span4">
	  <div class="image"><img src="<?php echo base_url() . config_item('image_path_company'); ?><?php echo $company['thumb_path']; ?>" /></div>
    </div>
  </div

</section>
<!-- /Companies -->



<div class="clearfix"></div>

