<!-- Users -->
<section id="users">

    <?php
    if ($this->session->flashdata('success'))
    {
        ?>
        <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><?php echo $this->session->flashdata('success'); ?></div>
    <?php } ?>


    <h2 class="withbtn">Users</h2>


    <div class="addbtn">
        <a class="btn btn-success" href="<?php echo base_url(); ?>users/add"><i class="icon-plus-sign icon-white"></i> Add New</a>
    </div>

    <div class="clearfix"></div>



    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($recent_items) > 0)
            {
                foreach ($recent_items as $item)
                {
                    ?>


                <div class="modal hide" id="delmodel_<?php echo $item['uid']; ?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h3>Delete <?php echo $item['first_name'] . ' ' . $item['last_name']; ?></h3>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to delete <strong><?php echo $item['first_name'] . ' ' . $item['last_name']; ?></strong>?<br />This cannot be undone and you will not able to create new user by this name again.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn" data-dismiss="modal">Close</a>
                        <a href="javascript:del('user', '<?php echo $item['uid']; ?>');" class="btn btn-danger">Yes Delete.</a>
                    </div>
                </div>

                <tr id="row_<?php echo $item['uid']; ?>">
                    <td><strong><?php echo $item['first_name'] . ' ' . $item['last_name']; ?><strong> <?php
            if ($item['uid'] == 1)
            {
                echo '<span class="label label-success">Admin</span>';
            }
            ?>  </td>
                                <td><?php echo $item['email']; ?></td>
                                <td><a href="<?php echo base_url() . 'companies/info/' . $item['company_id']; ?>"><?php echo $item['company_name']; ?></a></td>
                                <td>
                                    <?php
                                    if ($item['status_active'] == 1)
                                    {
                                        ?>
                                        <a class="btn btn-success btn-mini" href="javascript:void(0);st('user', '<?php echo $item['uid']; ?>', '0')" id="ust_<?php echo $item['uid']; ?>"><i class="icon-play icon-white"></i></a>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a class="btn btn-warning btn-mini" href="javascript:void(0);st('user', '<?php echo $item['uid']; ?>', '1')" id="ust_<?php echo $item['uid']; ?>"><i class="icon-pause icon-white"></i></a>
                                    <?php } ?>
                                    <a class="btn btn-mini btn-info" href="<?php echo base_url() . 'users/info/' . $item['uid']; ?>"><i class="icon-info-sign icon-white"></i></a>

                                <?php if ($item['uid'] != 1)
                                {
                                    ?>
                                        <a class="btn btn-danger btn-mini" data-toggle="modal" href="#delmodel_<?php echo $item['uid']; ?>" id="udel_<?php echo $item['uid']; ?>"><i class="icon-trash icon-white"></i></a></td>
                                <?php } ?>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            ?>

                            <tr><td colspan="3">No items added in users yet.<td></tr>
<?php } ?>
                        </tbody>
                        </table>




                        </section>
                        <!-- /Companies -->


                        <div class="pagination">
<?php echo $p_links; ?>
                        </div>

                        <div class="clearfix"></div>

