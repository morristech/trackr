<!-- Estimation Form -->
<div id="loginform">

  <?php
  // preparing form elements:
  $name = array(
	  'name' => 'name',
	  'id' => 'name',
	  'value' => set_value('name', $estimation_name),
	  'class' => ''
  );

  $resources_rows = array(
	  '1' => '1',
	  '2' => '2',
	  '3' => '3',
	  '4' => '4',
	  '5' => '5',
	  '6' => '6',
	  '7' => '7',
  );


  $attributes_form = array('class' => '');
  echo form_open_multipart(base_url() . 'estimations/add', $attributes_form);
  ?>
  <h2>Add New Estimation</h2>


  <!-- Notification -->
  <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
  <?php
  if ($this->session->flashdata('error'))
  {
	?>
    <div class="alert alert-error"><?php echo $this->session->flashdata('error'); ?></div>
  <?php } ?>


  <!-- /Notification -->

  <?php
  echo form_label('Name', $name['id']);
  echo form_input($name);

  echo form_hidden('pid', $pid);

  echo form_label('Resources', 'resources');
  echo form_dropdown('resources', $resources_rows);
  ?>
  <div class="form-actions">
	<button type="submit" class="btn btn-primary">Save</button>
  </div>

  <?php echo form_close(); ?>
</div>
<!-- /Projects Form -->

