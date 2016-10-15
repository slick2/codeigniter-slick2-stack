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
