<!-- Login Form -->
<div id="loginform">

    <?php
    // preparing form elements:
    $name = array(
        'name' => 'name',
        'id' => 'name',
        'value' => set_value('name'),
        'class' => ''
    );

    $address = array(
        'name' => 'address',
        'id' => 'address',
        'value' => set_value('address'),
        'rows' => 2,
        'style' => 'width: 500px;',
        'class' => ''
    );

    $logo = array(
        'name' => 'logo',
        'id' => 'logo',
    );


    $attributes_form = array('class' => '');
    echo form_open_multipart(base_url() . 'companies/add', $attributes_form);
    ?>
    <h2>Add New Company</h2>


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
    echo form_label('Company Name', $name['id']);
    echo form_input($name);
    echo form_label('Address', $address['id']);
    echo form_textarea($address);
    echo form_label('Logo', $logo['id']);
    echo form_upload($logo);
    ?>

    <div class="row-fluid formbutton">
        <div class="span12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>

    <?php echo form_close(); ?>
</div>
<!-- /Login Form -->