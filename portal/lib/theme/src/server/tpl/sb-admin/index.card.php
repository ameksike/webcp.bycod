<?php $idiom = $assist->view->idiom("theme"); ?>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            
            <div class="card-body"><span class="fas fa-newspaper"></span> <?php echo $idiom['dashboard']['cards'][0]['title']; ?></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo $assist->view->url("news/backend"); ?>"><?php echo $idiom['dashboard']['card']['details']; ?></a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>

    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body"><span class="fas fa-book"></span> <?php echo $idiom['dashboard']['cards'][1]['title']; ?></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo $assist->view->url("docs/show"); ?>"><?php echo $idiom['dashboard']['card']['details']; ?></a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body"><span class="fas fa-user"></span> <?php echo $idiom['dashboard']['cards'][2]['title']; ?></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo $assist->view->url("person/show"); ?>"><?php echo $idiom['dashboard']['card']['details']; ?></a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body"><span class="fas fa-phone"></span> <?php echo $idiom['dashboard']['cards'][3]['title']; ?></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo $assist->view->url("phone/show"); ?>"><?php echo $idiom['dashboard']['card']['details']; ?></a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>