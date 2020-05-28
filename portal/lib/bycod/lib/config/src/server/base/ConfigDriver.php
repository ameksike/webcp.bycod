<?php
/**
 *
 * @framework: Ksike
 * @package: config
 * @subpackage: base
 * @version: 0.1

 * @description: ConfigDriver es una libreria para el trabajo con ...
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 15/06/2010
 * @update-Date: 15/06/2010
 * @license: GPL v3
 *
 */
class ConfigDriver
{
	protected $file;
	protected $name;
	public function __construct($path="") 
	{
		$this->file = $path;
		$this->name = '';
	}
	public function setFilePath($path)
	{
		$this->file = $path;
	}
	protected function load($path=0, $force=0, $analyzer=null){}
	protected function save($data=0, $path=0){}
	
	public function onConfigPerform($data, $watcher){
		if(is_object( $watcher) && method_exists($watcher, "onConfigPerform")){
			return $watcher->{"onConfigPerform"}($data, $this->name);
		}
		return $data;
	}
}
