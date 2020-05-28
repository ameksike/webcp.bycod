<?php
/**
 *
 * @framework: Ksike
 * @package: IOC
 * @subpackage: proxy
 * @version: 0.1

 * @escription: IOC es una libreria que implementa la publicacion de archivos
 * @authors: ing. Antonio Membrides Espinosa
 * @making Date: 22/08/2011
 * @update Date: 24/08/2011
 * @license: GPL v3
 *
 */
class Servant
{
	protected $option;

	public function __construct($option=false){
		$this->load($option);
	}

	public function __get($key){
		return $this->doit($key);
	}

	public function load($option=false)
	{
		if($option) $this->option += $option;
		//else $this->option = Loader::fileconf(Router::app().KCL_CONFIG, "ioc", "none");
	}

	public function save($key)
	{

	}

	protected function get($key)
	{
	}

	protected static $__this = false;
	public static function this($ask=false, $params=false)
	{
		if(!self::$__this){
			if(is_array($ask)){
				$option = $ask;
				$ask = false;
			}else $option=false;
			self::$__this = new self($option);
		}
		if($ask){
			$out = self::$__this->__this($ask, $params);
			if($out) return $out;
		} 
		return self::$__this;
	}
	protected function __this($ask, $params=false){
		return self::$__this->doit($ask);
	}
}
