<!-- Login Form -->
<?php
// preparing form elements:
$email = array(
    'name' => 'email',
    'id' => 'email',
    'value' => '',
    'class' => 'input-block-level',
    'placeholder' => 'Email address'
);

$password = array(
    'name' => 'password',
    'id' => 'password',
    'value' => '',
    'class' => 'input-block-level',
    'placeholder' => 'Password'
);

$attributes_form = array('class' => 'well');
echo form_open(base_url() . 'login', $attributes_form);
?>
<h2>Please login</h2>


<!-- Notification -->
<?php echo validation_errors('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>', '</div>'); ?>
<?php
if ($this->session->flashdata('login_message'))
{
    echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('login_message') . '</div>';
};
?>
<!-- /Notification -->

<?php
echo form_input($email);
echo form_password($password);
?>
<div class="row-fluid">
    <div class="span12"><button type="submit" class="btn btn-primary">Login</button>
    </div>
</div>
<?php
echo form_close();
?>
<!-- /Login Form -->