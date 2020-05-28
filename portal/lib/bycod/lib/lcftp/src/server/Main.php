<?php
/*
 *
 * @framework: Ksike
 * @package: lcftp
 * @version: 0.1
 * @description: This is simple and light client FTP Server
 * @authors: ing. Antonio Membrides Espinosa
 * @mail: ame.uci@gmail.com
 * @made: 23/4/2011
 * @update: 23/4/2011
 * @license: GPL v3
 * @require: PHP >= 5.2.*, Loader <= 0.1
 *
 */
namespace Ksike\lcftp\src\server;
class Main{
    protected $conn;
    protected $cfg;
    protected $tmps;
    protected $serc;

    public function __construct($cfg=array()){
        $this->cfg = array();
		$this->conn = null;
		$this->tmps = array();
        $this->setting($cfg);
    }

    public function setting($cfg=array()){
        $this->cfg['server'] = isset($cfg['server']) ? $cfg['server'] : 'localhost';
        $this->cfg['user'] = isset($cfg['user']) ? $cfg['user'] : 'anonymous';
        $this->cfg['pass'] = isset($cfg['pass']) ? $cfg['pass'] : '';
        $this->cfg['deep'] = isset($cfg['deep']) ? $cfg['deep'] : 5;
        $this->cfg['match'] = isset($cfg['match']) ? $cfg['match'] : 'all';
    }

    public function connect($url=false){
        $server = $url ? $url : $this->cfg['server'];
        $this->conn = @ftp_connect($server)
        or $this->error(1); 
        return $this;
    }

    public function login($user=false, $pass=false){
        $user = $user ? $user : $this->cfg['user'];
        $pass = $pass ? $pass : $this->cfg['pass'];
        $this->login = @ftp_login($this->conn, $user, $pass);
        if(!$this->login) $this->error(2);
        return $this;
    }

	public function error($type){
		switch($type){
			case 2: 
				//... login
			break;
			
			case 1: 
				//... Could not connect to {$server}
			break;
		}
		
	}
	
    public function disconnect(){
        @ftp_close($this->conn);
        return $this;
    }

    public function find($key='', $path='/', $deep=1){
        $this->connect();
        $this->login();
        $data = $this->search($path, $deep, 'research', array(0, $key), $this);
        $this->disconnect();
        return $data;
    }

    public function search($path='', $deep=1, $action=false, $params=false, $scope=false){
        $this->serc = true;
        $path = $path == '' ? '/' : $path;
        $lst = @ftp_nlist($this->conn, $path);
        $tmp = array();

        if(is_array($lst)) foreach($lst as $i){
            $opt = array();
            $opt['type'] = $this->is_ftp_dir($i) ? 'dir' : 'file';
            $opt['label'] = $i;
            $opt['path'] = $i . ($opt['type']=='dir' ? '/' : '');
            $opt['url'] = $this->cfg['server'] . $opt['path'];
            $opt['parent'] =  $this->cfg['server'] . $path ;
            $opt['den'] = $opt['type']=='file' ? str_ireplace($path,'', $opt['label']) : $opt['label'] . '/';

            if($action){
                $action = (is_string($action) && $scope) ? array($scope, $action) : $action;
                $params = $params ? $params : array();
                $params[0] = $opt;
                call_user_func_array($action, $params);
            }else{
                $this->tmps[] = $opt;
            }
            if($this->serc && (is_string($deep) || $deep>1) && ($opt['type'] == 'dir')){
                $this->search($opt['path'], $deep-1, $action, $params, $scope);
            }
        }
        return $this->tmps;
    }

    public function research($ele, $key){
        if($key == '' || (preg_match("/{$key}/i", $ele['label'])) )
            $this->tmps[] = $ele;
    }

    public function is_ftp_dir($dir) {
        if (@ftp_chdir($this->conn, $dir)) {
            ftp_chdir($this->conn, '..');
            return true;
        } else {
            return false;
        }
    }
}