<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			
			<a href="<?php echo site_url();?>" class="navbar-brand">Slick2</a>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
				<li>
					<?php if($this->ion_auth->is_admin()):?>
					<a href="/auth">Dashboard</a>
					<?php else:?>
					<a href="/main">Dashboard</a>
					<?php endif;?>
				</li>

			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">                        
                        <?= empty($authInfo['first_name']) ? '' : $authInfo['first_name'] ?>
                        <b class="caret"></b>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="<?= site_url('auth/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </li>
			</ul>

		</div>
	</div>
</div>

<?php /*
<!-- Fixed navbar -->
<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= site_url('/main') ?>">Slick2</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav main-nav">                




            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">                        
                        <div class="prof-name"><?= empty($authInfo['first_name']) ? '' : $authInfo['first_name'] ?></div>
                        <b class="caret"></b>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="#">Account</a></li>
                        <li><a href="#">Billing</a></li>
                        <li><a href="<?= site_url('main/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </li>

            </ul>

        </div><!--/.nav-collapse -->
    </div>
</div>
 * 
 */