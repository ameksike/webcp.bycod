<?php
/*
 * @author: Antonio Membrides Espinosa
 * @mail: tonykssa@gmail.com
 * @made: 13/5/2012
 * @update: 25/5/2012
 * @description: This is simple and Light loader libs 
 * @require: PHP >= 5.2.*
 *
 * */
class Service
{
	public function start($req){
		$mod = isset($req['mod']) ? $req['mod'] : $req[3];
		$mod = isset($req['module']) ? $req['module'] : $mod;
		$ini = $this->path.DIRECTORY_SEPARATOR.'index.php';
		$php = $this->php();
		$cmd = "$php $ini service loop $mod";
		$flw = " > ".$this->path.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.'service.'.$mod.'.log';
		$pll = " & ";
		exec($cmd.$flw.$pll);
		return "success";
	}

	public function loop($req){
		$mod = isset($req['mod']) ? $req['mod'] : $req[3];
		$ser = Bycod::lib($mod);
		$ser->path = $this->path;
		$ser->config = $this->config;
		$ser->status = true;
		$this->call($ser, "start", $req);
		while($ser->status)
			if(method_exists($ser, "service"))
				Bycod::lib($mod)->service($req);
			else $ser->status = false;
		$this->call($ser, "stop", $req);
	}
	
	public function php(){
		$os = strtoupper(substr(php_uname(), 0, 3));
		return isset($this->config["sys"]["php"][$os]) ? $this->config["sys"]["php"][$os] : "php";
	}
	
	public function info(){
			echo "owner GID: ".getmygid().", ";		//... Get PHP script owner's GID
			echo "owner UID: ".getmyuid().", ";		//... Gets PHP script owner's UID
			echo "user: ".get_current_user().", ";		//... Gets the name of the owner of the current PHP script
			echo "inode: ".getmyinode().", ";		//... Gets the inode of the current script
			echo "inode: ".getlastmod().", ";		//... Gets time of last page modification 
	}
	
	protected function winexec($cmd){
		$WshShell = new COM("WScript.Shell");
		$oExec = $WshShell->Run($cmd, 1, false);
	}
	
	protected function call($obj, $action, $param){
		if(!method_exists($obj, $action)) return false;
		else return $obj->{$action}($param);
	}
}
