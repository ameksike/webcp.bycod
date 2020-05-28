<?php $idiom = $assist->view->idiom("theme"); ?>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 portfolio-item">
    <div class="portfolio-one"> 
        
        <div class="portfolio-head">
            <?php 
                if($data['item']['status']=='relevant'){
                    echo '<div class="featured-news theme_background">'. $idiom['news']['type']['important'] . '</div>';
                }
                $date1 = new DateTime(date('Y-m-d'));
                $date2 = new DateTime($data['item']['date']);
                $diff = $date1->diff($date2);
                // will output 2 days
                if($diff->days <= 17 ) {
                    echo '<div class="featured-news theme_background">'. $idiom['news']['type']['new'] . '</div>';
                }
            ?>
            
            <div class="portfolio-img">
                <img alt="" src="<?php 
                    $imgico = !empty($data['item']['imgico']) ? 'lib/news/'.$data['item']['imgico'] : "lib/theme/src/client/tpl/debug/img/1.jpg";
                    echo $assist->view->url($imgico);
                ?>">
            </div>
            
            <div class="portfolio-hover">
                <a class="portfolio-zoom" href="<?php echo $assist->view->url("news/view/".$data['item']['id']); ?>"><i class="fa fa-search"></i></a>
                <a class="portfolio-link" href="<?php echo $assist->view->url("news/view/".$data['item']['id']); ?>"><i class="fa fa-pencil"></i></a>
                <a class="portfolio-trash" href="<?php echo $assist->view->url("news/view/".$data['item']['id']); ?>"><i class="fa fa-trash"></i></a>
            </div>
        </div>
        <!-- End portfolio-head -->
        <div class="portfolio-content">
            <h5 class="title"><?php echo $data['item']['title']; ?></h5>
            <p class="block-with-text"><?php 
                    $sumary = $data['item']['sumary'];
                    echo strip_tags($sumary);
            ?></p>
        </div>
        <!-- End portfolio-content -->
    </div>
    <!-- End portfolio-item -->
</div>