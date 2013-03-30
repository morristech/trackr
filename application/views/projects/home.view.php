<!-- Projects -->
<section id="projects">

  <?php
  if ($this->session->flashdata('success'))
  {
	?>
    <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><?php echo $this->session->flashdata('success'); ?></div>
  <?php } ?>


  <h2 class="withbtn">Projects</h2>


  <div class="addbtn">
	<a class="btn btn-success" href="<?php echo base_url(); ?>projects/add"><i class="icon-plus-sign icon-white"></i> Add New</a>
  </div>

  <div class="clearfix"></div>

<?php
  if (count($recent_items) > 0)
	  {
?>
  <table class="table table-bordered table-striped">
	<thead>
	  <tr>
		<th>Name</th>
		<th>Assigned Company</th>
		<th>Options</th>
	  </tr>
	</thead>
	<tbody>
	  <?php
		foreach ($recent_items as $item)
		{

			
		  ?>


		<div class="modal hide" id="delmodel_<?php echo $item['pid']; ?>">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Delete <?php echo $item['name']; ?></h3>
		  </div>
		  <div class="modal-body">
			<p>Are you sure want to delete <strong><?php echo $item['name']; ?></strong>?<br />This cannot be undone and you will not able to create new project by this name again.</p>
		  </div>
		  <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="javascript:del('project', '<?php echo $item['pid']; ?>');" class="btn btn-danger">Yes Delete.</a>
		  </div>
		</div>

		<tr id="row_<?php echo $item['pid']; ?>">
		  <td><strong><?php echo $item['name']; ?><strong>   </td>
				<td><a href="<?php echo base_url() . 'companies/info/' . $item['company_id']; ?>"><?php echo $item['company_name']; ?></a></td>
				<td>
				  <?php
				  if ($item['status_active'] == 1)
				  {
					?>
	  			  <a class="btn btn-success btn-mini" href="javascript:void(0);st('project', '<?php echo $item['pid']; ?>', '0')" id="pst_<?php echo $item['pid']; ?>"><i class="icon-play icon-white"></i></a>
					<?php
				  }
				  else
				  {
					?>
	  			  <a class="btn btn-warning btn-mini" href="javascript:void(0);st('project', '<?php echo $item['pid']; ?>', '1')" id="pst_<?php echo $item['pid']; ?>"><i class="icon-pause icon-white"></i></a>
				  <?php } ?>
				  <a class="btn btn-mini btn-info" href="<?php echo base_url() . 'projects/info/' . $item['pid']; ?>"><i class="icon-info-sign icon-white"></i></a>
				  <a class="btn btn-mini btn-primary" href="<?php echo base_url() . 'projects/edit/' . $item['pid']; ?>"><i class="icon-edit icon-white"></i></a>

				  <a class="btn btn-mini btn-primary" href="<?php echo base_url() . 'projects/permissions/' . $item['pid']; ?>"><i class="icon-user icon-white"></i></a>

				  <a class="btn btn-danger btn-mini" data-toggle="modal" href="#delmodel_<?php echo $item['pid']; ?>" id="pdel_<?php echo $item['pid']; ?>"><i class="icon-trash icon-white"></i></a></td>

				</tr>

				<?php
			}
		
?>
			</tbody>
			</table>
			<?php } 
			else {
				?>
<p>No project available in the system yet. </p>
		<?php	} ?>

			</section>
			<!-- /Projects -->


			<div class="pagination">
			  <?php echo $p_links; ?>
			</div>

			<div class="clearfix"></div>