<!-- Project -->
<section id="project">

  <h2><?php echo $project['name']; ?></h2>


		<?php echo $project['description']; ?>


</section>
<!-- /Project -->


<section id="estimations">
  <h3 class="withbtn"><?php echo $project['name']; ?> Estimates</h3>

  <div class="addbtn">
	<a class="btn btn-success" href="<?php echo base_url(); ?>estimations/add/<?php echo $project['pid']; ?>"><i class="icon-plus-sign icon-white"></i> Add New Estimate</a>
  </div>

  <div class="clearfix"></div>

  <table class="table table-bordered table-striped">
	<thead>
	  <tr>
		<th>Name</th>
		<th>Project</th>
		<th>Resources</th>
		<th>Duration (Weeks)</th>
		<th>Efforts (Hours)</th>
		<th>Cost</th>
		<th>Created</th>
		<th>Options</th>
	  </tr>
	</thead>
	<tbody>
	  <?php
	  if (count($estimations) > 0)
	  {
		foreach ($estimations as $item)
		{
		  ?>


		<div class="modal hide" id="delmodel_<?php echo $item['estid']; ?>">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Delete <?php echo $item['name']; ?></h3>
		  </div>
		  <div class="modal-body">
			<p>Are you sure want to delete <strong><?php echo $item['name']; ?></strong>?<br />This cannot be undone and you will not able to create new estimation by this name again.</p>
		  </div>
		  <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="javascript:del('estimation', '<?php echo $item['estid']; ?>');" class="btn btn-danger">Yes Delete.</a>
		  </div>
		</div>

		<tr id="row_<?php echo $item['estid']; ?>">
		  <td><strong><?php echo $item['name']; ?><strong>   </td>
				<td><a href="<?php echo base_url() . 'projects/info/' . $item['project_id']; ?>"><?php echo $item['project_name']; ?></a></td>

				<td><?php echo $item['resources']; ?> person(s)</td>
				<td><?php echo $item['duration']; ?></td>
				<td><?php echo $item['hours']; ?></td>
				<td><?php echo money_format('%i', $item['cost']); ?></td>

<td><?php
$datestring = "%d/%m/%Y %h:%i %a";
echo mdate($datestring, $item['created_date']);
?></td>

				<td>
				  <?php
				  if ($item['status_active'] == 1)
				  {
					?>
	  			  <a class="btn btn-success btn-mini" href="javascript:void(0);st('estimation', '<?php echo $item['estid']; ?>', '0')" id="est_<?php echo $item['estid']; ?>"><i class="icon-play icon-white"></i></a>
					<?php
				  }
				  else
				  {
					?>
	  			  <a class="btn btn-warning btn-mini" href="javascript:void(0);st('estimation', '<?php echo $item['estid']; ?>', '1')" id="est_<?php echo $item['estid']; ?>"><i class="icon-pause icon-white"></i></a>
				  <?php } ?>
				  <a class="btn btn-mini btn-info" href="<?php echo base_url() . 'estimations/info/' . $item['estid']; ?>"><i class="icon-info-sign icon-white"></i></a>

	<a class="btn btn-primary btn-mini" href="<?php echo base_url() . 'estimations/process_estimation/' . $item['estid'] . ''; ?>"><i class="icon-refresh icon-white"></i></a>

				  <a class="btn btn-danger btn-mini" data-toggle="modal" href="#delmodel_<?php echo $item['estid']; ?>" id="edel_<?php echo $item['estid']; ?>"><i class="icon-trash icon-white"></i></a>

				</td>

				</tr>

				<?php
			  }
			}
			else
			{
			  ?>

  			<tr><td colspan="7">No items added in estimations yet.<td></tr>
			<?php } ?>
			</tbody>
			</table>



</section>

<div class="clearfix"></div>

