<!DOCTYPE html>
<html>
    <?php $idiom = $assist->view->idiom("theme"); ?>
    <head>
        <?php 
            echo $assist->view->compile('theme:debug/index.head'); 
            echo $assist->view->include("news/src/client/css/view.css");
        ?>
    </head>
    <body id="wrapper">
        <?php $idiom = $assist->view->idiom("theme"); ?>
        <?php echo $assist->view->compile('theme:debug/index.header'); ?>

        <section id="top_banner">
            <div class="page_info">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-6">
                            <h4><?php echo $idiom["news"]['title']; ?></h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6" style="text-align:right;">
                            <?php echo $idiom["main"]['title']; ?>
                            <span class="sep"> /  </span>
                            <?php echo $idiom["news"]['title']; ?>
                            <span class="sep"> /  </span>
                            <span class="current"><?php echo $data['item']['id'];  ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="news">
            <div class="container">
                <div class="row">
                    <img class="news_img" src="<?php 
                        $imgico = !empty($data['item']['imgico']) ? 'lib/news/'.$data['item']['imgico'] : "lib/theme/src/client/tpl/debug/img/1.jpg";
                        echo $assist->view->url($imgico);
                        ?>"  width="50%"></a>	

				    <h1 class="theme_color new_title"> <?php echo $data['item']['title']; ?> </a> </h1>
				    <hr>
                    <h5 class="new_writeby " > 
                        <b class="theme_color"><?php echo $data['item']['date']; ?></b>, 
                         <?php echo $idiom['news']['writeby']; ?>:
                        <b class="theme_color"><?php echo $data['item']['author']; ?> </b> 
                    </h5> 
                    <hr style="padding-bottom: -4px;">
                    <p><?php 
                        $des = $data['item']['description']; 

                        $des = str_ireplace('resource/', $assist->view->urlModule('news') . "/resource/", $des);
                        echo $des;                     
                    ?> </p>
                </div>
        </section>

        <?php echo $assist->view->compile('theme:debug/index.footer'); ?>
    </body>
</html>