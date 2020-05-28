<?php $idiom = $assist->view->idiom("theme"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $assist->view->compile('theme:sb-admin/index.head'); ?>
        <?php
            echo $assist->view->include(array(
                "theme/lib/dataTables/1.10.20/css/dataTables.bootstrap4.min.css"
            ));
        ?>
    </head>
    <body class="sb-nav-fixed">
        <?php echo $assist->view->compile('theme:sb-admin/index.nav'); ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php echo $assist->view->compile('theme:sb-admin/index.navside', array("active"=>"home")); ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid ">
                        <!-- content_head_page -->
                        <h1 class="mt-4 menu_header">
                            <span class="fas fa-tachometer-alt"></span>
                            <?php echo $idiom['dashboard']['main']['title']; ?>
                        </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><?php echo $idiom['dashboard']['main']['subtitle']; ?></li>
                        </ol>
                        <?php echo $assist->view->compile('theme:sb-admin/index.content.head'); ?>
                    </div>
                </main>
                <!-- content_body_page -->
                <div class="row">
                    <?php echo $assist->view->compile('theme:sb-admin/index.content.body'); ?>
                </div>
                <!-- footer -->
                <?php echo $assist->view->compile('theme:sb-admin/index.footer'); ?>
                <?php
                    echo $assist->view->include(array(
                        "theme/lib/chart.js/2.8.0/js/Chart.min.js",
                        "theme/src/client/tpl/sb-admin/assets/demo/chart-area-demo.js",
                        "theme/src/client/tpl/sb-admin/assets/demo/chart-bar-demo.js",
                        "theme/lib/dataTables/1.10.20/js/jquery.dataTables.min.js",
                        "theme/lib/dataTables/1.10.20/js/dataTables.bootstrap4.min.js",
                        "theme/src/client/tpl/sb-admin/assets/demo/chart-bar-demo.js",
                    ));
                ?>
            </div>
        </div>
        <!-- script -->
    </body>
</html>
