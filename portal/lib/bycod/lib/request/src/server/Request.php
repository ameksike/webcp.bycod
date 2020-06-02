<?php
/*
 * @framework: Bycod
 * @package: Request
 * @version: 0.1
 * @description: This is simple and light request parser
 * @authors: ing. Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @made: 23/4/2011
 * @update: 23/4/2011
 * @license: GPL v3
 * @require: PHP >= 5.2.*
 */
class Request
{	
	protected $processors;
	public $tool;

	public function __construct(){	
		$this->tool =  new RequestTool();
		$this->processors = array();
	}
	
	public function process($request, $router){
		$options = null;
		$request['model'] = isset($request['model']) ? $request['model'] : "list";
		if($this->getDriver($request['model'])) 
			$options = $this->getDriver($request['model'])->process($request, $router);
		return $options;
	}

	protected function getDriver($driver){
		if(!isset($this->processors[$driver])){
			include_once dirname(__FILE__)."/driver/InDriver.php";
			$driver = "InDriver".strtoupper($driver);
			$file = dirname(__FILE__)."/driver/$driver.php";
			if(file_exists($file)){
				include_once $file;
				$this->processors[$driver] = new $driver($this->tool);
			}
		}
		return $this->processors[$driver];
	}

	public function params(){
		return $this->assist->cfg['bycod']['request']['option'];
	}

	public function onRequest($assist){
		$assist->cfg['bycod']['request'] = $this->process(
			$assist->cfg['bycod']['request'], 
			$assist->cfg['bycod']['router']
		);
	}
}

class RequestTool
{
	public function getHtmlInput($asArray=false){	
		$raw  = '';
		$httpContent = fopen('php://input', 'r');
		while ($kb = fread($httpContent, 1024)) $raw .= $kb;
		fclose($httpContent);
		parse_str($raw, $output);
		$input = !is_string($output) ? $output : json_decode(stripslashes($raw), $asArray);
		return $input;
	}
	public function argHtml($delimiter, $src=null){
		$extra = ( !in_array($_SERVER["REQUEST_METHOD"], array("POST", "GET", "REQUEST"))) ? $this->getHtmlInput() : array();
		return  is_array($extra) && !empty($extra) ? array_merge($_REQUEST, $extra) : $_REQUEST ;
	} 
	public function argPretty($delimiter, $src=null){
		return isset($_SERVER["PATH_INFO"]) ? $this->argScheme($delimiter, substr($_SERVER['PATH_INFO'], 1)) : array();
	}
	public function argCli($delimiter, $src=null){
		return isset($_SERVER['argv'][1]) ? $this->argScheme($delimiter, $_SERVER['argv'][1]) : $_SERVER['argv'];
	}
	public function argScheme($delimiter="/", $src=null){
		return explode($delimiter, $src);
	}
	public function fillOptions($request, $list, $key){
		$countKey = count($key);
		$countLst = count($list);
		$request = isset($request) ? $request : array();
		$request['params'] = isset($request['params']) ? $request['params'] : array();

		for($i=0; $i<$countLst; $i++){
			if($countKey <= $i ){
				if(!is_array($request['params'])){
					$request['params'] = array($request['params']);
				}
				$request['params'][] = $list[$i];
			}else{
				$request[$key[$i]] = $list[$i];
			}
		}
		return $request;
	}
	public function formatType($type){
		if($type == "auto"){
			$type = (PHP_SAPI === 'cli') ? 'cli' : (isset($_SERVER["PATH_INFO"]) ? 'pretty' : (isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'web')  );
		}
		return $type;
	}
	public function jsonDecode($value){
		if(!is_string($value)) return $value;
		$val = json_decode($value, true);
		return ($val) ? $val : $value;
	}
}