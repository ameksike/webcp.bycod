<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $assist->view->compile('theme:sb-admin/index.head'); ?>
        <?php if(isset($data['page_head'])) echo $data['page_head']; ?>
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
                        <?php if(isset($data['page_title_ico'])) echo ' <span class="'.$data['page_title_ico'].'"></span>' ; ?>
                            <?php if(isset($data['page_title'])) echo $data['page_title']; ?>
                        </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                                <?php if(isset($data['page_subtitle_ico'])) echo ' <span class="'.$data['page_subtitle_ico'].'"></span>' ; ?>
                                <?php if(isset($data['page_subtitle'])) echo $data['page_subtitle']; ?>
                            </li>
                        </ol>
                        <?php if(isset($data['page_header'])) echo $data['page_header']; ?>
                    </div>
                </main>
                <!-- content_body_page -->
                <div class="container-fluid">
                    <?php if(isset($data['page_body'])) echo $data['page_body']; ?>
                </div>
                <!-- footer -->
                <?php echo $assist->view->compile('theme:sb-admin/index.footer'); ?>
                <?php if(isset($data['page_footer'])) echo $data['page_footer']; ?>
            </div>
        </div>
        <!-- script -->
    </body>
</html>
