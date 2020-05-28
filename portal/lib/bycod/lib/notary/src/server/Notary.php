<?php
/*
 * @framework: Bycod
 * @package: Notary
 * @version: 0.1
 * @description: This is simple and light template engine for php and html support
 * @authors: ing. Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @made: 23/4/2011
 * @update: 23/4/2011
 * @license: GPL v3
 * @require: PHP >= 5.2.*
 */
class Notary
{
	protected $path = "";
	public function __construct($path = ""){
		$this->path = $path;
	}

	public function path($path=false){
		if(is_string($path)) $this->path = $path;
		return $this->path;
	}
	public function resolve($tplname=""){
		$tplfile = (file_exists($tplname)) ? $tplname : $this->path.$tplname;
		return empty($tplfile) ? false : pathinfo($tplfile);
	}
	public function compile($data='', $tplname=""){
		$tplinfo = $this->resolve($tplname);
		$tplfile = is_array($tplinfo) ? $tplinfo["dirname"] . DIRECTORY_SEPARATOR . $tplinfo["basename"]  : $tplname;
		$tpldvr  = is_array($tplinfo) ? $tplinfo["extension"] : "data";
		return $this->process($data, $tplfile,  $tpldvr);	
	}
	public function process($data, $tpl, $driver="html"){
		$data = (!is_array($data)) ? array("data"=>$data) : $data;
		extract($data);
        switch($driver){
            case "php":
                ob_start();
                    include $tpl;
                return ob_get_clean();
            break;
            default:
                ob_start();
                    $tpl = (file_exists($tpl)) ? file_get_contents($tpl): $tpl;
                    $tpl = str_replace('"', '\"', $tpl);
                    eval(' ?><?php echo "' . $tpl . '";?><?php ');
                return ob_get_clean();
            break;
        }
	}

	static  $obj = 0;
	public static function this($path=''){
		self::$obj = (!self::$obj) ? new self($path) : self::$obj;
		return self::$obj;
	}
}
