<!-- Timeline -->
<section id="timeline">

  <h3>Timeline</h3>



  <ul class="nav nav-tabs nav-stacked">
	<?php
	if (count($recent_items) > 0)
	{
	  foreach ($recent_items as $item)
	  {
		?>
		<li class="<?php echo $item['item_type']; ?>"><a><?php echo $item['item_title']; ?> <span class="date"> was added <?php
	$now = time();
	echo timespan($item['addedtime'], $now);
		?> ago.</span>
		  </a></li>
		<?php
	  }
	}
	else
	{
	  ?>

  	<li>No items added to your timeline yet.</li>
	<?php } ?>
  </ul>



  <ul class="pagination">
	<?php echo $p_links; ?>
  </ul>



</section>
<!-- /Timeline -->



<div class="clearfix"></div>

