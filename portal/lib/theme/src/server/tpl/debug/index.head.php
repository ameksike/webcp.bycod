
<?php $idiom = $assist->view->idiom("theme"); ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="<?php echo $idiom['main']['meta']['description'] ?>" />
<meta name="author" content="<?php echo $idiom['main']['meta']['author'] ?>" />
<link rel="icon"  type="image/svg"  href="<?php echo $assist->view->url("lib/theme/src/client/tpl/debug/img/logo/logo.icox16.svg"); ?>" />
<title><?php echo $idiom['main']['app']['title']; ?></title>

<script> 
    var Bycod = Bycod || {};
    Bycod.idiom = Bycod.idiom || {};
    Bycod.idiom.id = "$idiomId";
</script>
<?php
    echo $assist->view->include(array(
        "bycod/lib/router/src/client/js/Router.js",
        "theme/lib/font-awesome/4.5.0/css/font-awesome.min.css",
        "theme/src/client/tpl/debug/scss/skin.css",
        "theme/src/client/tpl/debug/scss/main.css",
    
        "theme/lib/jquery/3.2.1/jquery.min.js",
        "theme/lib/bootstrap/3.3.1/js/bootstrap.min.js",
        "theme/src/client/tpl/debug/js/index.js"
    ));
?>
