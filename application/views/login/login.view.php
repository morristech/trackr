<!-- Login Form -->
<div id="loginform">

    <?php
    // preparing form elements:
    $email = array(
        'name' => 'email',
        'id' => 'email',
        'value' => '',
        'class' => 'ui-corner-all'
    );

    $password = array(
        'name' => 'password',
        'id' => 'password',
        'value' => '',
        'class' => 'ui-corner-all'
    );

    $attributes_form = array('class' => 'well');
    echo form_open(base_url() . 'login', $attributes_form);
    ?>
    <h1><?php echo $site_name; ?> Login</h1>


    <!-- Notification -->
    <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
    <?php
    if ($this->session->flashdata('login_message'))
    {
        echo '<div class="alert alert-error">' . $this->session->flashdata('login_message') . '</div>';
    };
    ?>
    <!-- /Notification -->

    <?php
    echo form_label('Email', $email['id']);
    echo form_input($email);
    echo form_label('Password', $password['id']);
    echo form_password($password);
    ?>
    <button type="submit" class="btn btn-primary btn-large">Login</button>
    <?php
    echo form_close();
    ?>
</div>
<!-- /Login Form -->