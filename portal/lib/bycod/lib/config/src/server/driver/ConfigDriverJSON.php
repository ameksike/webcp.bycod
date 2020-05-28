<?php
/**
 *
 * @framework: Ksike
 * @package: config
 * @subpackage: driver
 * @version: 0.1
 * @description: ConfigDriverJSON es una libreria para el trabajo con ...
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 15/06/2010
 * @update-Date: 20/12/2010
 * @license: GPL v2
 *
 */
class ConfigDriverJSON extends ConfigDriver
{
	private $fileConf;
	public function __construct($path="") 
	{ 
		parent::__construct($path); 
		$this->fileConf = 0;
	}
	public function load($path=0, $force=0)
	{
		$path = $path ? $path : $this->file;
		if(!$this->fileConf || $force) $this->fileConf = file_get_contents($path);
		$this->fileConf = $this->format($this->fileConf);
		$this->fileConf = json_decode($this->fileConf, true);
		return $this->fileConf;
	}
	public function save($data=0, $path=0)
	{
		$path = $path ? $path : $this->file;
		$data = $data ? $data : $this->fileConf;
		file_put_contents($path, stripcslashes(json_encode($data)));
	}

	public function format($data){
		return str_ireplace("__DIR__", 'D:\\bin\\xampp-7030\\htdocs\\dev\\webcp.simple\\portal.bycod', $data);
	}
}
