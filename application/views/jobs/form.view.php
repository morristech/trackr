<!-- Projects Form -->
<div id="jobsform">

    <?php
    // preparing form elements:
    $title = array(
        'name' => 'title',
        'id' => 'title',
        'value' => set_value('title'),
        'class' => 'input-xxlarge'
    );

    $receivable_rate = array(
        'name' => 'receivable_rate',
        'id' => 'receivable_rate',
        'value' => set_value('receivable_rate'),
        'class' => 'input-small'
    );

    $payable_rate = array(
        'name' => 'payable_rate',
        'id' => 'payable_rate',
        'value' => set_value('payable_rate'),
        'class' => 'input-small'
    );

    $receivable_hours = array(
        'name' => 'receivable_hours',
        'id' => 'receivable_hours',
        'value' => set_value('receivable_hours'),
        'class' => 'input-small'
    );

    $payable_hours = array(
        'name' => 'payable_hours',
        'id' => 'payable_hours',
        'value' => set_value('payable_hours'),
        'class' => 'input-small'
    );


    $attributes_form = array('class' => '');
    echo form_open_multipart(base_url() . 'jobs/add', $attributes_form);
    ?>
    <h2>Add New Job</h2>


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
    echo form_hidden('pid', $pid);

    echo form_label('Title', $title['id']);
    echo form_input($title);


    echo '<div class="row-fluid"><div class="span2">';
    echo form_label('Receivable Rate', $receivable_rate['id']);
    echo '<div class="input-prepend"><span class="add-on">USD</span>';
    echo form_input($receivable_rate);
    echo '</div></div>';

    echo '<div class="span2">';
    echo form_label('Receivable Hours', $receivable_hours['id']);
    echo '<div class="input-append">';
    echo form_input($receivable_hours);
    echo '<span class="add-on">Hrs</span>';
    echo '</div></div></div>';
    
    echo '<div class="row-fluid"><div class="span2">';
    echo form_label('Payable Rate', $payable_rate['id']);
    echo '<div class="input-prepend"><span class="add-on">USD</span>';
    echo form_input($payable_rate);
    echo '</div></div>';

    echo '<div class="span2">';
    echo form_label('Payable Hours', $payable_hours['id']);
    echo '<div class="input-append">';
    echo form_input($payable_hours);
    echo '<span class="add-on">Hrs</span>';
    echo '</div></div></div>';
    
    ?>
    <div class="row-fluid formbutton">
        <div class="span12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>

<?php echo form_close(); ?>
</div>
<!-- /Projects Form -->
