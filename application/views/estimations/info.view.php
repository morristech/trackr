
<!-- estimation_info -->
<section id="estimation_info">

  <h2><?php echo $estimation['name']; ?></h2>

  <div class="row">
    <div class="span4">
	  <address>
		<?php
		$datestring = "%d/%m/%Y %h:%i";
		echo mdate($datestring, $estimation['created_date']);
		?>
	  </address>
    </div>

</section>
<!-- /Project -->


<section id="estimation_info_entry">
  <h3 class="withbtn">Features / Tasks</h3>
  <div class="addbtn">
	<a class="btn btn-success btn-mini" data-toggle="modal" href="#addmodel"><i class="icon-plus icon-white"></i></a>
	<a class="btn btn-primary btn-mini" href="<?php echo base_url() . 'estimations/process_estimation/' . $estimation['estid'] . ''; ?>"><i class="icon-refresh icon-white"></i></a>
  </div>

  <div class="clearfix"></div>

  <div id="estimates_table" class="estimates_table">

	<table class="table table-bordered">
	  <thead class="breadcrumb">
		<tr>
		  <th style="width: 12%;">#</th>
		  <th style="width: 15%;">Task</th>
		  <th>Description</th>
		  <th>Hours</th>
		  <th>Rate</th>
		  <th>Cost</th>
		</tr>
	  </thead>


	  <?php
	  if (is_array($ig))
	  {
		?>
  	  <div id="ig">
  		<tr> <td colspan="6"><h4>Phase: Information Gathering</h4></td></tr>

  		<tbody>
			<?php
			foreach ($ig as $item)
			{
			  ?>
			  <tr>
				<td style="font-size: 11px;"><?php echo strtoupper($item['wbscode']); ?></td>
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo $item['hours']; ?></td>
				<td><?php echo money_format_us('%i', $item['rate']); ?></td>
				<td><?php echo money_format_us('%i', $item['cost']); ?></td>
			  </tr>
			<?php } ?>
  		</tbody>

  	  </div>
	  <?php } ?>


	  <?php
	  if (is_array($pp))
	  {
		?>
  	  <div id="pp">
  		<tr> <td colspan="6"><h4>Phase: Project Plan</h4></td></tr>
  		<tbody>
			<?php
			foreach ($pp as $item)
			{
			  ?>
			  <tr>
				<td style="font-size: 11px;"><?php echo strtoupper($item['wbscode']); ?></td>
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo $item['hours']; ?></td>
				<td><?php echo money_format_us('%i', $item['rate']); ?></td>
				<td><?php echo money_format_us('%i', $item['cost']); ?></td>
			  </tr>
			<?php } ?>
  		</tbody>

  	  </div>
	  <?php } ?>


	  <?php
	  if (is_array($dw))
	  {
		?>
  	  <div id="dw">
  		<tr> <td colspan="6"><h4>Phase: Design and Wireframes</h4></td></tr>

  		<tbody>
			<?php
			foreach ($dw as $item)
			{
			  ?>
			  <tr>
				<td style="font-size: 11px;"><?php echo strtoupper($item['wbscode']); ?></td>
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo $item['hours']; ?></td>
				<td><?php echo money_format_us('%i', $item['rate']); ?></td>
				<td><?php echo money_format_us('%i', $item['cost']); ?></td>
			  </tr>
			<?php } ?>
  		</tbody>

  	  </div>
	  <?php } ?>


	  <?php
	  if (is_array($api))
	  {
		?>
  	  <div id="api">
  		<tr> <td colspan="6"><h4>Phase: Webservices</h4></td></tr>

  		<tbody>
			<?php
			foreach ($api as $item)
			{
			  ?>
			  <tr>
				<td style="font-size: 11px;"><?php echo strtoupper($item['wbscode']); ?></td>
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo $item['hours']; ?></td>
				<td><?php echo money_format_us('%i', $item['rate']); ?></td>
				<td><?php echo money_format_us('%i', $item['cost']); ?></td>
			  </tr>
			<?php } ?>
  		</tbody>

  	  </div>
	  <?php } ?>


	  <?php
	  if (is_array($iosiphone))
	  {
		?>
  	  <div id="iosiphone">
  		<tr> <td colspan="6">	<h4>Phase: iPhone App Development</h4></td></tr>

  		<tbody>
			<?php
			foreach ($iosiphone as $item)
			{
			  ?>
			  <tr>
				<td style="font-size: 11px;"><?php echo strtoupper($item['wbscode']); ?></td>
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo $item['hours']; ?></td>
				<td><?php echo money_format_us('%i', $item['rate']); ?></td>
				<td><?php echo money_format_us('%i', $item['cost']); ?></td>
			  </tr>
			<?php } ?>
  		</tbody>
  	  </div>
	  <?php } ?>



	  <?php
	  if (is_array($iosipad))
	  {
		?>
  	  <div id="iosipad">
  		<tr> <td colspan="6"><h4>Phase: iPad App Development</h4></td></tr>

  		<tbody>
			<?php
			foreach ($iosipad as $item)
			{
			  ?>
			  <tr>
				<td style="font-size: 11px;"><?php echo strtoupper($item['wbscode']); ?></td>
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo $item['hours']; ?></td>
				<td><?php echo money_format_us('%i', $item['rate']); ?></td>
				<td><?php echo money_format_us('%i', $item['cost']); ?></td>
			  </tr>
			<?php } ?>
  		</tbody>
  	  </div>
	  <?php } ?>



	  <?php
	  if (is_array($iosuniversal))
	  {
		?>
  	  <div id="iosuniversal">
  		<tr> <td colspan="6"><h4>Phase: iOS Universal App Development</h4></td></tr>

  		<tbody>
			<?php
			foreach ($iosuniversal as $item)
			{
			  ?>
			  <tr>
				<td style="font-size: 11px;"><?php echo strtoupper($item['wbscode']); ?></td>
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo $item['hours']; ?></td>
				<td><?php echo money_format_us('%i', $item['rate']); ?></td>
				<td><?php echo money_format_us('%i', $item['cost']); ?></td>
			  </tr>
			<?php } ?>
  		</tbody>
  	  </div>
	  <?php } ?>


	  <?php
	  if (is_array($android))
	  {
		?>
  	  <div id="android">
  		<tr> <td colspan="6"><h4>Phase: Android App Development</h4></td></tr>

  		<tbody>
			<?php
			foreach ($android as $item)
			{
			  ?>
			  <tr>
				<td style="font-size: 11px;"><?php echo strtoupper($item['wbscode']); ?></td>
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo $item['hours']; ?></td>
				<td><?php echo money_format_us('%i', $item['rate']); ?></td>
				<td><?php echo money_format_us('%i', $item['cost']); ?></td>
			  </tr>
			<?php } ?>
  		</tbody>
  	  </div>
	  <?php } ?>


	  <?php
	  if (is_array($androidtab))
	  {
		?>
  	  <div id="androidtab">
  		<tr> <td colspan="6"><h4>Phase: Android Tablet App Development</h4></td></tr>

  		<tbody>
			<?php
			foreach ($androidtab as $item)
			{
			  ?>
			  <tr>
				<td style="font-size: 11px;"><?php echo strtoupper($item['wbscode']); ?></td>
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo $item['hours']; ?></td>
				<td><?php echo money_format_us('%i', $item['rate']); ?></td>
				<td><?php echo money_format_us('%i', $item['cost']); ?></td>
			  </tr>
			<?php } ?>
  		</tbody>
  	  </div>
	  <?php } ?>


	  <?php
	  if (is_array($bb))
	  {
		?>
  	  <div id="bb">
  		<tr> <td colspan="6"><h4>Phase: BlackBerry App Development</h4></td></tr>

  		<tbody>
			<?php
			foreach ($bb as $item)
			{
			  ?>
			  <tr>
				<td style="font-size: 11px;"><?php echo strtoupper($item['wbscode']); ?></td>
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo $item['hours']; ?></td>
				<td><?php echo money_format_us('%i', $item['rate']); ?></td>
				<td><?php echo money_format_us('%i', $item['cost']); ?></td>
			  </tr>
			<?php } ?>
  		</tbody>

  	  </div>
	  <?php } ?>



	  <?php
	  if (is_array($cms))
	  {
		?>
  	  <div id="cms">
  		<tr> <td colspan="6"><h4>Phase: CMS Development</h4></td></tr>

  		<tbody>
			<?php
			foreach ($cms as $item)
			{
			  ?>
			  <tr>
				<td style="font-size: 11px;"><?php echo strtoupper($item['wbscode']); ?></td>
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo $item['hours']; ?></td>
				<td><?php echo money_format_us('%i', $item['rate']); ?></td>
				<td><?php echo money_format_us('%i', $item['cost']); ?></td>
			  </tr>
			<?php } ?>
  		</tbody>

  	  </div>
	  <?php } ?>


	</table>
  </div> <!-- /estimates_table -->


</section>

<div class="clearfix"></div>

<div class="modal hide" id="addmodel">
  <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">×</button>
	<h3>Add New Item</h3>
  </div>
  <div class="modal-body">

	<?php
	// preparing form elements:
	$name = array(
		'name' => 'name',
		'id' => 'name',
		'value' => set_value('name'),
		'class' => ''
	);

	$description = array(
		'name' => 'description',
		'id' => 'description',
		'value' => set_value('description'),
		'class' => '',
		'rows' => 1,
		'style' => 'width: 500px;',
	);

	$detail = array(
		'name' => 'detail',
		'id' => 'detail',
		'value' => set_value('detail'),
		'class' => '',
		'rows' => 3,
		'style' => 'width: 500px',
	);

	$notes = array(
		'name' => 'notes',
		'id' => 'notes',
		'value' => set_value('notes'),
		'rows' => 2,
		'style' => 'width: 500px',
	);

	$hours = array(
		'name' => 'hours',
		'id' => 'hours',
		'value' => set_value('hours'),
		'class' => 'input-mini inline',
		'placeholder' => 'Hours',
		'onBlur' => "javascript:calcmulti('rate', 'hours', 'cost');"
	);

	$rate = array(
		'name' => 'rate',
		'id' => 'rate',
		'value' => set_value('rate'),
		'class' => 'input-mini inline',
		'placeholder' => 'Rate',
		'onBlur' => "javascript:calcmulti('rate', 'hours', 'cost');"
	);

	$cost = array(
		'name' => 'cost',
		'id' => 'cost',
		'value' => 'USD ',
		'class' => 'input-medium inline',
		'disabled' => 'disabled'
	);

	$phases_rows = array(
		'ig' => 'Information Gathering',
		'pp' => 'Project Plan',
		'dw' => 'Design and Wireframes',
		'api' => 'Webservices',
		'iosiphone' => 'iPhone App Development',
		'iosipad' => 'iPad App Development',
		'iosuniversal' => 'iOS Universal App Development',
		'android' => 'Android App Development',
		'androidtab' => 'Android Tablet App Development',
		'bb' => 'BlackBerry App Development',
		'cms' => 'CMS Development',
	);


	$attributes_form = array('class' => '', 'id' => 'addhltask');
	echo '<div class="row">';
	echo form_open_multipart('', $attributes_form);
	?>

	<?php
	echo form_hidden('estid', $estid);

	echo '<div class="span3">';
	echo form_label('Name', $name['id']);
	echo form_input($name);
	echo form_label('Phase', 'phase');
	echo form_dropdown('phase', $phases_rows);

	echo '</div>';

	echo '<div class="span3">';
	echo form_label('Costing');
	echo form_input($rate);
	echo form_input($hours);
	echo form_input($cost);

	echo '</div>';

	echo '<div class="span6">';

	echo form_label('Description', $description['id']);
	echo form_textarea($description);

	echo form_label('Developer Notes', $notes['id']);
	echo form_textarea($notes);

	echo form_label('Functional Specification', $detail['id']);
	echo form_textarea($detail);
	echo '</div>';
	?>

	<?php echo form_close(); ?>
  </div>

</div>
<div class="modal-footer">
  <a href="#" class="btn" data-dismiss="modal">Close</a>
  <a class="btn btn-success" id="savehltask" onclick="javascript:savehttask();">Save</a>
</div>
</div>