<?php
/**
 *
 * @framework: Bycod
 * @package: response
 * @version: 0.1

 * @description: OutDriver es una libreria para el trabajo con los formatos de salida del servidor
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 15/06/2010
 * @update-Date: 15/06/2010
 * @license: GPL v2
 *
 */
class OutDriver
{
	protected $option;
	public function __construct($option="") 
	{
		$this->option = $option;
	}
	public function buildHead($format="text/plain")
	{
		header("Content-type: {$format}");
	}
	protected function getOut($data){}
}
