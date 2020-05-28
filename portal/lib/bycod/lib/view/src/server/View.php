<?php
/*
 * @framework: Bycod
 * @package: View
 * @version: 0.1
 * @description: This is simple and light render view layer
 * @authors: ing. Antonio Membrides Espinosa
 * @made: 15/06/2012
 * @update: 15/06/2012
 * @license: GPL v3
 * @require: PHP >= 5.2.*, Notary
 */
	class View
    {
        public function onRender($assist){
            $this->assist = $assist ? $assist : $this->assist;
            $controller = $this->assist->get($this->assist->cfg['bycod']['request']['option']['controller']);
            $view = $controller ? (property_exists( $controller, 'view')) ? $controller->view : ":" : ":";
            $tpl = $this->compile($view);
            if($tpl){
                $this->assist->cfg['bycod']["response"]['data'] = $tpl;
                //$this->assist->cfg['bycod']["response"]["type"] = "html";
            }else{
                //$this->assist->cfg['bycod']["response"]["type"] = "json";
            }
        }
        protected function searchTPL($controller, $action, $path=0){
            $path = $path ? $path : $this->assist->route($controller);
            foreach($this->assist->cfg['bycod']['view']['tpl'] as $type=>$i){
                $tpl = $path.$i.$action.".$type";
                if(file_exists($tpl)) return $tpl;
            }
            return false;
        }
        protected function vars($data){
            $data = is_array($data) ? $data : array();
            $data = is_array($this->assist->cfg['bycod']['response']['data']) ? array_merge_recursive($data, $this->assist->cfg['bycod']['response']['data']) : $data;
            return $data;
        }

        public function render($view=":", $data=false){
            echo $this->compile($view);
        }
        public function compile($view=":", $data=false){
            $views = is_array($view) ? $view : array($view);
            $out = "";
            foreach($views as $view){
                $controller = $this->assist->cfg['bycod']['request']['option']['controller'];
                $action =  $this->assist->cfg['bycod']['request']['option']['action'];
                $view = explode (":", $view);
                $controller = isset($view[0]) ? !empty($view[0]) ? $view[0] : $controller : $controller;
                $action = isset($view[1]) ? !empty($view[1]) ? $view[1] : $action : $action;
                $path = $this->searchTPL($controller, $action );
                $this->assist->notary->path($path);
                $out .= $this->assist->notary->compile(array(
                    'cfg'=>$this->assist->cfg,
                    'data'=> $this->vars($data),
                    'assist'=>$this->assist,
                    'bycod'=>$this->assist,
                    'ksike'=>$this->assist,
                    'idiomId'=> $this->assist->idiom->getId(),
                    'module'=>$this->assist->cfg['bycod']['request']['option']['controller']
                ));
            }
            return $out;
        }
        public function js($js="main", $module=false){
            return $this->script($js, $module);
        }
        public function css($css="main", $module=false){
            return $this->link($css, $module);
        }
		public function script($js="main", $module=false){
			$url = $this->url($module ? $module : $this->assist->cfg['bycod']['request']['option']['controller']);
			return "<script src=\"{$url}src/client/js/{$js}.js\" type=\"text/javascript\"></script>";
		}
		public function link($css="main", $module=false){
			$url = $this->url($module ? $module : $this->assist->cfg['bycod']['request']['option']['controller']);
			return  "<link rel=\"stylesheet\" href=\"{$url}src/client/css/{$css}.css\">";
		}
        public function url($name=false, $mod=false){
            return  $this->assist->router->url($name, $mod);
        }
        public function urlModule($name=false, $mod=false){
            return  $this->assist->router->urlModule($name, $mod);
        }

        public function include($files){
            $files = is_array($files) ? $files : array($files);
            $scrip = "";
            foreach($files as $file){
                $info = pathinfo($file);
                $modu = substr($file, 0, stripos($file, "/"));
                $path = $this->url($modu);
                $file = str_ireplace($modu."/", $path, $file);
                switch(strtolower($info['extension']) ){
                    case "js": $scrip .= " <script src=\"{$file}\" type=\"text/javascript\"></script> "; break;
                    case "css": $scrip .=  " <link rel=\"stylesheet\" href=\"{$file}\"> "; break;
                    default: return $file; break;
                }
            }
            return $scrip;
        }
        public function require($files){
            return $this->include($files);
        }

        public function idiom($controller=false){
            return $this->assist->idiom->list($controller);
        }
	}