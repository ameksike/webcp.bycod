<?php
/*
 * @framework: Bycod
 * @package: Metadata
 * @version: 0.1
 * @description: This is simple and light metadata manager
 * @authors: ing. Antonio Membrides Espinosa
 * @made: 15/06/2012
 * @update: 15/06/2012
 * @license: GPL v3
 * @require: PHP >= 5.2.*, notary
 */
class Metadata
{
    protected $mtds;
    public function __construct(){
        $this->mtds = array();
    }
    public function load($lib="main"){
        $path = $this->assist->route($lib);
        $file = "{$path}/mtd/metadata.json";
        return file_exists($file) ? json_decode(file_get_contents($file),true) : array("name"=>ucfirst($lib), "package"=>$lib);
    }
    public function get($lib="main"){
        if(!isset($this->mtds[$lib])) $this->mtds[$lib] = $this->load($lib);
        return $this->mtds[$lib];
    }
    public function __get($index){
        return $this->get($index);
    }
}