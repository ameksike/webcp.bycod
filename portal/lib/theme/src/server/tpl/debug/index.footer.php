
    <?php $idiom = $assist->view->idiom("theme"); ?>
    <section id="footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 col-sm-4 col-xs-12 block">
                    <div class="footer-block">
                        <h4><?php echo $idiom["main"]['address']['title']; ?>  </h4>
                        <hr/>
                        <p> <?php echo $idiom["main"]['address']['data']; ?> </p>
                        <a href="<?php echo $assist->view->url("$idiomId/about/index"); ?>" class="learnmore">Learn More <i class="fa fa-caret-right"></i></a>
                    </div>
                </div>


                <div class="col-md-4 col-sm-4 col-xs-12 block">
                    <div class="footer-block">
                        <h4><?php echo $idiom['main']['service']['title']; ?></h4>
                        <hr/>
                        <ul class="footer-links">
                            <li><a href="#"><?php echo $idiom['main']['service']['email']['title']; ?></a></li>
                            <li><a href="#"><?php echo $idiom['main']['service']['cloud']['title']; ?></a></li>
                            <li><a href="#"><?php echo $idiom['main']['service']['videoteca']['title']; ?></a></li>
                            <li><a href="#"><?php echo $idiom['main']['service']['memoria']['title']; ?></a></li>
                            <li><a href="<?php echo $assist->view->url("$idiomId/dashboard/index"); ?>"><?php echo $idiom['main']['service']['dashboard']['title']; ?></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 block">
                    <div class="footer-block">
                        <h4>Recent Posts</h4>
                        <hr/>
                        <ul class="footer-links">
                            <li>
                                <a href="#" class="post">Lorem ipsum dolor sit amet</a>
                                <p class="post-date">May 25, 2017</p>
                            </li>
                            <li>
                                <a href="#" class="post">Lorem ipsum dolor sit amet</a>
                                <p class="post-date">May 25, 2017</p>
                            </li>
                            <li>
                                <a href="#" class="post">Lorem ipsum dolor sit amet</a>
                                <p class="post-date">May 25, 2017</p>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="bottom-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 btm-footer-links">
                    <a href="#">Copyright © 2019</a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 copyright">
                     Developed and Designed by <a href="https://ameksike.github.io/">Ksike Develop Team</a> (KSDT)</a>
                </div>
            </div>
        </div>
    </section>