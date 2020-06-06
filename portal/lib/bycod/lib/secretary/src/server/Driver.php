<?php
/* 
 *
 * @author: Antonio Membrides Espinosa
 * @mail: amembrides@uci.cu
 * @made: 23/4/2011 
 * @update: 23/4/2011 
 * @description: This is simple and Light Driver for DBSM 
 * @require: PHP >= 5.2.*, libphp5-mysql 
 * 
 */
namespace Ksike\secretary\src\server;
abstract class Driver
{
	public $name;
	public $log;
	protected $records;
	protected $connection;
	protected $debug;

	public function __construct($config=false){
		$this->log  = 'log/';
		$this->debug = 'none';
		$this->setting($config);
		$this->records = array();
		$this->connection = null;
	}
	public function trace(){ return $this->records; }
	public function log($msg){
		$date = date('Y/m/d h:i:s'); 
		error_log("Date: $date, $msg \n", 3, $this->log."secretary.log"); 
	}
	public function setting ($key=false, $value=false){
		if($key){
			if(is_array($key)) 
				foreach($key as $k=>$i) $this->{$k} = $i;
			else if($key) $this->{$key} = $value;
		}
		return $this;
	}
	protected function selected($sql){
		return (strtolower(substr(trim($sql), 0, 6)) == 'select');
	}

	protected function dsn(){
		return "";
	}
	protected function inf(){
		return "";
	}

	abstract public function query($sql);
	abstract public function connect();
	abstract public function disconnect();
	abstract public function extract($count);
}
