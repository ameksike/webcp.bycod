<?php
/*
 * @framework: Bycod from Ksike Elephant
 * @package: src
 * @version: 0.1
 * @description: This is simple and light framework for web develop aplication
 * @authors: ing. Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @made: 15/06/2012
 * @update: 15/06/2012
 * @license: GPL v3
 * @require: PHP >= 5.2.*
 */
class Bycod
{
    protected $lib;
    public $cfg;

    public function __construct($option=array()){
        $this->lib = array();
        $this->cfg = array(
            'bycod'=>array(
                'request'=>array(),
                'router'=>array(
                    'lib'=>array(
                        dirname(__FILE__)."/../../../", 
                        dirname(__FILE__)."/../../lib/")
                ),
                'loader'=>array()
            )
        );
        $this->setting($option);
    }

    public function setting($option=array()){
        $this->cfg = is_array($option) ? array_merge_recursive($this->cfg, $option) : $this->cfg;
    }


    public function onConfigPerform($data, $type){
        if($type=="json"){
            $path = $this->cfg['bycod']['router']['path'];
            //print_r($path);
            //print_r(str_ireplace("__DIR__", $path, $data));
            return str_ireplace("__DIR__", 'D:\\bin\\xampp-7030\\htdocs\\dev\\webcp.bycod\\portal', $data);
        }
        return $data;
    }

    public function whoCallme($deep=2, $elm="class")
    {   //... elm: [file|line|function|class|object|type|args|all]
        $debug = debug_backtrace();
        if($deep!="all") $infor = ($elm!="all") ? $debug[$deep][$elm] : $debug[$deep];
        else {
            $infor = array();
            foreach ($debug as $i)
                $infor[] = ($elm!="all" && isset($i[$elm])) ? $i[$elm] : $i;
        }
        unset($debug);
        return $infor;
    }        
    public function log($data, $file=false){
        $path = is_array($this->cfg['bycod']['router']['path']) ? $this->cfg['bycod']['router']['path'][0] : $this->cfg['bycod']['router']['path']; 
        $file = $file ? $file : $path . "/log/trace.log";
        error_log(print_r($data, true)."\n", 3, $file);
    }

    public function config($path="bycod"){
 /* */

        $file = $this->get("config")->load($path, $file="config", 0, true, $this);
        $file  = $file ? $file : $this->get("config")->load("$path/cfg/", $file="config", 0, true, $this);
        $path = $this->route($path);
        $file  = $file ? $file : $this->get("config")->load("$path/cfg/", $file="config", 0, true, $this);
        $file  = $file ? $file : $this->get("config")->load("$path/../../cfg/", $file="config", 0, true, $this);

        return $file;

      /*        
        $file = $this->fileGet($path);
        $file  = $file ? $file : $this->fileGet("$path/cfg/config.php");
        $path = $this->route($path);
        $file  = $file ? $file : $this->fileGet("$path/cfg/config.php");
        $file  = $file ? $file : $this->fileGet("$path/../../cfg/config.php");
        return $file ? @include $file : false;
*/
        
    } 
    public function route ($module){
        foreach($this->cfg['bycod']['router']['lib'] as $i)
            if(is_dir($i.$module)) return $i.$module;
    }
    public function load($name){
        $class = ucfirst($name);
        $path = $this->route($name);
        $file  = $this->fileGet("$path/$class.php");
        $file  = $file ? $file : $this->fileGet("$path/index.php");
        $file  = $file ? $file : $this->fileGet("$path/server/$class.php");
        $file  = $file ? $file : $this->fileGet("$path/src/server/$class.php");
        $file  = $file ? $file : $this->fileGet("$path/src/server/Main.php");
        if($file) {
            include_once $file;
            $obj = new $class;
            $obj->assist = $this;
            return $obj;
        }else return false;
    }
    protected function fileGet ($file){
        return file_exists($file) ? $file : false;
    }
    public function get($name){
        $name = is_string($name) ? $name : "none";
        if(!isset($this->lib[$name])) $this->lib[$name] = $this->load($name);
        return $this->lib[$name];
    }
    public function __get($name){
        return $this->get($name);
    }
    public function __call($action, $params){
        //echo $action.'--'. print_r($params, true);
    }
    static  $obj = 0;
    public static function this($path=array()){
        self::$obj = (!self::$obj) ? new self($path) : self::$obj;
        return self::$obj;
    }
    public static function lib($name){
        return self::this()->get($name);
    }
}