<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?= $this->config->item('site_main_title') ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link href="<?= site_url(); ?>components/bootswatch-dist/css/bootstrap.min.css" rel="stylesheet" media="screen">

		<link href="<?= site_url(); ?>assets/css/custom.css" rel="stylesheet" media="screen">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="<?= site_url(); ?>components/html5shiv/dist/html5shiv.js"></script>
		  <script src="<?= site_url(); ?>components/respond/dest/respond.min.js"></script>
		<![endif]-->

		<script src="<?= site_url(); ?>components/jquery/dist/jquery.min.js"></script>

	</head>
	<body>
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a href="../" class="navbar-brand">Bootswatch</a>
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse" id="navbar-main">
					<ul class="nav navbar-nav">
						<li>
							<a href="#">Help</a>
						</li>
						<li>
							<a href="http://news.bootswatch.com" target="_blank">Blog</a>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Dropdown <span class="caret"></span></a>
							<ul class="dropdown-menu" aria-labelledby="download">
								<li><a href="http://jsfiddle.net/bootswatch/9y480qo5/">Open Sandbox</a></li>
								<li class="divider"></li>
								<li><a href="<?= site_url(); ?>components/bootswatch-dist/css/bootstrap.min.css">bootstrap.min.css</a></li>
								<li><a href="<?= site_url(); ?>components/bootswatch-dist/css/bootstrap.css">bootstrap.css</a></li>
								<li class="divider"></li>
								<li><a href="#">variables.less</a></li>
								<li><a href="#">bootswatch.less</a></li>
								<li class="divider"></li>
								<li><a href="#">_variables.scss</a></li>
								<li><a href="#">_bootswatch.scss</a></li>
							</ul>
						</li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li><a href="http://builtwithbootstrap.com/" target="_blank">Built With Bootstrap</a></li>
						<li><a href="https://wrapbootstrap.com/?ref=bsw" target="_blank">WrapBootstrap</a></li>
					</ul>

				</div>
			</div>
		</div>
		<div class="container">

			<?= $this->load->view('partials/session-flash', [], true) ?>


			<?php echo $content; ?>

			<footer>
				<div class="row">
					<div class="col-lg-12">

						<ul class="list-unstyled">
							<li class="pull-right"><a href="#top">Back to top</a></li>
							<li><a href="http://news.bootswatch.com" onclick="pageTracker._link(this.href);
									return false;">Blog</a></li>
							<li><a href="http://feeds.feedburner.com/bootswatch">RSS</a></li>
							<li><a href="https://twitter.com/bootswatch">Twitter</a></li>
							<li><a href="https://github.com/thomaspark/bootswatch/">GitHub</a></li>
							<li><a href="../help/#api">API</a></li>
							<li><a href="../help/#support">Support</a></li>
						</ul>
						<p>Made by <a href="http://thomaspark.co" rel="nofollow">Thomas Park</a>. Contact him at <a href="/cdn-cgi/l/email-protection#97e3fff8faf6e4d7f5f8f8e3e4e0f6e3f4ffb9f4f8fa"><span class="__cf_email__" data-cfemail="d2a6babdbfb3a192b0bdbda6a1a5b3a6b1bafcb1bdbf">[email&#160;protected]</span><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function (t, e, r, n, c, a, p) {
								try {
									t = document.currentScript || function () {
										for (t = document.getElementsByTagName('script'), e = t.length; e--; )
											if (t[e].getAttribute('data-cfhash'))
												return t[e]
									}();
									if (t && (c = t.previousSibling)) {
										p = t.parentNode;
										if (a = c.getAttribute('data-cfemail')) {
											for (e = '', r = '0x' + a.substr(0, 2) | 0, n = 2; a.length - n; n += 2)
												e += '%' + ('0' + ('0x' + a.substr(n, 2) ^ r).toString(16)).slice(-2);
											p.replaceChild(document.createTextNode(decodeURIComponent(e)), c)
										}
										p.removeChild(t)
									}
								} catch (u) {
								}
							}()/* ]]> */</script></a>.</p>
						<p>Code released under the <a href="https://github.com/thomaspark/bootswatch/blob/gh-pages/LICENSE">MIT License</a>.</p>
						<p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

					</div>
				</div>

			</footer>


		</div>
		<script src="<?= site_url(); ?>components/bootswatch-dist/js/bootstrap.min.js"></script>
        <script src="<?= site_url(); ?>components/bootstrap-validator/js/validator.js"></script>
		<script src="<?= site_url(); ?>assets/js/custom.js"></script>
        <script type="text/javascript" charset="utf-8">
							if ($('#session-flash').length > 0) {

								setTimeout(function () {
									$("#session-flash").fadeOut('slow');
								}, 5000);

							}
        </script>
</html>
<!-- <?= date('Y-m-d H:i:s') ?> -->

