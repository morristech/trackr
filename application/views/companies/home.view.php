<!-- Companies -->
<section id="companies">

  <?php
  if ($this->session->flashdata('success'))
  {
	?>
    <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><?php echo $this->session->flashdata('success'); ?></div>
  <?php } ?>


  <h2 class="withbtn">Companies</h2>


  <div class="addbtn">
	<a class="btn btn-success" href="<?php echo base_url(); ?>companies/add"><i class="icon-plus-sign icon-white"></i> Add New</a>
  </div>

  <div class="clearfix"></div>



  <table class="table table-bordered table-striped">
	<thead>
	  <tr>
		<th>Name</th>
		<th>Address</th>
		<th>Options</th>
	  </tr>
	</thead>
	<tbody>
	  <?php
	  if (count($recent_items) > 0)
	  {
		foreach ($recent_items as $item)
		{
		  ?>


		<div class="modal hide" id="delmodel_<?php echo $item['cid']; ?>">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Delete <?php echo $item['name']; ?></h3>
		  </div>
		  <div class="modal-body">
			<p>Are you sure want to delete <strong><?php echo $item['name']; ?></strong>?<br />This cannot be undone and you will not able to create new company by this name again.</p>
		  </div>
		  <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="javascript:del('company', '<?php echo $item['cid']; ?>');" class="btn btn-danger">Yes Delete.</a>
		  </div>
		</div>

		<tr id="row_<?php echo $item['cid']; ?>">
		  <td><strong><?php echo $item['name']; ?><strong></td>
				<td><?php echo $item['address']; ?></td>
				<td>
				  <?php
				  if ($item['status_active'] == 1)
				  {
					?>
	  			  <a class="btn btn-success btn-mini" href="javascript:void(0);st('company', '<?php echo $item['cid']; ?>', '0')" id="cst_<?php echo $item['cid']; ?>"><i class="icon-play icon-white"></i></a>
					<?php
				  }
				  else
				  {
					?>
	  			  <a class="btn btn-warning btn-mini" href="javascript:void(0);st('company', '<?php echo $item['cid']; ?>', '1')" id="cst_<?php echo $item['cid']; ?>"><i class="icon-pause icon-white"></i></a>
				  <?php } ?>
				  <a class="btn btn-mini btn-info" href="<?php echo base_url() . 'companies/info/' . $item['cid']; ?>"><i class="icon-info-sign icon-white"></i></a>
				  <a class="btn btn-danger btn-mini" data-toggle="modal" href="#delmodel_<?php echo $item['cid']; ?>" id="cdel_<?php echo $item['cid']; ?>"><i class="icon-trash icon-white"></i></a></td>
				</tr>

				<?php
			  }
			}
			else
			{
			  ?>

  			<tr><td colspan="2">No items added to your companies yet.<td></tr>
			<?php } ?>
			</tbody>
			</table>

			</section>
			<!-- /Companies -->


			<div class="pagination">
			  <?php echo $p_links; ?>
			</div>

			<div class="clearfix"></div>