
<?php $idiom = $assist->view->idiom("theme"); ?>
<section id="top-header">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-7 col-xs-7 top-header-links">
                <ul class="contact_links">
                    <li><i class="fa fa-phone"></i><a href="#"><?php if(isset($data['company']["phone"])) echo $data['company']["phone"]; ?></a></li>
                    <li><i class="fa fa-envelope"></i><a href="#"><?php if(isset($data['company']["email"])) echo $data['company']["email"]; ?></a></li>
                </ul>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-5 social">
                <ul class="social_links">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    <li><a href="#"><i class="fa fa-skype"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</section>

<header>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $assist->view->url("$idiomId/portal/index"); ?>">
                        <h1><?php echo $idiom["main"]['company']; ?></h1><span><?php echo $idiom["main"]['locale']; ?></span>
                    </a>
                </div>

                <div id="navbar" class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li <?php echo $data['active']=="main"?'class="active"':""; ?>><a href="<?php echo $assist->view->url("$idiomId/portal/index"); ?>"><?php echo $idiom["main"]['title']; ?></a></li>
                        <li <?php echo $data['active']=="features"?'class="active"':""; ?>><a href="<?php echo $assist->view->url("$idiomId/features/index"); ?>"><?php echo $idiom["features"]['title']; ?></a></li>
                        <li <?php echo $data['active']=="portfolio"?'class="active"':""; ?>><a href="<?php echo $assist->view->url("$idiomId/portfolio/index"); ?>"><?php echo $idiom["portfolio"]['title']; ?></a></li>
                        <li <?php echo $data['active']=="news"?'class="active"':""; ?>><a href="<?php echo $assist->view->url("$idiomId/news/index"); ?>"><?php echo $idiom["news"]['title']; ?></a></li>
                        <li <?php echo $data['active']=="contact"?'class="active"':""; ?>><a href="<?php echo $assist->view->url("$idiomId/contact/index"); ?>"><?php echo $idiom["contact"]['title']; ?></a></li>
                        <li <?php echo $data['active']=="about"?'class="active"':""; ?>><a href="<?php echo $assist->view->url("$idiomId/about/index"); ?>"><?php echo $idiom["about"]['title']; ?></a></li>
                        <li <?php echo $data['active']=="login"?'class="active"':""; ?>><a href="<?php echo $assist->view->url("$idiomId/login/index"); ?>"><?php echo $idiom["login"]['title']; ?></a></li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </nav>
</header>
<!--/.nav-ends -->
