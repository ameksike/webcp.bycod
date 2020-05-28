<?php
/*
 * @version: 0.1
 * @authors: ing. Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @made: 23/12/2019
 * @update: 23/12/2019
 * @license: GPL v3
 * @require: PHP >= 5.2.*
 */
class Portal
{
    public function __construct(){
        $this->view = ':';
    }

    public function getDesign(){
        $design = include $this->assist->route("portal")."/cfg/design.php";
        $design["active"] = "main";
        $design["company"] = $this->assist->cfg['company'];
        return $design;
    }

    public function index(){
        $this->view = 'theme:debug/index';
        return $this->getDesign();
    }

    public function noticias(){
        $this->view = 'vendor:metronic/admin/index';
        $design = $this->getDesign();
        $design["tpl"]["page"]["view"] = ":noticias";
        return $design;
    }

} 
