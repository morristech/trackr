<!-- Companies -->
<section id="companies">

    <h2><?php echo $company['name']; ?></h2>

    <div class="row-fluid">
        <div class="span6">
            <?php echo $company['address']; ?>
        </div>


        <div class="span6">
            <div class="image"><img src="<?php if ($company['thumb_path'])
            {
                echo base_url() . config_item('image_path_company'); ?><?php echo $company['thumb_path'];
            } ?>" /></div>
        </div>
    </div

</section>
<!-- /Companies -->



<div class="clearfix"></div>

