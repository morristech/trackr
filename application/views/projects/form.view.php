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
    <?php echo validation_errors('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>', '</div>'); ?>
    <?php
    if ($this->session->flashdata('error'))
    {
        ?>
        <div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><?php echo $this->session->flashdata('error'); ?></div>
    <?php } ?>


    <!-- /Notification -->

    <?php
    echo form_label('Name', $name['id']);
    echo form_input($name);

    echo form_label('Description / Requirments', $description['id']);
    ?>

<?php
echo form_textarea($description);
?>
<div class="row-fluid show-grid no-margins">
<?php
echo '<div class="span3">';
echo form_label('Assign To Company', 'assigned_cid');
echo form_dropdown('assigned_cid', $company_rows);
echo '</div>';

echo '<div class="span3">';
echo form_label('Provider Company', 'provided_cid');
echo form_dropdown('provided_cid', $company_rows);
echo '</div>';
?>
</div>

<div class="row-fluid formbutton">
        <div class="span12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>

<?php echo form_close(); ?>
</div>
<!-- /Projects Form -->
