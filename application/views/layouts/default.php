<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= $this->config->item('site_main_title') ?></title>
        <link rel="stylesheet" href="<?= site_url(); ?>components/font-awesome/css/font-awesome.min.css">

        <!-- Bootstrap core CSS -->
        <link href="<?= site_url(); ?>components/bootswatch-dist/css/bootstrap.min.css" rel="stylesheet">

		<script src="<?= site_url(); ?>components/jquery/dist/jquery.min.js"></script>
		
        <script type="text/javascript" charset="utf-8">
		<?php if (ENVIRONMENT == 'production') : ?>
		<?php endif; ?>
			(function () {
				var method;
				var noop = function () {
				};
				var methods = [
					'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
					'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
					'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
					'timeStamp', 'trace', 'warn'
				];
				var length = methods.length;
				var console = (window.console = window.console || {});

				while (length--) {
					method = methods[length];

					// Only stub undefined methods.
					if (!console[method]) {
						console[method] = noop;
					}
				}
			}());
			window.baseURI = '<?= site_url(); ?>';
        </script>
		<?php if (ENVIRONMENT == 'production') : ?>

		<?php endif; ?>


        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="<?= site_url(); ?>/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css" media="screen">
            body.has-header {
                padding-top: 60px !important;
            }
        </style>
    </head>

    <body class="has-header">
		<?php if (isset($this->authInfo)) : ?>
			<?= $this->load->view('partials/headers/auth', array('authInfo' => $authInfo), true) ?>
		<?php else : ?>
			<?= $this->load->view('partials/headers/default', [], true) ?>
		<?php endif; ?>
        <div class="container">



			<?= $this->load->view('partials/session-flash', [], true) ?>


			<?php echo $content; ?>


            <footer>
				<div class="row">
                &copy; <?= date('Y') ?>. <?= $this->config->item('site_main_title') ?>. All Rights Reserved.
				</div>
            </footer>

        </div> <!-- /container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <script src="<?= site_url(); ?>components/bootswatch-dist/js/bootstrap.min.js"></script>
        <script src="<?= site_url(); ?>components/bootstrap-validator/js/validator.js"></script>

        <script type="text/javascript" charset="utf-8">
			if ($('#session-flash').length > 0) {

				setTimeout(function () {
					$("#session-flash").fadeOut('slow');
				}, 5000);

			}
        </script>
        <? **/ ?>






		<?php if (ENVIRONMENT == 'production') : ?>
			<script>

			</script>

		<?php endif; ?>
    </body>
</html>
<!-- <?= date('Y-m-d H:i:s') ?> -->

