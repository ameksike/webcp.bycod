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
    class Portfolio
    {
        public function __construct(){
            $this->view = ':';
        }

		public function index(){
            $this->view = 'theme:debug/portfolio';
            return array("active"=>"portfolio");
        }
        
        
        public function show(){
            $idiom = $this->assist->view->idiom("theme"); 
            $this->view = 'theme:sb-admin/blank';
            return array(
                "page_title_ico"=>  "fas fa-table",
                "page_title"=> $idiom['portfolio']['admin']['title'],
                "page_subtitle"=> $idiom['portfolio']['admin']['subtitle'] . ' / '.$idiom['portfolio']['admin']['title'],
                "page_head"=> $this->assist->view->css('portfolio', 'portfolio'),
                "page_footer"=> $this->assist->view->js('portfolio', 'portfolio'),
                "page_body"=> $this->assist->view->compile('portfolio:sb-admin/list')
            );
        }
	} 
