<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>
			Opps Error.
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="" />
		<meta name="author" content="Arfeen Arif -- arfeen@pwoxisolutions.com" /><!-- Le styles -->
		<?php echo add_style( 'bootstrap.css' ); ?><?php echo add_style( 'style.css' ); ?><!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.png" />
	</head>
	<body class="fullscreen">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<h1>
						<?php echo $heading; ?>
					</h1>
					<hr />
					<?php echo $message; ?>
				</div>
			</div>
		</div><!--/.fluid-container-->
	</body>
</html>