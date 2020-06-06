<?php $idiom = $assist->view->idiom("theme"); ?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo $assist->view->url("$idiomId/dashboard/index"); ?>">
        <img class="headico" type="image/svg"  src="<?php echo $assist->view->url("lib/theme/src/client/tpl/debug/img/logo/logo.icox16.svg"); ?>" />
        <?php echo $idiom['main']['meta']['company']; ?> 
    </a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
    ><!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" id="dbSearchInput" type="text" placeholder="<?php echo  $idiom["search"]['placeholder']; ?>" aria-label="<?php echo  $idiom["search"]['title']; ?>" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button id="dbSearchBtn" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown black">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#"><?php echo  $idiom["login"]['opt']['setting']; ?> </a><a class="dropdown-item" href="#"><?php echo  $idiom["login"]['opt']['log']; ?></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="login.html"><?php echo  $idiom["login"]['opt']['logout']; ?></a>
            </div>
        </li>
        
    </ul>
</nav>