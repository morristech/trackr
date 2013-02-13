
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $site_name; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Arfeen Arif -- arfeen@pwoxisolutions.com">

        <!-- Le styles -->
        <?php echo add_style('bootstrap.css'); ?>
        <?php echo add_style('style.css'); ?>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.png" />
    </head>

    <body class="fullscreen">

        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span4"></div>
                <div class="span4"><?php $this->load->view($main_content); ?></div>
                <div class="span4"></div>
            </div>

            <hr>

            <footer>
                <p>Copyright (c) <?php echo date('Y'); ?>, <a href="<?php echo base_url(); ?>"><?php echo $site_name; ?> - <?php echo SITE_VERSION; ?></a>. All rights reserved.</p> 
            </footer>

        </div><!--/.fluid-container-->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <?php echo add_jscript('libs/jquery.js'); ?> 
        <?php echo add_jscript('bootstrap.js'); ?>


    </body>
</html>
