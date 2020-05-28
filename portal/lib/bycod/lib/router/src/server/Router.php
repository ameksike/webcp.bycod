<?php
/*
 * @framework: Bycod
 * @package: Router
 * @version: 0.1
 * @description: This is simple and Light router engine
 * @authors: ing. Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @made: 23/4/2011
 * @update: 23/4/2011
 * @license: GPL v3
 * @require: PHP >= 5.2.*
 */
class Router
{
		public $burl;
		public function __construct(){
			$this->burl = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1);
		}
		public function url($access=false, $header=false, $footer=false){
			$access = $access ? $access : $this->assist->cfg['bycod']['request']['option']['controller'];
			$action = $this->urlAccessType($access);
			return $this->{$action}($access, $header, $footer);
		}
		protected function urlHeader(){
			$protocol = explode("/", $_SERVER["SERVER_PROTOCOL"]);
			$protocol = strtolower($protocol[0]);
			return $protocol."://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
		}
		protected function urlAccessType($access){
			if ($access == '.' || $access == '_' || $access == '' || $access == '__APP__'|| $access == '__GLOBAL__')
				return "urlProject";
			else if(preg_match('/\w+\.\w+$/i', $access)) return "urlFile"; 
            else if(preg_match('/\w+\/\w+/i', $access) || preg_match('/\/\w+/i', $access)) return "urlAction";
			else if($this->assist->route($access)) return "urlModule";
			else return "urlProject";
		}
		public function urlProject($access='', $header=false, $footer=false){
			$header = !$header ? "" : $this->urlHeader();
			return $header.$this->burl;
		}
		public function urlAction($access, $header=false, $footer=false){
			return $this->urlProject($access, $header)."index.php/$access";
		}
		public function urlModule($module, $header=false, $footer=false){
			$path = realpath($this->assist->route($module));
			if(!empty($path)){
				$urli = str_ireplace(realpath(dirname($_SERVER['SCRIPT_FILENAME'])).DIRECTORY_SEPARATOR, "", $path );
				$urli = str_replace("\\", "/", $urli);
				return $this->urlProject($module, $header) . $urli . "/";
			}else return false;
		}
		public function urlClient($module, $header=false, $footer=false){
			$url = $this->urlModule($module, $header);
			return $url ? "{$url}src/client/" : false;
		}
        public function urlFile($access, $header=false, $footer=false, $module=false){
			return $module ? $this->urlClient($module, $header, $footer ) . $access : $this->urlProject($access, $header) . $access ;
		}
		
		public function path(){
			$out = $this->assist->cfg['bycod']['router']['path'];
			return is_array($out) ? $out[0] : $out;
		}
}
