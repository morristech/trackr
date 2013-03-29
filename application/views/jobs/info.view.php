<!-- Project -->
<section id="project">

    <h2><?php echo $project['name']; ?></h2>


    <p><?php echo $project['description']; ?></p>

    <div claas="row-fuild">
        <div class="span3"><code>Created: <?php
echo mdate($dateformat, $project['created_date']);
;
?></code></div>

        <div class="span3"><code>Assigned: <?php echo $project['company_name']; ?></code></div>
    </div>

</section>
<!-- /Project -->

<div class="clearfix"></div>

<section>

    <h3 class="withbtn"><?php echo $project['name']; ?> Jobs</h3>

    <div class="addbtn">
        <a class="btn btn-success" href="<?php echo base_url(); ?>jobs/add/<?php echo $jobs['jid']; ?>project/<?php echo $project['pid']; ?>"><i class="icon-plus-sign icon-white"></i> Add New Job</a>
    </div>

    <div class="clearfix"></div>


    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Total Receivable</th>
                <th>Total Payable</th>
                <th>Options</th>

            </tr>
        </thead>
        <tbody>

            <?php
            if (count($jobs) > 0)
            {
                ?>
                <?php
                foreach ($jobs as $job)
                {
                    ?>

                <div class="modal hide" id="delmodel_<?php echo $job['jid']; ?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h3>Delete <?php echo $job['title']; ?></h3>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to delete <strong><?php echo $job['title']; ?></strong>?<br />This cannot be undone and you will not able to create new job by this name again.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn" data-dismiss="modal">Close</a>
                        <a href="javascript:del('job', '<?php echo $job['jid']; ?>');" class="btn btn-danger">Yes Delete.</a>
                    </div>
                </div>

                <tr>
                    <td><?php echo mdate($dateformat, $job['created_date']); ?> </td>
                    <td><?php echo $job['title']; ?></td>
                    <td><?php echo money_format_us('%i', ($job['receivable_rate']) * ($job['receivable_hours'])); ?></td>
                    <td><?php echo money_format_us('%i', ($job['payable_rate']) * ($job['payable_hours'])); ?></td>

                    <td>
                        <?php
                        if ($job['status_active'] == 1)
                        {
                            ?>
                            <a class="btn btn-success btn-mini" href="javascript:void(0);st('job', '<?php echo $job['jid']; ?>', '0')" id="pst_<?php echo $job['jid']; ?>"><i class="icon-play icon-white"></i></a>
                            <?php
                        }
                        else
                        {
                            ?>
                            <a class="btn btn-warning btn-mini" href="javascript:void(0);st('job', '<?php echo $job['jid']; ?>', '1')" id="pst_<?php echo $job['jid']; ?>"><i class="icon-pause icon-white"></i></a>
                        <?php } ?>
                        <a class="btn btn-mini btn-info" href="<?php echo base_url() . 'job/info/' . $job['jid']; ?>"><i class="icon-info-sign icon-white"></i></a>


                        <a class="btn btn-danger btn-mini" data-toggle="modal" href="#delmodel_<?php echo $job['jid']; ?>" id="pdel_<?php echo $job['jid']; ?>"><i class="icon-trash icon-white"></i></a></td>

                </tr>

            <?php } ?>


            <?php
        }
        else
        {
            ?>

            <tr><td colspan="4">No items added in jobs yet.<td></tr>
        <?php } ?>         
        </tbody>
    </table>


</section>

<div class="clearfix"></div>