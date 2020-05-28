
<?php $idiom = $assist->view->idiom("theme"); ?>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; <a href="https://ameksike.github.io/">Ksike Develop Team</a> (KSDT)</a> 2019</div>
            <div>
                <a href="<?php echo $assist->view->url("$idiomId/dashboard/privacy"); ?>">Privacy Policy</a>
                &middot;
                <a href="<?php echo $assist->view->url("$idiomId/dashboard/conditions"); ?>">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>

<?php
    echo $assist->view->include(array(
        "theme/lib/jquery/3.4.1/jquery.min.js",
        "theme/lib/bootstrap/4.3.1/js/bootstrap.bundle.min.js",
        "theme/src/client/tpl/sb-admin/js/scripts.js"
    ));
?>