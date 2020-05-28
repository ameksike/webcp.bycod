
<?php $idiom = $assist->view->idiom("theme"); ?>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="<?php echo $idiom['main']['meta']['description'] ?>" />
<meta name="author" content="<?php echo $idiom['main']['meta']['author'] ?>" />
<link rel="icon"  type="image/svg"  href="<?php echo $assist->view->url("lib/theme/src/client/tpl/debug/img/logo/logo.icox16.svg"); ?>" />
<title><?php echo $idiom['dashboard']['main']['title']; ?></title>

<script> 
    var Bycod = Bycod || {};
    Bycod.idiom = Bycod.idiom || {};
    Bycod.idiom.id = "<?php echo $idiomId; ?>";
</script>
<?php
    echo $assist->view->include(array(
        "bycod/lib/router/src/client/js/Router.js",
        ///"theme/lib/bootstrap/4.4.1/theme/bootstrap.min.materia.css",
        "theme/src/client/tpl/sb-admin/css/styles.css",
        "theme/lib/font-awesome/5.11.2/js/all.min.js"
    ));
?>
