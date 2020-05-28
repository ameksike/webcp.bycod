<!DOCTYPE html>
<html>
    <head>
        <?php echo $assist->view->compile('theme:debug/index.head', array("active"=>"home")); ?>
    </head>

    <body id="wrapper">
        <?php echo $assist->view->compile('theme:debug/index.header'); ?>

        <?php echo $assist->view->compile('theme:debug/index.carousel'); ?>

        <?php echo $assist->view->compile('theme:debug/index.features'); ?>

        <?php echo $assist->view->compile('theme:debug/index.about'); ?>

        <?php echo $assist->view->compile('theme:debug/index.process'); ?>

        <?php echo $assist->view->compile('theme:debug/index.testimonials'); ?>

        <?php echo $assist->view->compile('theme:debug/index.footer'); ?>
    </body>   
</html>