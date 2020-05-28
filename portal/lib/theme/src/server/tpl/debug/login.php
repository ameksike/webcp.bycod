<!DOCTYPE html>
<html>

    <head>
        <?php echo $assist->view->compile('theme:debug/index.head'); ?>
    </hedad>
    <body id="wrapper">

        <?php echo $assist->view->compile('theme:debug/index.header'); ?>

        <section id="top_banner">
            <div class="banner">
                <div class="inner text-center">
                    <h2>Lorem ipsum dolor sit amet</h2>
                </div>
            </div>
        </section>

        <section id="login-reg">
            <div class="container">
                <!-- Top content -->
                <div class="row">
                    <div class="col-md-6 col-sm-12 forms-right-icons">
                        <div class="section-heading">
                            <h2>Sign In With <span>Us</span></h2>
                            <p class="subheading">Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea saperet inimicu ut qui dolor oratio mnesarchum.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-xs-2 icon"><i class="fa fa-bullhorn"></i></div>
                            <div class="col-xs-10 datablock">
                                <h4>Powerful Features</h4>
                                <p>Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea saperet inimicu ut qui dolor oratio mnesarchum.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2 icon"><i class="fa fa-support"></i></div>
                            <div class="col-xs-10 datablock">
                                <h4>Customer Support</h4>
                                <p>Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea saperet inimicu ut qui dolor oratio mnesarchum.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-12">

                        <div class="form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Login to our site</h3>
                                    <p>Enter username and password to log on:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="" class="login-form">
                                    <div class="input-group form-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group form-group">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-unlock"></i></span>
                                        <input type="text" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                                    </div>
                                    <button type="submit" class="btn">Sign in!</button>
                                </form>
                            </div>
                        </div>

                    </div>

        </section>

        <?php echo $assist->view->compile('theme:debug/index.footer'); ?>

    </body>
</html>