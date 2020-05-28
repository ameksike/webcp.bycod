<?php
/**
 *
 * @framework: Ksike
 * @package: config
 * @version: 0.1
 * @description: ConfigManager es una libreria para el trabajo con ficheros de configuracion
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 16/06/2010
 * @update-Date: 16/06/2010
 * @license: GPL v3
 *
 */

class Config
{
	protected $drivers;
	protected $order;
	public function __construct($option=false){
		$this->drivers = array();
		$this->order = array("php","json","xml","ini");
		$this->order = ($option && !isset($option["order"])) ? $option["order"] : $this->order;
	}

	public function setOrderPriory($order){
		$this->order = $order;
	}

	public function __get($key){
		return $this->load($key, "config");
	}

	public function load($path='', $file="config", $type=0, $force=true){
		$data = $this->data($path, $file, $type, $force);
		return $this->import($data['data'], $data['path']);		
	}

	public function import($data, $path){
		if(isset($data["import"])){
			$import = $data["import"];
			unset ($data["import"]);
			if(!is_array($import)) { 
				$data = $this->require($path, $import, $data);
			}else foreach($import as $file) 
				$data = $this->require($path, $file, $data);
		}return $data;
	}

	public function require($path, $file, $data){
		if(!empty($file)){
			$import = $this->load($path, $file);
			if(is_array($import)){
				$data = array_merge_recursive ($import, $data);
			}				
		}
		return $data;
	}
	
	public function save($data=0, $path=0, $file="config", $type=0, $force=0){
		$dr = $this->driver($type, $path, $file, $force);
		$dr->save($data, "$path$file.$type");
	}

	protected function data($path='', $file="config", $type=0, $force=0)
	{
		if(is_file($path)){
			$tmp = pathinfo($path);
			$type = $tmp['extension'];
			$file = $path;
		}else{
			if(!$type) {
				$type = $this->searchExt("$path/$file"); 
				$type = $type["type"];
			}
			$file = "$path/$file.$type";
		}
		if($type){
			$dr = $this->getDriver($type, $force);
			return $dr ? array(
				"path"=> $path,
				"data"=>$dr->load($file, $force)
			)  : false;
		}
			
		return  false;
	}
	
	protected function getDriver($name, $force=false){
		if(!isset($this->drivers[$name]) || $force){
			include_once dirname(__FILE__)."/base/ConfigDriver.php";
			$driver = "ConfigDriver".strtoupper($name);
			$file = dirname(__FILE__)."/driver/$driver.php";
			if(file_exists($file)){
				include_once $file;
				$this->drivers[$name] = new $driver();
			}else{
				return false;
			}
		}
		return $this->drivers[$name];
	}

	protected function searchExt($path)
	{
		$inf = pathinfo($path);
		if(!empty($inf['extension'])) return array("type"=>$inf['extension'], "ext"=>"");
		else foreach($this->order as $i)
			if(file_exists($path.".".$i)) return array("type"=>$i, "ext"=>".".$i);
		return -1;
	}
}
