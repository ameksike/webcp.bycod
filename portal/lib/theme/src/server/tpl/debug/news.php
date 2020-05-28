<!DOCTYPE html>
<html>
    <head>
        <?php $idiom = $assist->view->idiom("theme"); ?>
        <?php 
            echo $assist->view->compile('theme:debug/index.head'); 
            echo $assist->view->include("news/src/client/css/news.css");
        ?>

    </head>
    <body id="wrapper">

        <?php echo $assist->view->compile('theme:debug/index.header'); ?>

        <section id="top_banner">
            <div class="banner">
                <div class="inner text-center">
                    <h2><?php echo $idiom["news"]['header0']; ?> </h2>
                </div>
            </div>
            <div class="page_info">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-6">
                            <h4><?php echo $idiom["news"]['title']; ?></h4>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6" style="text-align:right;">
                        <?php echo $idiom["main"]['title']; ?><span class="sep"> / 
                        </span><span class="current"><?php echo $idiom["news"]['title']; ?></span></div>
                    </div>
                </div>
            </div>

            </div>
        </section>

        <section id="portfolio">
            <div class="container">
                <div class="row">
                    <div class="section-heading text-center">
                        <div class="col-md-12 col-xs-12">
                            <h1><?php echo $idiom["news"]['header1']; ?> <span><?php echo $idiom["news"]['header2']; ?></span></h1>
                            <p class="subheading"><?php echo $idiom["news"]['footer1']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php 
                        $list = $data['data'];
                        $total = count($list);
                        for($i = 0; $i<$total; $i=$i+3){   
                            if(isset($list[$i]))   echo $assist->view->compile('theme:debug/news.item', array( 'item'=>$list[$i]) );
                            if(isset($list[$i+1])) echo $assist->view->compile('theme:debug/news.item', array( 'item'=>$list[$i+1]) );
                            if(isset($list[$i+2])) echo $assist->view->compile('theme:debug/news.item', array( 'item'=>$list[$i+2]) );
                        }
                        
                    ?>
                </div>
                <div class="row">
                    <span><?php echo $data['offset']; ?></span> - <span><?php echo $data['offset']+$data['limit']-1; ?></span>  / <span> <?php echo $data['total'] ?>  </span>
                </div>
  
        </section>

        <?php echo $assist->view->compile('theme:debug/index.footer'); ?>
    </body>
</html>