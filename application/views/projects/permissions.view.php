<!-- Project -->
<section id="project">



    <h2><?php echo $project['name']; ?> User Permissions</h2>
<p>Please select users for granting them permissions for this project.</p>
    
    <?php 
    $attributes_form = array('class' => '');
    echo form_open_multipart(base_url() . 'projects/permissions', $attributes_form);
    echo form_hidden('pid', $pid);

    if (count($users) > 0) {
        foreach ($users as $user) {
         ?>

<label class="checkbox">
    <input type="checkbox" value="<?php echo $user['uid']; ?>" name="user_permissions[]" <?php if (in_array($user['uid'], $user_permissions)) echo "checked"; ?> > <?php echo $user['first_name'] . ' ' . $user['last_name']; ?> (<?php echo $user['company_name']; ?>)
</label>

<?php
        }
    }
    ?>

<div class="row-fluid formbutton">
        <div class="span12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
<?php echo form_close(); ?>


</section>

<div class="clearfix"></div>