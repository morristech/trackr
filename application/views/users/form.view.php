<!-- User Form -->
<div id="loginform">

  <?php
  // preparing form elements:
  $first_name = array(
	  'name' => 'first_name',
	  'id' => 'first_name',
	  'value' => set_value('first_name'),
	  'class' => ''
  );

  $last_name = array(
	  'name' => 'last_name',
	  'id' => 'last_name',
	  'value' => set_value('last_name'),
	  'class' => ''
  );

  $email = array(
	  'name' => 'email',
	  'id' => 'email',
	  'value' => set_value('email'),
	  'class' => ''
  );

  $password = array(
	  'name' => 'password',
	  'id' => 'password',
	  'value' => set_value('password'),
	  'class' => ''
  );

  $company_rows = array();
  foreach ($companies as $company)
  {
	$company_rows[$company['cid']] = $company['name'];
  }


  $attributes_form = array('class' => '');
  echo form_open_multipart(base_url() . 'users/add', $attributes_form);
  ?>
  <h2>Add New User</h2>


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
  echo form_label('First Name', $first_name['id']);
  echo form_input($first_name);
  echo form_label('Last Name', $last_name['id']);
  echo form_input($last_name);



  echo form_label('Email', $email['id']);
  echo form_input($email);


  echo form_label('Password', $password['id']);
  echo form_input($password);
  echo '<span class="help-inline"><a id="genpass" href="javascript:void(0);genpass();">Generate Password</a></span>';


  echo form_label('Company', 'cid');
  echo form_dropdown('cid', $company_rows);
  ?>
  <div class="form-actions">
	<button type="submit" class="btn btn-primary">Save</button>
  </div>

  <?php echo form_close(); ?>
</div>
<!-- /Login Form -->