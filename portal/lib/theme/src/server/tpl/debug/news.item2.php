
  <style>
  .thumbnail > img, .thumbnail a > img{
    overflow: hidden;
    max-height: 168.217px;
    min-height: 168.217px;
  }
  </style>

  <div class="col-sm-6 col-md-3">
    <div class="thumbnail">
        <img alt="" src="<?php 
            $imgico = !empty($data['item']['imgico']) ? 'lib/news/'.$data['item']['imgico'] : "lib/theme/src/client/tpl/debug/img/1.jpg";
            echo $assist->view->url($imgico);
            // echo $assist->view->url("lib/news/". $data['item']['imgico']);
        ?>">
      <div class="caption">
        <h3><?php echo $data['item']['title']; ?></h3>
        <p><?php 
                    $len = 200;
                    $sumary = $data['item']['sumary'];
                    $sumary = strip_tags($sumary);
                    $length = strlen($sumary);
                    if($length <= $len){
                        $sumary = str_pad($sumary, $len, " ");
                    }else{
                        $sumary = substr($sumary, 0, $length+3 >$len ? $len-3 :  $len) . "...";
                    }
                    echo  $sumary;

                    // str_pad($input, 10);
            ?></p>
        <p><a href="#" class="btn btn-primary">Button</a> <a href="#" class="btn btn-default">Button</a></p>
      </div>
    </div>
  </div>

