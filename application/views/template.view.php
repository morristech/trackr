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

    <body class="normal">

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php echo base_url(); ?>"><?php echo $site_name; ?></a>
                    <div class="btn-group pull-right">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="javsscript:void(0);">
                            <i class="icon-user"></i>&nbsp;<?php echo $fullname; ?>&nbsp;
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
                        </ul>
                    </div>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>

                                    <li><a href="<?php echo base_url(); ?>projects">Projects</a></li>

                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url(); ?>companies">Companies</a></li>
                                    <li><a href="<?php echo base_url(); ?>users">Users</a></li>
                                </ul>
                            </li>
                            


                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <?php $this->load->view($main_content); ?>

                    <hr>
                    <footer>
                        <p>Copyright (c) <?php echo date('Y'); ?>, <a href="<?php echo base_url(); ?>"><?php echo $site_name; ?> - <?php echo SITE_VERSION; ?></a>. All rights reserved.</p>
                    </footer>

                </div>
            </div>
        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <?php echo add_jscript('libs/jquery.js'); ?>
        <?php echo add_jscript('libs/bootstrap.js'); ?>
        <?php echo add_jscript('script.js'); ?>


    </body>
</html>