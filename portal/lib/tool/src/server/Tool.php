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
use Ksike\lql\lib\customise\lqls\src\Main as LQL;

class Tool
{
    public function __construct(){
        $this->view = ':';
    }

    public function module(){
        $idiom = $this->assist->view->idiom("theme"); 
        $this->view = 'theme:sb-admin/blank';
        return array(
            "active"=>"portfolio",
            "page_title"=> $idiom['tool']['module']['title'],
            "page_subtitle"=> $idiom['tool']['module']['subtitle'] . ' / ' . $idiom['tool']['module']['title'],
            "page_head"=> $this->assist->view->css('Modules', 'tool'),
            "page_footer"=> $this->assist->view->js('Modules', 'tool'),
            "page_body"=> $this->assist->view->compile('tool:sb-admin/form-module')
        );
    }

    public function desing(){
        $idiom = $this->assist->view->idiom("theme"); 
        $this->view = 'theme:sb-admin/blank';
        return array(
            "active"=>"portfolio",
            "page_title"=> $idiom['tool']['desing']['title'],
            "page_subtitle"=> $idiom['tool']['desing']['subtitle'] . ' / ' . $idiom['tool']['desing']['title'],
            "page_head"=> $this->assist->view->css('Desing', 'tool'),
            "page_footer"=> $this->assist->view->js('Desing', 'tool'),
            "page_body"=> $this->assist->view->compile('tool:sb-admin/form-desing')
        );
    }

    public function config(){
        $idiom = $this->assist->view->idiom("theme"); 
        $this->view = 'theme:sb-admin/blank';
        return array(
            "active"=>"portfolio",
            "page_title"=> $idiom['tool']['config']['title'],
            "page_subtitle"=> $idiom['tool']['config']['subtitle'] . ' / ' . $idiom['tool']['config']['title'],
            "page_head"=> $this->assist->view->css('Config', 'tool'),
            "page_footer"=> $this->assist->view->js('Config', 'tool'),
            "page_body"=> $this->assist->view->compile('tool:sb-admin/form-config')
        );
    }
}
