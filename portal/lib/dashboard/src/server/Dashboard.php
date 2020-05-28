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
    class Dashboard
    {
        public function __construct(){
            $this->view = ':';
        }

		public function index(){
            /*
            $idiom = $this->assist->view->idiom("theme"); 
            $this->view = 'theme:sb-admin/index';
            return array(
                "page_title"=> $idiom['dashboard']['conditions']['title'],
                "page_subtitle"=> $idiom['dashboard']['conditions']['subtitle']
                );
            */
            return $this->show();
        }
       
        public function show(){
            $idiom = $this->assist->view->idiom("theme");
            $this->view = 'theme:sb-admin/blank';
            return array(
                "page_title_ico"=>  "fas fa-tachometer-alt",
                "page_title"=> $idiom['dashboard']['main']['title'],
                "page_subtitle"=> $idiom['dashboard']['main']['subtitle'] . ' / ' .  $idiom['dashboard']['main']['title'],
                "page_head"=> $this->assist->view->include(array(
                    "theme/lib/dataTables/1.10.20/css/dataTables.bootstrap4.min.css"
                )),
                "page_footer"=> $this->assist->view->include(array(
                    "theme/lib/chart.js/2.8.0/js/Chart.min.js",
                    "theme/src/client/tpl/sb-admin/assets/demo/chart-area-demo.js",
                    "theme/src/client/tpl/sb-admin/assets/demo/chart-bar-demo.js",
                    "theme/lib/dataTables/1.10.20/js/jquery.dataTables.min.js",
                    "theme/lib/dataTables/1.10.20/js/dataTables.bootstrap4.min.js",
                )),
                "page_header"=> $this->assist->view->compile('theme:sb-admin/index.content.head'),
                "page_body"=> $this->assist->view->compile('theme:sb-admin/index.content.body')
            );
        }
       
        public function privacy(){
            $idiom = $this->assist->view->idiom("theme"); 
            $this->view = 'theme:sb-admin/blank';
            return array(
                "active"=>"portfolio",
                "page_title"=> $idiom['dashboard']['privacy']['title'],
                "page_subtitle"=> $idiom['dashboard']['privacy']['subtitle'],
                "page_body"=> $this->assist->view->compile('theme:sb-admin/privacy')
            );
        }

        public function conditions(){
            $idiom = $this->assist->view->idiom("theme"); 
            $this->view = 'theme:sb-admin/blank';
            return array(
                "active"=>"portfolio",
                "page_title"=> $idiom['dashboard']['conditions']['title'],
                "page_subtitle"=> $idiom['dashboard']['conditions']['subtitle'],
                "page_body"=> $this->assist->view->compile('theme:sb-admin/conditions')
            );
        }
	} 
