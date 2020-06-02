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

	public function load($path='', $file="config", $type=0, $force=true, $analyzer=null){
		$data = $this->data($path, $file, $type, $force, $analyzer);
		if(!isset($data['data'])) return '';
		return $this->import($data['data'], $data['path'], $analyzer);		
	}

	public function import($data, $path, $analyzer=null){
		if(isset($data["import"])){
			$import = $data["import"];
			unset ($data["import"]);
			if(!is_array($import)) { 
				$data = $this->requires($path, $import, $data, $analyzer);
			}else foreach($import as $file) 
				$data = $this->requires($path, $file, $data, $analyzer);
		}return $data;
	}

	public function requires($path, $file, $data, $analyzer=null){
		if(!empty($file)){
			$import = $this->load($path, $file, 0, true, $analyzer);
			if(is_array($import)){
				$data = array_merge_recursive ($import, $data);
			}				
		}
		return $data;
	}
	
	public function save($data=0, $path=0, $file="config", $type=0, $force=0){
		$dr = $this->data($type, $path, $file, $force);
		$dr->save($data, "$path$file.$type");
	}

	protected function data($path='', $file="config", $type=0, $force=0, $analyzer=null)
	{
		if(is_file($path)){
			$tmp = pathinfo($path);
			$type = $tmp['extension'];
			$file = $path;
		}else{
			if(!$type) {
				$type = $this->searchExt("$path/$file"); 
				$type = isset($type["type"]) ? $type["type"] : null;
			}
			$file = "$path/$file.$type";
		}
		if($type){
			$dr = $this->getDriver($type, $force);
			return $dr ? array(
				"path"=> $path,
				"data"=>$dr->load($file, $force, $analyzer)
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
