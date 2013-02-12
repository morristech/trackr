<!-- Projects Form -->
<div id="loginform">

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
	  'rows' => 10,
	  'style' => 'width: 80%;',
	  'class' => ''
  );

  $company_rows = array();
  foreach ($companies as $company)
  {
	$company_rows[$company['cid']] = $company['name'];
  }


  $attributes_form = array('class' => '');
  echo form_open_multipart(base_url() . 'projects/add', $attributes_form);
  ?>
  <h2>Add New Project</h2>


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

  echo form_label('Description / Requirments', $description['id']);
  ?>
  <p>
  <div id="wysihtml5-toolbar" style="display: none;">
	<a data-wysihtml5-command="bold" class="btn btn-mini">bold</a>
	<a data-wysihtml5-command="italic" class="btn btn-mini">italic</a>

	<!-- Some wysihtml5 commands require extra parameters -->
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red" class="btn-danger btn btn-mini">red</a>
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green" class="btn-success btn btn-mini">green</a>
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue" class="btn-primary btn btn-mini">blue</a>

	<!-- Some wysihtml5 commands like 'createLink' require extra paramaters specified by the user (eg. href) -->
	<a data-wysihtml5-command="createLink" class="btn btn-mini">insert link</a>
	<div data-wysihtml5-dialog="createLink" style="display: none;">
	  <label>
		Link:
		<input data-wysihtml5-dialog-field="href" value="http://" class="text">
	  </label>
	  <a data-wysihtml5-dialog-action="save">OK</a> <a data-wysihtml5-dialog-action="cancel">Cancel</a>
	</div>
  </div>
</p>
<?php
echo form_textarea($description);

echo form_label('Company', 'cid');
echo form_dropdown('cid', $company_rows);
?>
<div class="form-actions">
  <button type="submit" class="btn btn-primary">Save</button>
</div>

<?php echo form_close(); ?>
</div>
<!-- /Projects Form -->

<?php echo add_jscript('libs/wysihtml5_parser.js'); ?>
<?php echo add_jscript('libs/wysihtml5.js'); ?>

<script>
  var editor = new wysihtml5.Editor("description", { // id of textarea element
	toolbar:      "wysihtml5-toolbar", // id of toolbar element
	parserRules:  wysihtml5ParserRules // defined in parser rules set
  });
</script>